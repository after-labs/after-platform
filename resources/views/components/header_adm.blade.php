@php
    $adminUser = auth()->user();
    $notifications = $adminUser?->notifications()->latest()->limit(6)->get() ?? collect();
    $unreadNotifications = $adminUser?->notifications()->whereNull('read_at')->count() ?? 0;
@endphp

<header>
    @vite(['resources/css/components/header_adm.css'])

    <div class="container">

        <div class="logo">
            <a href="{{ route('admin.dashboard') }}">
                <img src="{{ asset('icons/after-logomarca-branco.svg') }}" alt="After Logo">
            </a>
        </div>

        <nav>
            <ul>
                <li>
                    <a href="{{ route('admin.users.index') }}"
                       class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                        {{ __('Users') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.games.index') }}"
                       class="{{ request()->routeIs('admin.games.*') ? 'active' : '' }}">
                        {{ __('Games') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.orders.index') }}"
                       class="{{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                        {{ __('Orders') }}
                    </a>
                </li>

                <li class="language-item">
                    <form method="GET" action="">
                        <select onchange="window.location.href=this.value" class="language-select">
                            <option value="{{ route('lang.switch', 'pt') }}" {{ session('locale', 'pt') === 'pt' ? 'selected' : '' }}>Português</option>
                            <option value="{{ route('lang.switch', 'en') }}" {{ session('locale', 'en') === 'en' ? 'selected' : '' }}>English</option>
                        </select>
                    </form>
                </li>
            </ul>

            <ul class="icon-group">
                <li>
                    <button type="button" class="notif-trigger nav-action-button" onclick="toggleNotif()">
                        <img src="{{ asset('icons/bell-icon.svg') }}" alt="{{ __('Notifications') }}">
                        @if($unreadNotifications > 0)
                            <span class="notif-count">{{ $unreadNotifications }}</span>
                        @endif
                    </button>
                </li>
                <li>
                    <a href="{{ route('admin.account') }}" class="nav-action-button admin-icon-link">
                        <img src="{{ asset('icons/user-icon.svg') }}" alt="{{ __('Profile') }}">
                    </a>
                </li>
            </ul>
        </nav>

    </div>
</header>

<div id="notif-box" class="notif-box hidden">
    <div class="notif-header">
        <span>{{ __('Notifications') }}</span>
        <button onclick="toggleNotif()">
            <img src="{{ asset('icons/close-icon.svg') }}" alt="close">
        </button>
    </div>
    <div id="notif-list" class="notif-list">
        @forelse($notifications as $notification)
            <div class="notif-item">
                <div class="notif-title">{{ __($notification->title) }}</div>
                <div class="notif-desc">{{ __($notification->description) }}</div>
                <div class="notif-time">{{ $notification->created_at->diffForHumans() }}</div>
            </div>
        @empty
            <div class="notif-item">
                <div class="notif-title">{{ __('No notifications yet') }}</div>
                <div class="notif-desc">{{ __('Your updates will appear here.') }}</div>
            </div>
        @endforelse
    </div>
</div>

<script>
    function toggleNotif() {
        document.getElementById('notif-box').classList.toggle('hidden')
    }
</script>
