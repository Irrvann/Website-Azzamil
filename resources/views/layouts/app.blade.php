<!DOCTYPE html>
<!--
Author: Keenthemes
Product Name: MetronicProduct Version: 8.2.9
Purchase: https://1.envato.market/Vm7VRE
Website: http://www.keenthemes.com
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="en">
<!--begin::Head-->

<head>
    <title>Azzamil School</title>
    <meta charset="utf-8" />
    <meta name="description"
        content="The most advanced Tailwind CSS & Bootstrap 5 Admin Theme with 40 unique prebuilt layouts on Themeforest trusted by 100,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel versions. Grab your copy now and get life-time updates for free." />
    <meta name="keywords"
        content="tailwind, tailwindcss, metronic, bootstrap, bootstrap 5, angular, VueJs, React, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel starter kits, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title"
        content="Metronic - The World's #1 Selling Tailwind CSS & Bootstrap Admin Template by KeenThemes" />
    <meta property="og:url" content="https://keenthemes.com/metronic" />
    <meta property="og:site_name" content="Metronic by Keenthemes" />
    <link rel="canonical" href="http://preview.keenthemes.comindex.html" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/media/logo/logo-azzamil.png') }}">
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="{{ asset('/template_admin/demo1/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('/template_admin/demo1/assets/plugins/custom/datatables/datatables.bundle.css') }}"
        rel="stylesheet" type="text/css" />

    <link href="{{ asset('/template_admin/demo1/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('/template_admin/demo1/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />

    <!--end::Global Stylesheets Bundle-->
    <script>
        // Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }
    </script>
    <style>
        /* notifikais */
        .colored-toast.swal2-icon-success {
            background-color: #328b5a !important;
        }

        .colored-toast.swal2-title {
            color: white !important;
            font-size: 14px;
        }

        .colored-toast {
            padding: 10px 16px !important;
            border-radius: 6px !important;
        }

        /* loaader */
        .page-loader-overlay {
            position: fixed;
            inset: 0;
            z-index: 99999;
            display: none;
            /* default hidden */
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
            display: flex;
            justify-content: center;
            align-items: center;
        }


        /* bg judul tabel */
        /* Warna default untuk field (dipakai di kedua mode) */
        .table-field-colored tbody tr td {
            background-color: var(--kt-field-bg);
            transition: background-color 0.2s ease;
            padding: 0.85rem 1.25rem !important;
        }

        .table-field-colored thead th {
            /* background-color: var(--kt-field-bg);
            transition: background-color 0.2s ease; */
            padding: 0.85rem 1.25rem !important;
        }

        /* Light mode */
        [data-bs-theme="light"] {
            --kt-field-bg: #111827;
            /* abu-abu kebiruan lembut, mirip Metronic gray-100 */
        }

        /* Dark mode */
        [data-bs-theme="dark"] {
            --kt-field-bg: #111827;
            /* abu-abu sangat gelap, kayak panel di dark mode */
        }

        /* Optional: header juga dikasih background */
        [data-bs-theme="light"] .table-field-colored thead tr {
            background-color: #020617;
            /* ungu kebiruan sangat soft */
        }

        [data-bs-theme="dark"] .table-field-colored thead tr {
            background-color: #020617;
            /* hampir hitam, tapi masih beda dari body */
        }

        
    </style>
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true"
    data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true"
    data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true"
    data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">

    <!--begin::Theme mode setup on page load-->
    <script>
        var defaultThemeMode = "light";
        var themeMode;
        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
            } else {
                if (localStorage.getItem("data-bs-theme") !== null) {
                    themeMode = localStorage.getItem("data-bs-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }
            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }
            document.documentElement.setAttribute("data-bs-theme", themeMode);
        }
    </script>
    <!--end::Theme mode setup on page load-->
    <!--begin::App-->
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <!--begin::Page-->
        <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
            @include('layouts.header')
            <!--begin::Wrapper-->
            <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
                @include('layouts.sidebar')
                <!--begin::Main-->
                <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                    <!--begin::Page Loader-->
                    <div id="page-loader" class="page-loader-overlay bg-body bg-opacity-75">
                        <div class="indicator-progress d-flex flex-column align-items-center">
                            <span class="spinner-border text-primary mb-3" role="status"></span>
                            <span class="text-primary fs-6 fw-semibold">Memproses...</span>
                        </div>
                    </div>
                    <!--end::Page Loader-->

                    <!--begin::Content wrapper-->
                    @yield('content')
                    <!--end::Content wrapper-->
                    <!--begin::Footer-->
                    @include('layouts.footer')
                    <!--end::Footer-->
                </div>
                <!--end:::Main-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::App-->
    <!--begin::Drawers-->
    <!--begin::Activities drawer-->



    <!--end::Modal - Invite Friend-->
    <!--end::Modals-->
    <!--begin::Javascript-->
    <script>
        var hostUrl = "assets/";
    </script>
    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="{{ asset('template_admin/demo1/assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('template_admin/demo1/assets/js/scripts.bundle.js') }}"></script>

    <!-- Vendor JS -->
    <script src="{{ asset('template_admin/demo1/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>

    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/map.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/continentsLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/usaLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZonesLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZoneAreasLow.js"></script>
    <script src="/template_admin/demo1/assets/plugins/custom/datatables/datatables.bundle.js"></script>
    <!--end::Vendors Javascript-->
    <!--begin::Custom Javascript(used for this page only)-->
    <script src="{{ asset('template_admin/demo1/assets/js/widgets.bundle.js') }}"></script>
    <script src="{{ asset('template_admin/demo1/assets/js/custom/widgets.js') }}"></script>
    <script src="{{ asset('template_admin/demo1/assets/js/custom/apps/chat/chat.js') }}"></script>
    <script src="{{ asset('template_admin/demo1/assets/js/custom/utilities/modals/upgrade-plan.js') }}"></script>
    <script src="{{ asset('template_admin/demo1/assets/js/custom/utilities/modals/create-app.js') }}"></script>
    <script src="{{ asset('template_admin/demo1/assets/js/custom/utilities/modals/new-target.js') }}"></script>
    <script src="{{ asset('template_admin/demo1/assets/js/custom/utilities/modals/users-search.js') }}"></script>
    <!--end::Custom Javascript-->
    <!--end::Javascript-->





    {{-- sweetalert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('success'))
        <script>
            Swal.fire({
                toast: true,
                icon: 'success',
                title: "{{ session('success') }}",
                position: 'top-end',
                showConfirmButton: false,
                timer: 2500,
                timerProgressBar: true,
                customClass: {
                    popup: 'colored-toast'
                }
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                toast: true,
                icon: 'error',
                title: "{{ session('error') }}",
                position: 'top-end',
                showConfirmButton: false,
                timer: 2500,
                timerProgressBar: true,
            });
        </script>
    @endif


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loader = document.getElementById('page-loader');
            if (!loader) return;

            // Pastikan loader mati saat halaman selesai load
            loader.style.display = 'none';

            // Semua form yang mau pakai loading
            const loadingForms = document.querySelectorAll('form.form-loading');

            loadingForms.forEach(function(form) {
                form.addEventListener('submit', function() {
                    // Tampilkan overlay loader
                    loader.style.display = 'flex';

                    // Optional: disable tombol submit + ganti teks jadi spinner
                    const submitBtn = form.querySelector('button[type="submit"]');
                    if (submitBtn) {
                        submitBtn.disabled = true;
                        submitBtn.innerHTML = `
                        <span class="spinner-border spinner-border-sm align-middle me-2"></span>
                        Memproses...
                    `;
                    }
                });
            });
        });
    </script>




</body>
<!--end::Body-->

</html>
