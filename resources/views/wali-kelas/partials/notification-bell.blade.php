@php
    $notifikasiWaliKelas = collect();
    $jumlahBelumDibacaWaliKelas = 0;

    if (
        auth()->check()
        && auth()->user()->role === 'homeroom_teacher'
    ) {
        $jumlahBelumDibacaWaliKelas = \App\Models\Notifikasi::query()
            ->where('user_id', auth()->id())
            ->whereNull('read_at')
            ->count();

        $notifikasiWaliKelas = \App\Models\Notifikasi::query()
            ->where('user_id', auth()->id())
            ->latest()
            ->limit(5)
            ->get();
    }
@endphp

<style>
    .wk-notification-dropdown .dropdown-toggle::after {
        display: none;
    }

    .wk-notification-button {
        position: relative;
        width: 40px;
        height: 40px;
        border: 1px solid #e5e9ef;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #fff;
        color: #475467;
        font-size: 17px;
        transition:
            background .15s ease,
            border-color .15s ease,
            color .15s ease;
    }

    .wk-notification-button:hover,
    .wk-notification-button:focus {
        background: #f4faf9;
        border-color: #cfe5e2;
        color: #0b6f69;
    }

    .wk-notification-badge {
        position: absolute;
        top: -5px;
        right: -5px;
        min-width: 18px;
        height: 18px;
        padding: 0 5px;
        border: 2px solid #fff;
        border-radius: 999px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #d92d20;
        color: #fff;
        font-size: 9px;
        line-height: 1;
        font-weight: 750;
    }

    .wk-notification-menu {
        width: 370px;
        max-width: calc(100vw - 28px);
        margin-top: 10px !important;
        padding: 0;
        overflow: hidden;
        border: 1px solid #e5e9ef;
        border-radius: 13px;
        box-shadow: 0 16px 38px rgba(16, 24, 40, .12);
    }

    .wk-notification-header {
        min-height: 58px;
        padding: 13px 15px;
        border-bottom: 1px solid #eef1f4;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        background: #fff;
    }

    .wk-notification-title {
        color: #172033;
        font-size: 13px;
        font-weight: 720;
    }

    .wk-notification-subtitle {
        margin-top: 2px;
        color: #8a94a3;
        font-size: 10.5px;
    }

    .wk-read-all {
        padding: 0;
        border: 0;
        background: transparent;
        color: #0b6f69;
        font-size: 10.5px;
        font-weight: 650;
        white-space: nowrap;
    }

    .wk-read-all:hover {
        text-decoration: underline;
    }

    .wk-notification-list {
        max-height: 355px;
        overflow-y: auto;
        background: #fff;
    }

    .wk-notification-item {
        position: relative;
        padding: 13px 15px;
        border-bottom: 1px solid #f0f2f4;
        display: flex;
        gap: 11px;
        background: #fff;
    }

    .wk-notification-item.unread {
        background: #f6fbfa;
    }

    .wk-notification-item:last-child {
        border-bottom: 0;
    }

    .wk-notification-icon {
        width: 34px;
        height: 34px;
        flex: 0 0 34px;
        border-radius: 9px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #eaf7f5;
        color: #0b6f69;
        font-size: 14px;
    }

    .wk-notification-content {
        min-width: 0;
        flex: 1;
    }

    .wk-notification-item-title {
        padding-right: 12px;
        color: #344054;
        font-size: 11.5px;
        line-height: 1.4;
        font-weight: 680;
    }

    .wk-notification-message {
        margin-top: 3px;
        color: #667085;
        font-size: 10.5px;
        line-height: 1.5;
    }

    .wk-notification-meta {
        margin-top: 7px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
    }

    .wk-notification-time {
        color: #98a2b3;
        font-size: 9.5px;
    }

    .wk-mark-read {
        padding: 0;
        border: 0;
        background: transparent;
        color: #0b6f69;
        font-size: 9.5px;
        font-weight: 650;
    }

    .wk-mark-read:hover {
        text-decoration: underline;
    }

    .wk-unread-dot {
        position: absolute;
        top: 15px;
        right: 14px;
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #0f8a83;
    }

    .wk-notification-empty {
        padding: 32px 18px;
        text-align: center;
        background: #fff;
    }

    .wk-notification-empty-icon {
        width: 42px;
        height: 42px;
        margin: 0 auto 10px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f2f5f5;
        color: #98a2b3;
        font-size: 17px;
    }

    .wk-notification-empty-title {
        color: #475467;
        font-size: 11.5px;
        font-weight: 680;
    }

    .wk-notification-empty-copy {
        max-width: 250px;
        margin: 4px auto 0;
        color: #98a2b3;
        font-size: 10px;
        line-height: 1.5;
    }

    @media (max-width: 575.98px) {
        .wk-notification-menu {
            width: 330px;
        }
    }
</style>

<div class="dropdown wk-notification-dropdown">

    <button
        class="wk-notification-button dropdown-toggle"
        type="button"
        data-bs-toggle="dropdown"
        data-bs-auto-close="outside"
        aria-expanded="false"
        aria-label="Buka notifikasi Wali Kelas"
    >
        <i class="bi bi-bell"></i>

        @if ($jumlahBelumDibacaWaliKelas > 0)
            <span class="wk-notification-badge">
                {{ $jumlahBelumDibacaWaliKelas > 99
                    ? '99+'
                    : $jumlahBelumDibacaWaliKelas }}
            </span>
        @endif
    </button>

    <div class="dropdown-menu dropdown-menu-end wk-notification-menu">

        <div class="wk-notification-header">

            <div>
                <div class="wk-notification-title">
                    Notifikasi
                </div>

                <div class="wk-notification-subtitle">
                    Informasi umum terkait kelas Anda
                </div>
            </div>

            @if ($jumlahBelumDibacaWaliKelas > 0)
                <form
                    method="POST"
                    action="{{ route('wali-kelas.notifikasi.read-all') }}"
                    class="m-0"
                >
                    @csrf
                    @method('PATCH')

                    <button
                        type="submit"
                        class="wk-read-all"
                    >
                        Tandai semua dibaca
                    </button>
                </form>
            @endif

        </div>

        <div class="wk-notification-list">

            @forelse ($notifikasiWaliKelas as $item)

                <div
                    class="wk-notification-item {{ is_null($item->read_at) ? 'unread' : '' }}"
                >
                    <span class="wk-notification-icon">
                        @if ($item->tipe === 'kasus_kelas_baru')
                            <i class="bi bi-bar-chart-line"></i>
                        @elseif ($item->tipe === 'partisipasi_skrining_rendah')
                            <i class="bi bi-clipboard2-check"></i>
                        @else
                            <i class="bi bi-bell"></i>
                        @endif
                    </span>

                    <div class="wk-notification-content">

                        <div class="wk-notification-item-title">
                            {{ $item->judul }}
                        </div>

                        <div class="wk-notification-message">
                            {{ $item->pesan }}
                        </div>

                        <div class="wk-notification-meta">

                            <span class="wk-notification-time">
                                {{ $item->created_at
                                    ? $item->created_at->locale('id')->diffForHumans()
                                    : '-' }}
                            </span>

                            @if (is_null($item->read_at))
                                <form
                                    method="POST"
                                    action="{{ route('wali-kelas.notifikasi.read', $item) }}"
                                    class="m-0"
                                >
                                    @csrf
                                    @method('PATCH')

                                    <button
                                        type="submit"
                                        class="wk-mark-read"
                                    >
                                        Tandai dibaca
                                    </button>
                                </form>
                            @endif

                        </div>

                    </div>

                    @if (is_null($item->read_at))
                        <span class="wk-unread-dot"></span>
                    @endif

                </div>

            @empty

                <div class="wk-notification-empty">

                    <div class="wk-notification-empty-icon">
                        <i class="bi bi-bell-slash"></i>
                    </div>

                    <div class="wk-notification-empty-title">
                        Belum ada notifikasi
                    </div>

                    <div class="wk-notification-empty-copy">
                        Informasi umum mengenai kelas Anda akan muncul
                        di sini ketika tersedia.
                    </div>

                </div>

            @endforelse

        </div>

    </div>

</div>
