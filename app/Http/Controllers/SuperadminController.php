<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Anak;
use App\Models\Antropometri;
use App\Models\Daerah;
use App\Models\DdstTest;
use App\Models\Guru;
use App\Models\OrangTua;
use App\Models\Raport;
use App\Models\Reviewer;
use App\Models\Sekolah;
use App\Models\Superadmin;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SuperadminController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $periode = $request->get('periode', now()->format('Y-m'));
        try {
            $start = Carbon::createFromFormat('Y-m', $periode)->startOfMonth();
        } catch (\Throwable $e) {
            $start = now()->startOfMonth();
            $periode = $start->format('Y-m');
        }
        $end = (clone $start)->endOfMonth();
        $periodeLabel = $start->translatedFormat('F Y');

        $totalDaerah = Daerah::count();
        $totalAdmin = Admin::count();
        $totalReviewer = Reviewer::count();
        $totalSekolah = Sekolah::count();

        $totalGuru = Guru::count();
        $totalOrangTua = OrangTua::count();
        $totalAnak = Anak::count();

        $anakSelesaiTk = Anak::query()
            ->whereIn('id', function ($q) use ($start, $end) {
                $q->select('anaks_id')
                    ->from('antropometris')
                    ->whereBetween('tanggal_ukur', [$start->toDateString(), $end->toDateString()]);
            })
            ->whereIn('id', function ($q) use ($start, $end) {
                $q->select('anaks_id')
                    ->from('ddst_tests')
                    ->whereBetween('tanggal_test', [$start->toDateString(), $end->toDateString()]);
            })
            ->distinct('id')
            ->count('id');

        $tkSelesai = $anakSelesaiTk;
        $tkBelum = max($totalAnak - $tkSelesai, 0);
        $tkProgress = $totalAnak > 0 ? (int) round(($tkSelesai / $totalAnak) * 100) : 0;

        $raportSelesai = Raport::query()
            ->whereBetween('created_at', [$start->toDateTimeString(), $end->toDateTimeString()])
            ->distinct('anak_id')
            ->count('anak_id');

        $raportBelum = max($totalAnak - $raportSelesai, 0);
        $raportProgress = $totalAnak > 0 ? (int) round(($raportSelesai / $totalAnak) * 100) : 0;

        $latestAntroIds = Antropometri::query()
            ->selectRaw('MAX(id) as id')
            ->whereBetween('tanggal_ukur', [$start->toDateString(), $end->toDateString()])
            ->groupBy('anaks_id');

        $giziGrouped = Antropometri::query()
            ->selectRaw("COALESCE(NULLIF(status_gizi,''),'Tidak diisi') AS label, COUNT(*) AS jumlah")
            ->whereIn('id', $latestAntroIds)
            ->groupBy('label')
            ->orderByDesc('jumlah')
            ->get();

        $giziChart = $giziGrouped
            ->map(fn($r) => ['label' => $r->label, 'value' => (int) $r->jumlah])
            ->values()
            ->all();

        $giziTidakNormal = Antropometri::query()
            ->whereIn('id', $latestAntroIds)
            ->whereNotNull('status_gizi')
            ->where('status_gizi', '!=', '')
            ->where('status_gizi', '!=', 'Normal')
            ->count();

        $ddstPerluEvaluasi = DdstTest::query()
            ->whereBetween('tanggal_test', [$start->toDateString(), $end->toDateString()])
            ->whereHas('items', function ($q) {
                $q->whereIn('status', ['belum_tercapai', 'ragu_ragu']);
            })
            ->distinct('anaks_id')
            ->count('anaks_id');

        $anakPerDaerah = Daerah::query()
            ->select('daerahs.id', 'daerahs.nama_daerah')
            ->selectRaw('COUNT(anaks.id) as total_anak')
            ->leftJoin('sekolahs', 'sekolahs.daerahs_id', '=', 'daerahs.id')
            ->leftJoin('anaks', 'anaks.sekolahs_id', '=', 'sekolahs.id')
            ->groupBy('daerahs.id', 'daerahs.nama_daerah')
            ->orderByDesc('total_anak')
            ->limit(6)
            ->get()
            ->map(fn($d) => ['label' => $d->nama_daerah, 'value' => (int) $d->total_anak])
            ->values()
            ->all();

        $months = collect(range(5, 0))->map(fn($i) => now()->startOfMonth()->subMonths($i));
        $trenBulan = $months->map(fn($d) => $d->translatedFormat('M Y'))->values()->all();

        $trenAnak = $months->map(function ($d) {
            return Anak::query()->where('created_at', '<=', $d->endOfMonth()->toDateTimeString())->count();
        })->values()->all();

        $trenSekolah = $months->map(function ($d) {
            return Sekolah::query()->where('created_at', '<=', $d->endOfMonth()->toDateTimeString())->count();
        })->values()->all();

        $badgeStatus = function (int $tk, int $raport) {
            $avg = ($tk + $raport) / 2;
            if ($avg >= 85) return ['label' => 'Stabil', 'class' => 'badge-light-success'];
            if ($avg >= 70) return ['label' => 'Monitoring', 'class' => 'badge-light-warning'];
            return ['label' => 'Tertinggal', 'class' => 'badge-light-danger'];
        };

        $monitorDaerah = [];
        $daerahs = Daerah::select('id', 'nama_daerah')->get();

        foreach ($daerahs as $d) {
            $sekolahIds = Sekolah::where('daerahs_id', $d->id)->pluck('id');
            $sekolahCount = $sekolahIds->count();

            $anakIds = Anak::whereIn('sekolahs_id', $sekolahIds)->pluck('id');
            $total = $anakIds->count();

            if ($total === 0) {
                $monitorDaerah[] = [
                    'daerah' => $d->nama_daerah,
                    'sekolah' => $sekolahCount,
                    'anak' => 0,
                    'tk' => 0,
                    'raport' => 0,
                ];
                continue;
            }

            $selesaiTk = Anak::query()
                ->whereIn('id', $anakIds)
                ->whereIn('id', function ($q) use ($start, $end) {
                    $q->select('anaks_id')
                        ->from('antropometris')
                        ->whereBetween('tanggal_ukur', [$start->toDateString(), $end->toDateString()]);
                })
                ->whereIn('id', function ($q) use ($start, $end) {
                    $q->select('anaks_id')
                        ->from('ddst_tests')
                        ->whereBetween('tanggal_test', [$start->toDateString(), $end->toDateString()]);
                })
                ->distinct('id')
                ->count('id');

            $raportDone = Raport::query()
                ->whereIn('anak_id', $anakIds)
                ->whereBetween('created_at', [$start->toDateTimeString(), $end->toDateTimeString()])
                ->distinct('anak_id')
                ->count('anak_id');

            $tkPct = (int) round(($selesaiTk / $total) * 100);
            $raportPct = (int) round(($raportDone / $total) * 100);

            $monitorDaerah[] = [
                'daerah' => $d->nama_daerah,
                'sekolah' => $sekolahCount,
                'anak' => $total,
                'tk' => $tkPct,
                'raport' => $raportPct,
            ];
        }

        return view('superadmin.dashboard.index', compact(
            'periode',
            'periodeLabel',
            'totalDaerah',
            'totalAdmin',
            'totalReviewer',
            'totalSekolah',
            'totalGuru',
            'totalOrangTua',
            'totalAnak',
            'tkSelesai',
            'tkBelum',
            'tkProgress',
            'raportSelesai',
            'raportBelum',
            'raportProgress',
            'ddstPerluEvaluasi',
            'giziTidakNormal',
            'anakPerDaerah',
            'giziChart',
            'trenBulan',
            'trenAnak',
            'trenSekolah',
            'monitorDaerah',
            'badgeStatus'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Superadmin $superadmin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Superadmin $superadmin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Superadmin $superadmin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Superadmin $superadmin)
    {
        //
    }
}
