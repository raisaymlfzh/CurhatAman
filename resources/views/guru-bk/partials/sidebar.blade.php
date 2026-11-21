@php
    $currentBkUser = auth()->user();
    $namaBkUser = $currentBkUser ? ucwords($currentBkUser->name) : 'Guru BK';

    $activePenangananBk = request()->routeIs(
        'guru-bk.laporan.*',
        'guru-bk.bantuan.*',
        'guru-bk.catatan-konseling.*',
        'guru-bk.rujukan.*'
    );
    $activeAsesmenBk = request()->routeIs(
        'guru-bk.skrining.*',
        'guru-bk.data-siswa.*'
    );
    $activeAnalisisBk = request()->routeIs(
        'guru-bk.statistik.*'
    );

    // Hitung item antrean yang berstatus 'baru'
    $badgeLaporanBaru = \Illuminate\Support\Facades\DB::table('laporan_kasus')
        ->where('status_kasus', 'baru')
        ->count();

    $badgeBantuanBaru = \Illuminate\Support\Facades\DB::table('permintaan_bantuan')
        ->where('status', 'baru')
        ->count();

    $totalPenangananBaru = $badgeLaporanBaru + $badgeBantuanBaru;
@endphp

<style>
    #bkSidebar .sidebar-dropdown {
        margin-top: 4px !important;
    }

    #bkSidebar .sidebar-dropdown-toggle {
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

    #bkSidebar .sidebar-dropdown-toggle:hover {
        color: var(--ca-primary) !important;
        background: #f8fafb !important;
    }

    #bkSidebar .sidebar-dropdown.open .sidebar-dropdown-toggle {
        color: var(--ca-primary-dark) !important;
        background: var(--ca-primary-soft) !important;
        font-weight: 680 !important;
    }

    #bkSidebar .sidebar-dropdown-title {
        display: inline-flex !important;
        align-items: center !important;
        gap: 10px !important;
        min-width: 0 !important;
    }

    #bkSidebar .sidebar-dropdown-title i {
        width: 18px !important;
        color: #667085 !important;
        font-size: 15px !important;
        text-align: center !important;
    }

    #bkSidebar .sidebar-dropdown-toggle:hover .sidebar-dropdown-title i,
    #bkSidebar .sidebar-dropdown.open .sidebar-dropdown-toggle .sidebar-dropdown-title i {
        color: var(--ca-primary) !important;
    }

    #bkSidebar .sidebar-dropdown-arrow {
        font-size: 11px !important;
        color: #98a2b3 !important;
        transition: transform .2s ease, color .15s ease !important;
    }

    #bkSidebar .sidebar-dropdown.open .sidebar-dropdown-arrow {
        transform: rotate(180deg) !important;
        color: var(--ca-primary) !important;
    }

    #bkSidebar .sidebar-dropdown-menu {
        display: none !important;
        padding: 4px 0 4px 12px !important;
        margin-top: 2px !important;
        margin-left: 19px !important;
        border-left: 1.5px solid #e6efef !important;
    }

    #bkSidebar .sidebar-dropdown.open .sidebar-dropdown-menu {
        display: block !important;
    }

    #bkSidebar .sidebar-sublink {
        min-height: 35px !important;
        height: 35px !important;
        padding: 0 10px !important;
        font-size: 12.3px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
    }

    #bkSidebar .sidebar-sublink-content {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        min-width: 0;
    }

    .sidebar-badge-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background-color: #ef4444;
        display: inline-block;
        box-shadow: 0 0 0 2px rgba(239, 68, 68, 0.2);
    }

    #bkSidebar .sidebar-dropdown.open .sidebar-badge-dot-toggle {
        display: none !important;
    }

    .sidebar-badge-counter {
        min-width: 15px;
        height: 15px;
        padding: 0 4px;
        border-radius: 999px;
        background-color: #fee2e2;
        color: #b91c1c;
        font-size: 9.5px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        line-height: 1;
    }
</style>

<aside class="sidebar" id="bkSidebar">
    <a href="{{ route('guru-bk.dashboard') }}" class="sidebar-brand">
        <span class="brand-symbol">
            <i class="bi bi-people-fill"></i>
        </span>
        <span>
            <span class="brand-name">CurhatAman</span>
            <span class="brand-role">Portal Guru BK</span>
        </span>
    </a>

    <div class="sidebar-section-label">
        Menu Utama
    </div>

    <nav class="sidebar-nav">
        <a href="{{ route('guru-bk.dashboard') }}" class="sidebar-link {{ request()->routeIs('guru-bk.dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid-1x2"></i>
            <span>Dashboard</span>
        </a>

        <!-- Grup 1: Penanganan & Layanan BK -->
        <div class="sidebar-dropdown {{ $activePenangananBk ? 'open' : '' }}">
            <button
                type="button"
                class="sidebar-dropdown-toggle {{ $activePenangananBk ? 'has-active' : '' }}"
                onclick="toggleBkSidebarDropdown(this)"
                aria-expanded="{{ $activePenangananBk ? 'true' : 'false' }}"
            >
                <span class="sidebar-dropdown-title">
                    <i class="bi bi-heart-pulse"></i>
                    <span>Penanganan & Layanan</span>
                </span>
                <span class="d-inline-flex align-items-center gap-2">
                    @if ($totalPenangananBaru > 0)
                        <span class="sidebar-badge-dot sidebar-badge-dot-toggle" title="{{ $totalPenangananBaru }} kasus/bantuan baru"></span>
                    @endif
                    <i class="bi bi-chevron-down sidebar-dropdown-arrow"></i>
                </span>
            </button>

            <div class="sidebar-dropdown-menu">
                <a href="{{ route('guru-bk.laporan.index') }}" class="sidebar-link sidebar-sublink {{ request()->routeIs('guru-bk.laporan.*') ? 'active' : '' }}">
                    <span class="sidebar-sublink-content">
                        <i class="bi bi-shield-exclamation"></i>
                        <span>Laporan Kasus</span>
                    </span>
                    @if ($badgeLaporanBaru > 0)
                        <span class="sidebar-badge-counter">{{ $badgeLaporanBaru }}</span>
                    @endif
                </a>

                <a href="{{ route('guru-bk.bantuan.index') }}" class="sidebar-link sidebar-sublink {{ request()->routeIs('guru-bk.bantuan.*') ? 'active' : '' }}">
                    <span class="sidebar-sublink-content">
                        <i class="bi bi-chat-heart"></i>
                        <span>Permintaan Bantuan</span>
                    </span>
                    @if ($badgeBantuanBaru > 0)
                        <span class="sidebar-badge-counter">{{ $badgeBantuanBaru }}</span>
                    @endif
                </a>

                <a href="{{ route('guru-bk.catatan-konseling.index') }}" class="sidebar-link sidebar-sublink {{ request()->routeIs('guru-bk.catatan-konseling.*') ? 'active' : '' }}">
                    <span class="sidebar-sublink-content">
                        <i class="bi bi-journal-bookmark"></i>
                        <span>Catatan Konseling</span>
                    </span>
                </a>

                <a href="{{ route('guru-bk.rujukan.index') }}" class="sidebar-link sidebar-sublink {{ request()->routeIs('guru-bk.rujukan.*') ? 'active' : '' }}">
                    <span class="sidebar-sublink-content">
                        <i class="bi bi-arrow-up-right-circle"></i>
                        <span>Rujukan</span>
                    </span>
                </a>
            </div>
        </div>

        <!-- Grup 2: Asesmen & Data Siswa -->
        <div class="sidebar-dropdown {{ $activeAsesmenBk ? 'open' : '' }}">
            <button
                type="button"
                class="sidebar-dropdown-toggle {{ $activeAsesmenBk ? 'has-active' : '' }}"
                onclick="toggleBkSidebarDropdown(this)"
                aria-expanded="{{ $activeAsesmenBk ? 'true' : 'false' }}"
            >
                <span class="sidebar-dropdown-title">
                    <i class="bi bi-clipboard2-data"></i>
                    <span>Asesmen & Data Siswa</span>
                </span>
                <i class="bi bi-chevron-down sidebar-dropdown-arrow"></i>
            </button>

            <div class="sidebar-dropdown-menu">
                <a href="{{ route('guru-bk.skrining.index') }}" class="sidebar-link sidebar-sublink {{ request()->routeIs('guru-bk.skrining.*') ? 'active' : '' }}">
                    <span class="sidebar-sublink-content">
                        <i class="bi bi-clipboard2-pulse"></i>
                        <span>Skrining SDQ</span>
                    </span>
                </a>

                <a href="{{ route('guru-bk.data-siswa.index') }}" class="sidebar-link sidebar-sublink {{ request()->routeIs('guru-bk.data-siswa.*') ? 'active' : '' }}">
                    <span class="sidebar-sublink-content">
                        <i class="bi bi-mortarboard"></i>
                        <span>Data Siswa</span>
                    </span>
                </a>
            </div>
        </div>

        <!-- Grup 3: Analisis & Evaluasi -->
        <div class="sidebar-dropdown {{ $activeAnalisisBk ? 'open' : '' }}">
            <button
                type="button"
                class="sidebar-dropdown-toggle {{ $activeAnalisisBk ? 'has-active' : '' }}"
                onclick="toggleBkSidebarDropdown(this)"
                aria-expanded="{{ $activeAnalisisBk ? 'true' : 'false' }}"
            >
                <span class="sidebar-dropdown-title">
                    <i class="bi bi-pie-chart"></i>
                    <span>Analisis & Evaluasi</span>
                </span>
                <i class="bi bi-chevron-down sidebar-dropdown-arrow"></i>
            </button>

            <div class="sidebar-dropdown-menu">
                <a href="{{ route('guru-bk.statistik.index') }}" class="sidebar-link sidebar-sublink {{ request()->routeIs('guru-bk.statistik.*') ? 'active' : '' }}">
                    <span class="sidebar-sublink-content">
                        <i class="bi bi-bar-chart-line"></i>
                        <span>Statistik</span>
                    </span>
                </a>
            </div>
        </div>
    </nav>

    <div class="sidebar-spacer"></div>

    <div class="sidebar-account">
        <form method="POST" action="{{ route('logout') }}" class="m-0">
            @csrf
            <button type="submit" class="logout-button">
                <i class="bi bi-box-arrow-right"></i>
                <span>Keluar</span>
            </button>
        </form>
    </div>
</aside>

<script>
    function toggleBkSidebarDropdown(button) {
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
