@php
    $adminUnreadNotificationCount = \App\Models\Notifikasi::query()
        ->where('user_id', auth()->id())
        ->whereNull('read_at')
        ->count();
@endphp

<a
    href="{{ route('admin.notifikasi.index') }}"
    title="Notifikasi Admin"
    aria-label="Notifikasi Admin{{ $adminUnreadNotificationCount > 0 ? ', ' . $adminUnreadNotificationCount . ' belum dibaca' : '' }}"
    style="
        width:38px;
        height:38px;
        border:1px solid #e3e9e9;
        border-radius:9px;
        display:inline-flex;
        align-items:center;
        justify-content:center;
        position:relative;
        background:#ffffff;
        color:#667085;
        flex:0 0 38px;
        text-decoration:none;
    "
>
    <i class="bi bi-bell"></i>

    @if($adminUnreadNotificationCount > 0)
        <span
            style="
                position:absolute;
                top:-6px;
                right:-6px;
                min-width:19px;
                height:19px;
                padding:0 5px;
                border:2px solid #ffffff;
                border-radius:999px;
                display:inline-flex;
                align-items:center;
                justify-content:center;
                background:#d92d20;
                color:#ffffff;
                font-size:9px;
                font-weight:700;
                line-height:1;
            "
        >
            {{ $adminUnreadNotificationCount > 99 ? '99+' : $adminUnreadNotificationCount }}
        </span>
    @endif
</a>
