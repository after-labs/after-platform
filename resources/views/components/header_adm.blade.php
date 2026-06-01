<header>
    @vite(['resources/css/components/header_adm.css'])

    <div class="container">

        {{-- Logo --}}
        <div class="logo">
            <a href="{{ route('admin.dashboard') }}">
                <img src="{{ asset('icons/after-logomarca-branco.svg') }}" alt="After Logo">
            </a>
        </div>

        

        {{-- Nav central --}}
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

                <li>
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
                    </button>
                </li>
                <li>
                    <a href="{{ route('profile.edit') }}" class="nav-action-button">
                        <img src="{{ asset('icons/user-icon.svg') }}" alt="{{ __('Profile') }}">
                    </a>
                </li>
            </ul>
        </nav>

    </div>
</header>

{{-- Notification popup (idêntico ao client) --}}
<div id="notif-box" class="notif-box hidden">
    <div class="notif-header">
        <span>{{ __('Notifications') }}</span>
        <button onclick="toggleNotif()">
            <img src="{{ asset('icons/close-icon.svg') }}" alt="close">
        </button>
    </div>
    <div id="notif-list" class="notif-list"></div>
</div>

<script>
    function toggleNotif() {
        document.getElementById('notif-box').classList.toggle('hidden')
    }

    const adminNotifications = [
        { title: '{{ __('New Order') }}',  desc: '{{ __('A new purchase was completed') }}',  time: 'now' },
        { title: '{{ __('New User') }}',   desc: '{{ __('A new account was registered') }}',  time: '5m ago' },
        { title: '{{ __('Low Stock') }}',  desc: '{{ __('One version is running low') }}',    time: '1h ago' },
        { title: '{{ __('System') }}',     desc: '{{ __('Platform running normally') }}',     time: '3h ago' },
    ]

    ;(function renderNotifications() {
        const list = document.getElementById('notif-list')
        adminNotifications.forEach(n => {
            list.innerHTML += `
                <div class="notif-item">
                    <div class="notif-title">${n.title}</div>
                    <div class="notif-desc">${n.desc}</div>
                    <div class="notif-time">${n.time}</div>
                </div>`
        })
    })()
</script>