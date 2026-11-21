@php
    $activePerwalianWk = request()->routeIs('wali-kelas.siswa.*');
    $activeStatistikWk = request()->routeIs('wali-kelas.ringkasan.*', 'wali-kelas.skrining.*');
    $queryParamsWk = array_filter([
        'tahun_ajaran' => $tahunAjaran ?? null,
        'semester' => $semester ?? null,
        'kelas_id' => $kelasId ?? null,
    ], fn ($val) => ! is_null($val) && $val !== '');
@endphp

<aside class="sidebar" id="waliSidebar">
    <style>
        #waliSidebar .sidebar-dropdown {
            margin-top: 4px !important;
        }

        #waliSidebar .sidebar-dropdown-toggle {
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

        #waliSidebar .sidebar-dropdown-toggle:hover {
            color: var(--ca-primary) !important;
            background: #f8fafb !important;
        }

        #waliSidebar .sidebar-dropdown.open .sidebar-dropdown-toggle {
            color: var(--ca-primary-dark) !important;
            background: var(--ca-primary-soft) !important;
            font-weight: 680 !important;
        }

        #waliSidebar .sidebar-dropdown-title {
            display: inline-flex !important;
            align-items: center !important;
            gap: 10px !important;
            min-width: 0 !important;
        }

        #waliSidebar .sidebar-dropdown-title i {
            width: 18px !important;
            color: #667085 !important;
            font-size: 15px !important;
            text-align: center !important;
        }

        #waliSidebar .sidebar-dropdown-toggle:hover .sidebar-dropdown-title i,
        #waliSidebar .sidebar-dropdown.open .sidebar-dropdown-toggle .sidebar-dropdown-title i {
            color: var(--ca-primary) !important;
        }

        #waliSidebar .sidebar-dropdown-arrow {
            font-size: 11px !important;
            color: #98a2b3 !important;
            transition: transform .2s ease, color .15s ease !important;
        }

        #waliSidebar .sidebar-dropdown.open .sidebar-dropdown-arrow {
            transform: rotate(180deg) !important;
            color: var(--ca-primary) !important;
        }

        #waliSidebar .sidebar-dropdown-menu {
            display: none !important;
            padding: 4px 0 4px 12px !important;
            margin-top: 2px !important;
            margin-left: 19px !important;
            border-left: 1.5px solid #e6efef !important;
        }

        #waliSidebar .sidebar-dropdown.open .sidebar-dropdown-menu {
            display: block !important;
        }

        #waliSidebar .sidebar-sublink {
            min-height: 35px !important;
            height: 35px !important;
            padding: 0 10px !important;
            font-size: 12.3px !important;
        }
    </style>

    <a
        href="{{ route('wali-kelas.dashboard', $queryParamsWk) }}"
        class="sidebar-brand"
    >
        <span class="brand-symbol">
            <i class="bi bi-people-fill"></i>
        </span>

        <span class="brand-copy">
            <span class="brand-name">
                CurhatAman
            </span>

            <span class="brand-role">
                Portal Wali Kelas
            </span>
        </span>
    </a>

    <div class="sidebar-section-label">
        Menu Utama
    </div>

    <nav class="sidebar-nav">
        <a
            href="{{ route('wali-kelas.dashboard', $queryParamsWk) }}"
            class="sidebar-link {{ request()->routeIs('wali-kelas.dashboard') ? 'active' : '' }}"
            @if(request()->routeIs('wali-kelas.dashboard')) aria-current="page" @endif
        >
            <i class="bi bi-grid-1x2"></i>
            <span>Dashboard</span>
        </a>

        <!-- Grup 1: Data Perwalian -->
        <div class="sidebar-dropdown {{ $activePerwalianWk ? 'open' : '' }}">
            <button
                type="button"
                class="sidebar-dropdown-toggle {{ $activePerwalianWk ? 'has-active' : '' }}"
                onclick="toggleWkSidebarDropdown(this)"
                aria-expanded="{{ $activePerwalianWk ? 'true' : 'false' }}"
            >
                <span class="sidebar-dropdown-title">
                    <i class="bi bi-folder2-open"></i>
                    <span>Data Perwalian</span>
                </span>
                <i class="bi bi-chevron-down sidebar-dropdown-arrow"></i>
            </button>

            <div class="sidebar-dropdown-menu">
                <a
                    href="{{ route('wali-kelas.siswa.index', $queryParamsWk) }}"
                    class="sidebar-link sidebar-sublink {{ request()->routeIs('wali-kelas.siswa.*') ? 'active' : '' }}"
                >
                    <i class="bi bi-people"></i>
                    <span>Daftar Siswa</span>
                </a>
            </div>
        </div>

        <!-- Grup 2: Pemantauan & Statistik -->
        <div class="sidebar-dropdown {{ $activeStatistikWk ? 'open' : '' }}">
            <button
                type="button"
                class="sidebar-dropdown-toggle {{ $activeStatistikWk ? 'has-active' : '' }}"
                onclick="toggleWkSidebarDropdown(this)"
                aria-expanded="{{ $activeStatistikWk ? 'true' : 'false' }}"
            >
                <span class="sidebar-dropdown-title">
                    <i class="bi bi-graph-up"></i>
                    <span>Pemantauan & Statistik</span>
                </span>
                <i class="bi bi-chevron-down sidebar-dropdown-arrow"></i>
            </button>

            <div class="sidebar-dropdown-menu">
                <a
                    href="{{ route('wali-kelas.ringkasan.index', $queryParamsWk) }}"
                    class="sidebar-link sidebar-sublink {{ request()->routeIs('wali-kelas.ringkasan.*') ? 'active' : '' }}"
                >
                    <i class="bi bi-bar-chart-line"></i>
                    <span>Ringkasan Kelas</span>
                </a>

                <a
                    href="{{ route('wali-kelas.skrining.index', $queryParamsWk) }}"
                    class="sidebar-link sidebar-sublink {{ request()->routeIs('wali-kelas.skrining.*') ? 'active' : '' }}"
                >
                    <i class="bi bi-clipboard2-check"></i>
                    <span>Partisipasi Skrining</span>
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
                <span>Keluar</span>
            </button>
        </form>
    </div>

    <script>
        function toggleWkSidebarDropdown(button) {
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
</aside>
