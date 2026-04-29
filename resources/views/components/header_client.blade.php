    <header>
         @vite(['resources/css/components/header.css'])
      <div class="container">
        <div class="logo">
            <img src="{{ asset('icons/after-logomarca-branco.svg') }}" alt="after-logo" onclick="window.location.href='{{ route('dashboard') }}';"/>
        </div>
        <div class="search-container">
          <img src="{{ asset('icons/search-icon.svg') }}" alt="" class="search-icon" />
          <input type="text" placeholder="Search..." class="search-input" />
        </div>
        <nav>
          <ul>
            <li><a href="{{ route('games.catalog') }}">Store</a></li>
            <li><a href="#">My Orders</a></li>
            <li>
              <a href="#" class="points-trigger" onclick="togglePoints()"
                >5000<img src="{{ asset('icons/coin-icon.svg') }}" alt=""
              /></a>
            </li>
            <ul class="icon-group">
              <li>
                <a href="#"><img src="{{ asset('icons/cart-icon.svg') }}" alt="" /></a>
              </li>
              <li>
                <a href="#" class="notif-trigger" onclick="toggleNotif()"
                  ><img src="{{ asset('icons/bell-icon.svg') }}" alt=""
                /></a>
              </li>
              <li>
                <a href="{{ route('account') }}"><img src="{{ asset('icons/user-icon.svg') }}" alt="" /></a>
              </li>
            </ul>
          </ul>
        </nav>
      </div>
    </header>

    <!-- POINTS POPUP -->

    <div class="points-container hidden">
      <button onclick="togglePoints()" class="btn-close-points">
        <img src="{{ asset('icons/close-icon.svg') }}" alt="close-button" />
      </button>
      <h4 class="points-title">Pontuation System</h4>
      <p class="points-description">
        As you buy games, receive xp points, level up and earn coins to spend as
        discounts on our indie games!
      </p>
      <div class="points-progress">
        <div class="level-row">
          <div class="level-unit">
            <span>Your Level</span>
            <span>Level 12</span>
          </div>
          <div class="level-unit">
            <span>Next Level</span>
            <span>Level 13</span>
          </div>
        </div>
        <div class="points-progress">
          <div class="progress-labels">
            <span>Level Progress</span>
            <span><strong>400</strong> Points To Go</span>
          </div>
          <div class="progress-container">
            <div class="progress-fill" style="width: 70%">70%</div>
          </div>
        </div>
        <div class="reward-unit">
          <span>Next Level Reward</span>
          <span>250 Coins <img src="{{ asset('icons/coin-icon.svg') }}" alt="" /></span>
        </div>
      </div>
    </div>

    <!-- NOTIFICATION POPUP -->

    <div id="notif-box" class="notif-box hidden">
      <div class="notif-header">
        <span>Notifications</span>
        <button onclick="toggleNotif()">
          <img src="{{ asset('icons/close-icon.svg') }}" alt="close-button" />
        </button>
      </div>
      <div id="notif-list" class="notif-list"></div>
    </div>

    <script>
      // POINTS POPUP Logic

      function togglePoints() {
        const box = document.querySelector('.points-container')
        box.classList.toggle('hidden')
      }

      // NOTIFICATION POPUP Logic
      const notifications = [
        {
          title: 'New Game Released',
          desc: 'A new indie game just dropped',
          time: 'now'
        },
        {
          title: 'Sale Live',
          desc: 'Up to 50% discount available',
          time: '2m ago'
        },
        {
          title: 'Update',
          desc: 'System performance improved',
          time: '10m ago'
        },
        { title: 'Patch Notes', desc: 'Bug fixes deployed', time: '1h ago' },
        { title: 'Reminder', desc: 'Wishlist items on sale', time: '3h ago' },
        { title: 'Event', desc: 'Indie showcase starting soon', time: '1d ago' }
      ]

      function renderNotifications() {
        const list = document.getElementById('notif-list')
        list.innerHTML = ''
        notifications.slice(0, 6).forEach((n) => {
          list.innerHTML += `
        <div class="notif-item">
          <div class="notif-title">${n.title}</div>
          <div class="notif-desc">${n.desc}</div>
          <div class="notif-time">${n.time}</div>
        </div>
      `
        })
      }

      function toggleNotif() {
        const box = document.getElementById('notif-box')
        box.classList.toggle('hidden')
      }

      renderNotifications()
    </script>