@php
    use App\Models\Notifikasi;

    $notificationUser = auth()->user();

    $notificationUnreadCount = 0;
    $notificationLatest = collect();

    if ($notificationUser && $notificationUser->role === 'counselor') {
        $notificationUnreadCount = Notifikasi::where('user_id', $notificationUser->id)
            ->whereNull('read_at')
            ->count();

        $notificationLatest = Notifikasi::where('user_id', $notificationUser->id)
            ->latest()
            ->limit(5)
            ->get();
    }
@endphp

<style>
    .bk-notification-dropdown .dropdown-toggle::after {
        display: none;
    }

    .bk-notification-button {
        position: relative;
        width: 38px;
        height: 38px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid var(--ca-border, #e3e9e9);
        border-radius: 9px;
        color: #596579;
        background: #ffffff;
        font-size: .92rem;
    }

    .bk-notification-button:hover,
    .bk-notification-button:focus {
        color: var(--ca-primary-dark, #0b6f69);
        border-color: #bfd8d5;
        background: #f8fbfb;
        box-shadow: none;
    }

    .bk-notification-badge {
        position: absolute;
        top: -5px;
        right: -5px;
        min-width: 18px;
        height: 18px;
        padding: 0 5px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 2px solid #ffffff;
        border-radius: 999px;
        color: #ffffff;
        background: #d92d20;
        font-size: .62rem;
        font-weight: 750;
        line-height: 1;
    }

    .bk-notification-menu {
        width: 360px;
        max-width: calc(100vw - 28px);
        margin-top: 10px !important;
        padding: 0;
        overflow: hidden;
        border: 1px solid #e2e8e8;
        border-radius: 12px;
        background: #ffffff;
        box-shadow: 0 18px 45px rgba(15, 23, 42, .12);
    }

    .bk-notification-header {
        padding: 14px 16px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        border-bottom: 1px solid #edf1f1;
    }

    .bk-notification-header-title {
        color: #172033;
        font-size: .84rem;
        font-weight: 720;
    }

    .bk-notification-header-count {
        color: #667085;
        font-size: .72rem;
    }

    .bk-notification-list {
        max-height: 355px;
        overflow-y: auto;
    }

    .bk-notification-item {
        position: relative;
        display: flex;
        align-items: flex-start;
        gap: 10px;
        padding: 0;
        border-bottom: 1px solid #f0f2f2;
        background: #ffffff;
    }

    .bk-notification-item:last-child {
        border-bottom: 0;
    }

    .bk-notification-item.unread {
        background: #fbfefe;
    }

    .bk-notification-item.clickable:hover {
        background: #f4faf9;
    }

    .bk-notification-main {
        min-width: 0;
        flex: 1;
        padding: 13px 16px;
        display: flex;
        align-items: flex-start;
        gap: 10px;
        color: inherit;
        text-decoration: none;
    }

    .bk-notification-main:hover {
        color: inherit;
        text-decoration: none;
    }

    .bk-notification-dot {
        width: 8px;
        height: 8px;
        margin-top: 5px;
        flex: 0 0 8px;
        border-radius: 50%;
        background: var(--ca-primary, #0f8a83);
    }

    .bk-notification-item:not(.unread) .bk-notification-dot {
        background: #d0d5dd;
    }

    .bk-notification-copy {
        min-width: 0;
        flex: 1;
    }

    .bk-notification-title {
        color: #243043;
        font-size: .77rem;
        font-weight: 680;
        line-height: 1.4;
    }

    .bk-notification-message {
        margin-top: 3px;
        display: -webkit-box;
        overflow: hidden;
        color: #667085;
        font-size: .72rem;
        line-height: 1.45;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }

    .bk-notification-time {
        margin-top: 5px;
        color: #98a2b3;
        font-size: .67rem;
    }

    .bk-notification-open-hint {
        margin-top: 5px;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        color: var(--ca-primary-dark, #0b6f69);
        font-size: .67rem;
        font-weight: 650;
    }

    .bk-notification-actions {
        padding: 13px 14px 13px 0;
        flex: 0 0 auto;
    }

    .bk-notification-mark {
        padding: 0;
        border: 0;
        color: var(--ca-primary-dark, #0b6f69);
        background: transparent;
        font-size: .68rem;
        font-weight: 650;
        white-space: nowrap;
    }

    .bk-notification-empty {
        padding: 34px 18px;
        color: #8a94a3;
        text-align: center;
        font-size: .75rem;
    }

    .bk-notification-empty i {
        display: block;
        margin-bottom: 8px;
        font-size: 1.25rem;
    }

    .bk-notification-footer {
        padding: 11px 14px;
        border-top: 1px solid #edf1f1;
        background: #fbfcfc;
        text-align: center;
    }

    .bk-notification-footer a {
        color: var(--ca-primary-dark, #0b6f69);
        font-size: .73rem;
        font-weight: 680;
    }

    @media (max-width: 575.98px) {
        .bk-notification-menu {
            width: min(360px, calc(100vw - 24px));
        }

        .bk-notification-item {
            align-items: stretch;
            flex-direction: column;
            gap: 0;
        }

        .bk-notification-actions {
            padding: 0 16px 12px 34px;
        }
    }
</style>

<div class="dropdown bk-notification-dropdown">

    <button
        type="button"
        class="bk-notification-button dropdown-toggle"
        data-bs-toggle="dropdown"
        data-bs-auto-close="outside"
        aria-expanded="false"
        aria-label="Buka notifikasi"
        title="Notifikasi"
    >
        <i class="bi bi-bell"></i>

        @if($notificationUnreadCount > 0)
            <span class="bk-notification-badge">
                {{ $notificationUnreadCount > 9 ? '9+' : $notificationUnreadCount }}
            </span>
        @endif
    </button>

    <div class="dropdown-menu dropdown-menu-end bk-notification-menu">

        <div class="bk-notification-header">
            <span class="bk-notification-header-title">
                Notifikasi
            </span>

            <span class="bk-notification-header-count">
                {{ $notificationUnreadCount }} belum dibaca
            </span>
        </div>

        <div class="bk-notification-list">

            @forelse($notificationLatest as $notificationItem)

                @php
                    $notificationTargetUrl = null;
                    $hintText = 'Buka detail';

                    if (
                        $notificationItem->referensi_tipe === 'laporan_kasus'
                        && $notificationItem->referensi_id
                    ) {
                        $notificationTargetUrl = route(
                            'guru-bk.laporan.show',
                            $notificationItem->referensi_id
                        );
                        $hintText = 'Buka laporan';
                    } elseif (
                        $notificationItem->referensi_tipe === 'permintaan_bantuan'
                        && $notificationItem->referensi_id
                    ) {
                        $notificationTargetUrl = route(
                            'guru-bk.bantuan.show',
                            $notificationItem->referensi_id
                        );
                        $hintText = 'Buka permintaan bantuan';
                    } elseif (
                        $notificationItem->referensi_tipe === 'catatan_konseling'
                        && $notificationItem->referensi_id
                    ) {
                        $notificationTargetUrl = route(
                            'guru-bk.catatan-konseling.show',
                            $notificationItem->referensi_id
                        );
                        $hintText = 'Buka catatan konseling';
                    }
                @endphp

                <div class="bk-notification-item {{ is_null($notificationItem->read_at) ? 'unread' : '' }} {{ $notificationTargetUrl ? 'clickable' : '' }}">

                    @if($notificationTargetUrl)
                        <a
                            href="{{ $notificationTargetUrl }}"
                            class="bk-notification-main"
                            title="{{ $hintText }}"
                            @if(is_null($notificationItem->read_at))
                                data-notification-link
                                data-read-url="{{ route('guru-bk.notifikasi.read', $notificationItem) }}"
                            @endif
                        >
                            <span class="bk-notification-dot"></span>

                            <span class="bk-notification-copy">
                                <span class="bk-notification-title d-block">
                                    {{ $notificationItem->judul }}
                                </span>

                                <span class="bk-notification-message d-block">
                                    {{ $notificationItem->pesan }}
                                </span>

                                <span class="bk-notification-time d-block">
                                    {{ $notificationItem->created_at->locale('id')->diffForHumans() }}
                                </span>

                                <span class="bk-notification-open-hint">
                                    <i class="bi bi-box-arrow-up-right"></i>
                                    {{ $hintText }}
                                </span>
                            </span>
                        </a>
                    @else
                        <div class="bk-notification-main">
                            <span class="bk-notification-dot"></span>

                            <span class="bk-notification-copy">
                                <span class="bk-notification-title d-block">
                                    {{ $notificationItem->judul }}
                                </span>

                                <span class="bk-notification-message d-block">
                                    {{ $notificationItem->pesan }}
                                </span>

                                <span class="bk-notification-time d-block">
                                    {{ $notificationItem->created_at->locale('id')->diffForHumans() }}
                                </span>
                            </span>
                        </div>
                    @endif

                    @if(is_null($notificationItem->read_at))
                        <div class="bk-notification-actions">
                            <form
                                method="POST"
                                action="{{ route('guru-bk.notifikasi.read', $notificationItem) }}"
                                class="m-0"
                            >
                                @csrf
                                @method('PATCH')

                                <button
                                    type="submit"
                                    class="bk-notification-mark"
                                >
                                    Tandai dibaca
                                </button>
                            </form>
                        </div>
                    @endif

                </div>

            @empty

                <div class="bk-notification-empty">
                    <i class="bi bi-bell-slash"></i>
                    Belum ada notifikasi.
                </div>

            @endforelse

        </div>

        <div class="bk-notification-footer">
            <a href="{{ route('guru-bk.notifikasi.index') }}">
                Lihat semua notifikasi
            </a>
        </div>

    </div>

</div>

<script>
    document.addEventListener('click', async function (event) {
        const link = event.target.closest('[data-notification-link]');

        if (!link) {
            return;
        }

        event.preventDefault();

        const targetUrl = link.getAttribute('href');
        const readUrl = link.dataset.readUrl;

        if (!readUrl) {
            window.location.href = targetUrl;
            return;
        }

        link.style.pointerEvents = 'none';

        try {
            const response = await fetch(readUrl, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': @json(csrf_token()),
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'text/html,application/xhtml+xml'
                },
                credentials: 'same-origin'
            });

            if (response.ok) {
                const item = link.closest('.bk-notification-item');
                const badge = document.querySelector('.bk-notification-badge');
                const countLabel = document.querySelector('.bk-notification-header-count');

                item?.classList.remove('unread');
                link.removeAttribute('data-notification-link');
                link.removeAttribute('data-read-url');

                if (badge) {
                    const currentCount = Number(
                        badge.textContent.replace('+', '').trim()
                    );

                    if (!Number.isNaN(currentCount)) {
                        const nextCount = Math.max(currentCount - 1, 0);

                        if (nextCount === 0) {
                            badge.remove();
                        } else {
                            badge.textContent = nextCount > 9
                                ? '9+'
                                : String(nextCount);
                        }

                        if (countLabel) {
                            countLabel.textContent =
                                `${nextCount} belum dibaca`;
                        }
                    }
                }
            }
        } finally {
            window.location.href = targetUrl;
        }
    });
</script>
