<!--begin::Sidebar-->
<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px"
    data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <!--begin::Logo-->
    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
        <!--begin::Logo image-->
        <a href="#" class="app-sidebar-logo d-flex align-items-center gap-3">
            <!-- Logo besar -->
            <img alt="Logo" src="/assets/media/logo/logo-azzamil.png" class="h-50px app-sidebar-logo-default" />

            <!-- Tulisan -->
            <span class="app-sidebar-logo-text fw-bold fs-5 text-dark app-sidebar-logo-default">
                Azzamil School
            </span>

            <!-- Logo kecil (minimize) -->
            <img alt="Logo" src="/assets/media/logo/logo-azzamil.png" class="h-30px app-sidebar-logo-minimize" />
        </a>

        <!--end::Logo image-->
        <!--begin::Sidebar toggle-->
        <!--begin::Minimized sidebar setup:
            if (isset($_COOKIE["sidebar_minimize_state"]) && $_COOKIE["sidebar_minimize_state"] === "on") {
                1. "src/js/layout/sidebar.js" adds "sidebar_minimize_state" cookie value to save the sidebar minimize state.
                2. Set data-kt-app-sidebar-minimize="on" attribute for body tag.
                3. Set data-kt-toggle-state="active" attribute to the toggle element with "kt_app_sidebar_toggle" id.
                4. Add "active" class to to sidebar toggle element with "kt_app_sidebar_toggle" id.
            }
        -->
        <div id="kt_app_sidebar_toggle"
            class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary h-30px w-30px position-absolute top-50 start-100 translate-middle rotate"
            data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
            data-kt-toggle-name="app-sidebar-minimize">
            <i class="ki-duotone ki-black-left-line fs-3 rotate-180">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
        </div>
        <!--end::Sidebar toggle-->
    </div>
    <!--end::Logo-->
    <!--begin::sidebar menu-->
    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
        <!--begin::Menu wrapper-->
        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper">
            <!--begin::Scroll wrapper-->
            <div id="kt_app_sidebar_menu_scroll" class="scroll-y my-5 mx-3" data-kt-scroll="true"
                data-kt-scroll-activate="true" data-kt-scroll-height="auto"
                data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
                data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px"
                data-kt-scroll-save-state="true">
                <!--begin::Menu-->
                <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#kt_app_sidebar_menu"
                    data-kt-menu="true" data-kt-menu-expand="false">
                    <!--begin:Menu item-->

                    @hasrole('super_admin')

                        {{-- DASHBOARD --}}
                        <div class="menu-item {{ request()->is('superadmin/dashboard*') ? 'here show' : '' }}">
                            <a class="menu-link {{ request()->is('superadmin/dashboard*') ? 'active' : '' }}"
                                href="/superadmin/dashboard">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-home fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>

                                </span>
                                <span class="menu-title">Dashboard</span>
                            </a>
                        </div>

                        <div class="menu-item pt-5">
                            <div class="menu-content">
                                <span class="menu-heading fw-bold text-uppercase fs-7">Pages</span>
                            </div>
                        </div>

                        {{-- DATA DAERAH --}}
                        <div class="menu-item {{ request()->is('superadmin/data-daerah*') ? 'here show' : '' }}">
                            <a class="menu-link {{ request()->is('superadmin/data-daerah*') ? 'active' : '' }}"
                                href="/superadmin/data-daerah">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-geolocation fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Data Daerah</span>
                            </a>
                        </div>

                        {{-- DATA ADMIN --}}
                        <div class="menu-item {{ request()->is('superadmin/data-admin*') ? 'here show' : '' }}">
                            <a class="menu-link {{ request()->is('superadmin/data-admin*') ? 'active' : '' }}"
                                href="/superadmin/data-admin">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-user fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>

                                </span>
                                <span class="menu-title">Data Admin</span>
                            </a>
                        </div>

                        {{-- DATA SEKOLAH --}}
                        <div class="menu-item {{ request()->is('superadmin/data-sekolah*') ? 'here show' : '' }}">
                            <a class="menu-link {{ request()->is('superadmin/data-sekolah*') ? 'active' : '' }}"
                                href="/superadmin/data-sekolah">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-bank fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Data Sekolah</span>
                            </a>
                        </div>

                        {{-- DATA GURU --}}
                        <div class="menu-item {{ request()->is('superadmin/data-guru*') ? 'here show' : '' }}">
                            <a class="menu-link {{ request()->is('superadmin/data-guru*') ? 'active' : '' }}"
                                href="/superadmin/data-guru">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-profile-circle fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>

                                </span>
                                <span class="menu-title">Data Guru</span>
                            </a>
                        </div>

                        {{-- DATA ORANG TUA --}}
                        <div class="menu-item {{ request()->is('superadmin/data-orang-tua*') ? 'here show' : '' }}">
                            <a class="menu-link {{ request()->is('superadmin/data-orang-tua*') ? 'active' : '' }}"
                                href="/superadmin/data-orang-tua">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-user-square fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>


                                <span class="menu-title">Data Orang Tua</span>
                            </a>
                        </div>

                        {{-- DATA ANAK --}}
                        <div class="menu-item {{ request()->is('superadmin/data-anak*') ? 'here show' : '' }}">
                            <a class="menu-link {{ request()->is('superadmin/data-anak*') ? 'active' : '' }}"
                                href="/superadmin/data-anak">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-user-tick fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>

                                </span>
                                <span class="menu-title">Data Anak</span>
                            </a>
                        </div>

                        {{-- DATA TUMBUH KEMBANG --}}
                        <div class="menu-item {{ request()->is('superadmin/data-tumbuh-kembang*') ? 'here show' : '' }}">
                            <a class="menu-link {{ request()->is('superadmin/data-tumbuh-kembang*') ? 'active' : '' }}"
                                href="/superadmin/data-tumbuh-kembang">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-heart fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>

                                </span>
                                <span class="menu-title">Data Tumbuh Kembang</span>
                            </a>
                        </div>

                        {{-- DATA RAPORT --}}
                        <div class="menu-item {{ request()->is('superadmin/data-raport*') ? 'here show' : '' }}">
                            <a class="menu-link {{ request()->is('superadmin/data-raport*') ? 'active' : '' }}"
                                href="/superadmin/data-raport">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-note-2 fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>

                                </span>
                                <span class="menu-title">Data Raport</span>
                            </a>
                        </div>

                        {{-- PROFILE --}}
                        <div class="menu-item {{ request()->is('superadmin/profile*') ? 'here show' : '' }}">
                            <a class="menu-link {{ request()->is('superadmin/profile*') ? 'active' : '' }}"
                                href="#">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-setting-2 fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>

                                </span>
                                <span class="menu-title">Profile</span>
                            </a>
                        </div>

                    @endrole




                    {{-- =========================
ROLE: ADMIN
========================= --}}
                    @hasrole('admin')
                        {{-- Dashboard --}}
                        <div class="menu-item menu-accordion {{ request()->is('admin/dashboard*') ? 'here show' : '' }}">
                            <a class="menu-link {{ request()->is('admin/dashboard*') ? 'active' : '' }}"
                                href="/admin/dashboard">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-home fs-2">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Dashboard</span>
                            </a>
                        </div>

                        <div class="menu-item pt-5">
                            <div class="menu-content">
                                <span class="menu-heading fw-bold text-uppercase fs-7">Pages</span>
                            </div>
                        </div>

                        {{-- Data Sekolah --}}
                        <div
                            class="menu-item menu-accordion {{ request()->is('admin/data-sekolah*') ? 'here show' : '' }}">
                            <a class="menu-link {{ request()->is('admin/data-sekolah*') ? 'active' : '' }}"
                                href="/admin/data-sekolah">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-bank fs-2">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Data Sekolah</span>
                            </a>
                        </div>

                        {{-- Data Guru --}}
                        <div class="menu-item menu-accordion {{ request()->is('admin/data-guru*') ? 'here show' : '' }}">
                            <a class="menu-link {{ request()->is('admin/data-guru*') ? 'active' : '' }}"
                                href="/admin/data-guru">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-profile-circle fs-2">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Data Guru</span>
                            </a>
                        </div>

                        {{-- Data Orang Tua --}}
                        <div
                            class="menu-item menu-accordion {{ request()->is('admin/data-orang-tua*') ? 'here show' : '' }}">
                            <a class="menu-link {{ request()->is('admin/data-orang-tua*') ? 'active' : '' }}"
                                href="/admin/data-orang-tua">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-user-square fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Data Orang Tua</span>
                            </a>
                        </div>

                        {{-- Data Anak --}}
                        <div class="menu-item menu-accordion {{ request()->is('admin/data-anak*') ? 'here show' : '' }}">
                            <a class="menu-link {{ request()->is('admin/data-anak*') ? 'active' : '' }}"
                                href="/admin/data-anak">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-user-tick fs-2">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Data Anak</span>
                            </a>
                        </div>

                        {{-- Tumbuh Kembang --}}
                        <div
                            class="menu-item menu-accordion {{ request()->is('admin/data-tumbuh-kembang*') ? 'here show' : '' }}">
                            <a class="menu-link {{ request()->is('admin/data-tumbuh-kembang*') ? 'active' : '' }}"
                                href="/admin/data-tumbuh-kembang">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-heart fs-2">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Tumbuh Kembang</span>
                            </a>
                        </div>

                        {{-- Data Raport --}}
                        <div
                            class="menu-item menu-accordion {{ request()->is('admin/data-raport*') ? 'here show' : '' }}">
                            <a class="menu-link {{ request()->is('admin/data-raport*') ? 'active' : '' }}"
                                href="/admin/data-raport">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-note-2 fs-2">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Data Raport</span>
                            </a>
                        </div>

                        {{-- Profil (kalau belum ada route, biarkan #) --}}
                        <div class="menu-item menu-accordion {{ request()->is('admin/profil*') ? 'here show' : '' }}">
                            <a class="menu-link {{ request()->is('admin/profil*') ? 'active' : '' }}" href="#">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-setting-2 fs-2">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Profil</span>
                            </a>
                        </div>
                    @endrole


                    {{-- =========================
ROLE: GURU
========================= --}}
                    @hasrole('guru')
                        {{-- Dashboard --}}
                        <div class="menu-item menu-accordion {{ request()->is('guru/dashboard*') ? 'here show' : '' }}">
                            <a class="menu-link {{ request()->is('guru/dashboard*') ? 'active' : '' }}"
                                href="/guru/dashboard">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-home fs-2">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Dashboard</span>
                            </a>
                        </div>

                        <div class="menu-item pt-5">
                            <div class="menu-content">
                                <span class="menu-heading fw-bold text-uppercase fs-7">Pages</span>
                            </div>
                        </div>

                        {{-- Data Anak --}}
                        <div class="menu-item menu-accordion {{ request()->is('guru/data-anak*') ? 'here show' : '' }}">
                            <a class="menu-link {{ request()->is('guru/data-anak*') ? 'active' : '' }}"
                                href="/guru/data-anak">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-user-tick fs-2">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Data Anak</span>
                            </a>
                        </div>

                        {{-- Tumbuh Kembang --}}
                        <div
                            class="menu-item menu-accordion {{ request()->is('guru/data-tumbuh-kembang*') ? 'here show' : '' }}">
                            <a class="menu-link {{ request()->is('guru/data-tumbuh-kembang*') ? 'active' : '' }}"
                                href="/guru/data-tumbuh-kembang">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-heart fs-2">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Tumbuh Kembang</span>
                            </a>
                        </div>

                        {{-- Data Raport --}}
                        <div class="menu-item menu-accordion {{ request()->is('guru/data-raport*') ? 'here show' : '' }}">
                            <a class="menu-link {{ request()->is('guru/data-raport*') ? 'active' : '' }}"
                                href="/guru/data-raport">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-note-2 fs-2">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Data Raport</span>
                            </a>
                        </div>

                        {{-- Profil --}}
                        <div class="menu-item menu-accordion {{ request()->is('guru/profil*') ? 'here show' : '' }}">
                            <a class="menu-link {{ request()->is('guru/profil*') ? 'active' : '' }}" href="#">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-setting-2 fs-2">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Profil</span>
                            </a>
                        </div>
                    @endrole


                    {{-- =========================
ROLE: ORANG TUA
========================= --}}
                    @hasrole('orang_tua')
                        {{-- Dashboard --}}
                        <div
                            class="menu-item menu-accordion {{ request()->is('orang_tua/dashboard*') ? 'here show' : '' }}">
                            <a class="menu-link {{ request()->is('orang_tua/dashboard*') ? 'active' : '' }}"
                                href="/orang_tua/dashboard">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-home fs-2">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Dashboard</span>
                            </a>
                        </div>

                        <div class="menu-item pt-5">
                            <div class="menu-content">
                                <span class="menu-heading fw-bold text-uppercase fs-7">Pages</span>
                            </div>
                        </div>

                        {{-- Data Informasi Anak (BETULKAN LINK: harus orang_tua, bukan guru) --}}
                        <div
                            class="menu-item menu-accordion {{ request()->is('orang_tua/data-anak*') ? 'here show' : '' }}">
                            <a class="menu-link {{ request()->is('orang_tua/data-anak*') ? 'active' : '' }}"
                                href="/orang_tua/data-anak">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-user-tick fs-2">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Data Informasi Anak</span>
                            </a>
                        </div>

                        {{-- Tumbuh Kembang (BETULKAN LINK: harus orang_tua, bukan admin) --}}
                        <div
                            class="menu-item menu-accordion {{ request()->is('orang_tua/data-tumbuh-kembang*') ? 'here show' : '' }}">
                            <a class="menu-link {{ request()->is('orang_tua/data-tumbuh-kembang*') ? 'active' : '' }}"
                                href="/orang_tua/data-tumbuh-kembang">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-heart fs-2">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Tumbuh Kembang</span>
                            </a>
                        </div>

                        {{-- Data Raport --}}
                        <div
                            class="menu-item menu-accordion {{ request()->is('orang_tua/data-raport*') ? 'here show' : '' }}">
                            <a class="menu-link {{ request()->is('orang_tua/data-raport*') ? 'active' : '' }}"
                                href="/orang_tua/data-raport">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-note-2 fs-2">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Data Raport</span>
                            </a>
                        </div>

                        {{-- Profil --}}
                        <div class="menu-item menu-accordion {{ request()->is('orang_tua/profil*') ? 'here show' : '' }}">
                            <a class="menu-link {{ request()->is('orang_tua/profil*') ? 'active' : '' }}" href="#">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-setting-2 fs-2">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Profil</span>
                            </a>
                        </div>
                    @endrole

                </div>
                <!--end::Menu-->
            </div>
            <!--end::Scroll wrapper-->
        </div>
        <!--end::Menu wrapper-->
    </div>
    <!--end::sidebar menu-->
</div>
<!--end::Sidebar-->
