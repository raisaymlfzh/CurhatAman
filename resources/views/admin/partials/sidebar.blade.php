@php
    $activeDataMaster = request()->routeIs(
        'admin.pengguna.*',
        'admin.kelas.*',
        'admin.kategori-kasus.*',
        'admin.mitra-rujukan.*'
    );
    $activeMonitoring = request()->routeIs(
        'admin.kasus-eskalasi.*',
        'admin.kasus-mangkrak.*',
        'admin.aktivitas-guru-bk.*',
        'admin.laporan-kebijakan.*'
    );
    $activeSistem = request()->routeIs(
        'admin.audit-log.*',
        'admin.pengaturan-sistem.*'
    );
@endphp

<style>
    #adminSidebar .sidebar-dropdown {
        margin-top: 4px !important;
    }

    #adminSidebar .sidebar-dropdown-toggle {
        width: 100% !important;
        min-height: 38px !important;
        height: 38px !important;
        padding: 0 12px !important;
        border: 0 !important;
        border-radius: 9px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        gap: 8px !important;
        color: #344054 !important;
        background: transparent !important;
        font-size: 12.8px !important;
        font-weight: 620 !important;
        cursor: pointer !important;
        text-align: left !important;
        transition: background .15s ease, color .15s ease !important;
    }

    #adminSidebar .sidebar-dropdown-toggle:hover {
        color: var(--ca-primary) !important;
        background: #f8fafb !important;
    }

    #adminSidebar .sidebar-dropdown.open .sidebar-dropdown-toggle {
        color: var(--ca-primary-dark) !important;
        background: var(--ca-primary-soft) !important;
        font-weight: 680 !important;
    }

    #adminSidebar .sidebar-dropdown-title {
        display: inline-flex !important;
        align-items: center !important;
        gap: 10px !important;
        min-width: 0 !important;
    }

    #adminSidebar .sidebar-dropdown-title i {
        width: 18px !important;
        color: #667085 !important;
        font-size: 15px !important;
        text-align: center !important;
    }

    #adminSidebar .sidebar-dropdown-toggle:hover .sidebar-dropdown-title i,
    #adminSidebar .sidebar-dropdown.open .sidebar-dropdown-toggle .sidebar-dropdown-title i {
        color: var(--ca-primary) !important;
    }

    #adminSidebar .sidebar-dropdown-arrow {
        font-size: 11px !important;
        color: #98a2b3 !important;
        transition: transform .2s ease, color .15s ease !important;
    }

    #adminSidebar .sidebar-dropdown.open .sidebar-dropdown-arrow {
        transform: rotate(180deg) !important;
        color: var(--ca-primary) !important;
    }

    #adminSidebar .sidebar-dropdown-menu {
        display: none !important;
        padding: 4px 0 4px 12px !important;
        margin-top: 2px !important;
        margin-left: 19px !important;
        border-left: 1.5px solid #e6efef !important;
    }

    #adminSidebar .sidebar-dropdown.open .sidebar-dropdown-menu {
        display: block !important;
    }

    #adminSidebar .sidebar-sublink {
        min-height: 35px !important;
        height: 35px !important;
        padding: 0 10px !important;
        font-size: 12.3px !important;
    }
</style>

<aside
    class="sidebar"
    id="adminSidebar"
>

    <a
        href="{{ route('admin.dashboard') }}"
        class="sidebar-brand"
    >
        <span class="brand-symbol">
            <i class="bi bi-people-fill"></i>
        </span>

        <span>
            <span class="brand-name">
                CurhatAman
            </span>

            <span class="brand-role">
                Portal Admin Sekolah
            </span>
        </span>
    </a>

    <div class="sidebar-section-label">
        Menu Utama
    </div>

    <nav class="sidebar-nav">

        <a
            href="{{ route('admin.dashboard') }}"
            class="
                sidebar-link
                {{ request()->routeIs('admin.dashboard')
                    ? 'active'
                    : '' }}
            "
        >
            <i class="bi bi-grid-1x2"></i>
            <span>Dashboard</span>
        </a>

        <!-- Grup 1: Data Master & Akademik -->
        <div class="sidebar-dropdown {{ $activeDataMaster ? 'open' : '' }}">
            <button
                type="button"
                class="sidebar-dropdown-toggle {{ $activeDataMaster ? 'has-active' : '' }}"
                onclick="toggleSidebarDropdown(this)"
                aria-expanded="{{ $activeDataMaster ? 'true' : 'false' }}"
            >
                <span class="sidebar-dropdown-title">
                    <i class="bi bi-folder2-open"></i>
                    <span>Data Master & Akademik</span>
                </span>
                <i class="bi bi-chevron-down sidebar-dropdown-arrow"></i>
            </button>

            <div class="sidebar-dropdown-menu">
                <a
                    href="{{ route('admin.pengguna.index') }}"
                    class="sidebar-link sidebar-sublink {{ request()->routeIs('admin.pengguna.*') ? 'active' : '' }}"
                >
                    <i class="bi bi-people"></i>
                    <span>Kelola Pengguna</span>
                </a>

                <a
                    href="{{ route('admin.kelas.index') }}"
                    class="sidebar-link sidebar-sublink {{ request()->routeIs('admin.kelas.*') ? 'active' : '' }}"
                >
                    <i class="bi bi-door-open"></i>
                    <span>Kelola Kelas</span>
                </a>

                <a
                    href="{{ route('admin.kategori-kasus.index') }}"
                    class="sidebar-link sidebar-sublink {{ request()->routeIs('admin.kategori-kasus.*') ? 'active' : '' }}"
                >
                    <i class="bi bi-tags"></i>
                    <span>Kategori Kasus</span>
                </a>

                <a
                    href="{{ route('admin.mitra-rujukan.index') }}"
                    class="sidebar-link sidebar-sublink {{ request()->routeIs('admin.mitra-rujukan.*') ? 'active' : '' }}"
                >
                    <i class="bi bi-hospital"></i>
                    <span>Mitra Rujukan</span>
                </a>
            </div>
        </div>

        <!-- Grup 2: Pengawasan & Monitoring -->
        <div class="sidebar-dropdown {{ $activeMonitoring ? 'open' : '' }}">
            <button
                type="button"
                class="sidebar-dropdown-toggle {{ $activeMonitoring ? 'has-active' : '' }}"
                onclick="toggleSidebarDropdown(this)"
                aria-expanded="{{ $activeMonitoring ? 'true' : 'false' }}"
            >
                <span class="sidebar-dropdown-title">
                    <i class="bi bi-shield-check"></i>
                    <span>Pengawasan & Monitoring</span>
                </span>
                <i class="bi bi-chevron-down sidebar-dropdown-arrow"></i>
            </button>

            <div class="sidebar-dropdown-menu">
                <a
                    href="{{ route('admin.kasus-eskalasi.index') }}"
                    class="sidebar-link sidebar-sublink {{ request()->routeIs('admin.kasus-eskalasi.*') ? 'active' : '' }}"
                >
                    <i class="bi bi-exclamation-diamond"></i>
                    <span>Kasus Eskalasi</span>
                </a>

                <a
                    href="{{ route('admin.kasus-mangkrak.index') }}"
                    class="sidebar-link sidebar-sublink {{ request()->routeIs('admin.kasus-mangkrak.*') ? 'active' : '' }}"
                >
                    <i class="bi bi-hourglass-split"></i>
                    <span>Kasus Mangkrak</span>
                </a>

                <a
                    href="{{ route('admin.aktivitas-guru-bk.index') }}"
                    class="sidebar-link sidebar-sublink {{ request()->routeIs('admin.aktivitas-guru-bk.*') ? 'active' : '' }}"
                >
                    <i class="bi bi-activity"></i>
                    <span>Aktivitas Guru BK</span>
                </a>

                <a
                    href="{{ route('admin.laporan-kebijakan.index') }}"
                    class="sidebar-link sidebar-sublink {{ request()->routeIs('admin.laporan-kebijakan.*') ? 'active' : '' }}"
                >
                    <i class="bi bi-file-earmark-bar-graph"></i>
                    <span>Laporan Kebijakan</span>
                </a>
            </div>
        </div>

        <!-- Grup 3: Sistem & Keamanan -->
        <div class="sidebar-dropdown {{ $activeSistem ? 'open' : '' }}">
            <button
                type="button"
                class="sidebar-dropdown-toggle {{ $activeSistem ? 'has-active' : '' }}"
                onclick="toggleSidebarDropdown(this)"
                aria-expanded="{{ $activeSistem ? 'true' : 'false' }}"
            >
                <span class="sidebar-dropdown-title">
                    <i class="bi bi-sliders"></i>
                    <span>Sistem & Keamanan</span>
                </span>
                <i class="bi bi-chevron-down sidebar-dropdown-arrow"></i>
            </button>

            <div class="sidebar-dropdown-menu">
                <a
                    href="{{ route('admin.audit-log.index') }}"
                    class="sidebar-link sidebar-sublink {{ request()->routeIs('admin.audit-log.*') ? 'active' : '' }}"
                >
                    <i class="bi bi-journal-text"></i>
                    <span>Audit Log</span>
                </a>

                <a
                    href="{{ route('admin.pengaturan-sistem.index') }}"
                    class="sidebar-link sidebar-sublink {{ request()->routeIs('admin.pengaturan-sistem.*') ? 'active' : '' }}"
                >
                    <i class="bi bi-gear"></i>
                    <span>Pengaturan Sistem</span>
                </a>
            </div>
        </div>

    </nav>


    <div class="sidebar-spacer"></div>


    <div class="sidebar-account">

        <form
            method="POST"
            action="{{ route('logout') }}"
            class="m-0"
        >
            @csrf

            <button
                type="submit"
                class="logout-button"
            >
                <i class="bi bi-box-arrow-right"></i>

                <span>
                    Keluar
                </span>
            </button>

        </form>

    </div>

</aside>

<script>
    function toggleSidebarDropdown(button) {
        const dropdown = button.closest('.sidebar-dropdown');
        if (!dropdown) return;
        const nav = dropdown.closest('.sidebar-nav');
        const willOpen = !dropdown.classList.contains('open');

        if (nav && willOpen) {
            nav.querySelectorAll('.sidebar-dropdown.open').forEach(function (other) {
                if (other !== dropdown) {
                    other.classList.remove('open');
                    other.querySelector('.sidebar-dropdown-toggle')?.setAttribute('aria-expanded', 'false');
                }
            });
        }

        dropdown.classList.toggle('open', willOpen);
        button.setAttribute('aria-expanded', willOpen ? 'true' : 'false');
    }
</script>
