@php
    $currentBkUser = auth()->user();
    $namaBkUser = $currentBkUser ? ucwords($currentBkUser->name) : 'Guru BK';
    $inisialBkUser = $currentBkUser ? strtoupper(substr($currentBkUser->name, 0, 1)) : 'G';
@endphp
<header class="topbar">
    <div class="topbar-left">
        <button
            type="button"
            class="mobile-sidebar-button"
            id="openSidebarButton"
            aria-label="Buka menu"
        >
            <i class="bi bi-list"></i>
        </button>
        <div>
            <div class="topbar-title">
                {{ $topbarTitle ?? 'Portal Guru BK' }}
            </div>
            <div class="topbar-subtitle">
                {{ $topbarSubtitle ?? 'CurhatAman - Bimbingan & Konseling' }}
            </div>
        </div>
    </div>

    <div class="topbar-actions">
        @include('guru-bk.partials.notification-bell')

        <div class="date-chip">
            <i class="bi bi-calendar3"></i>
            {{ now()->locale('id')->translatedFormat('d F Y') }}
        </div>

        <a
            href="{{ route('guru-bk.profil.index') }}"
            class="account-trigger"
            aria-label="Buka profil Guru BK"
        >
            <span class="topbar-avatar">
                {{ $inisialBkUser }}
            </span>
            <span class="account-copy">
                <span class="account-name d-block">
                    {{ $namaBkUser }}
                </span>
                <span class="account-role d-block">
                    Guru BK
                </span>
            </span>
            <i class="bi bi-chevron-right account-chevron"></i>
        </a>
    </div>
</header>
