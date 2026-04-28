    <footer>
      <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    />
      @vite(['resources/css/components/footer.css'])
      <div class="container">
        <div class="footer-columns">
          <div class="footer-column">
            <h3>{{ __('After Indie Gaming') }}</h3>
            <p>
              {{ __('Sharing the incredible potential of indie creations. Find your next game today!') }}
            </p>
            <div class="social-icons">
              <a href="#"><i class="fab fa-github"></i></a>
              <a href="#"><i class="fab fa-twitter"></i></a>
              <a href="#"><i class="fab fa-linkedin"></i></a>
              <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
          </div>
          <div class="footer-column">
            <h4>{{ __('About Us') }}</h4>
            <ul>
              <li><a href="#">{{ __('Our Mission') }}</a></li>
              <li><a href="#">{{ __('Blog & News') }}</a></li>
              <li><a href="#">{{ __('How the platform works') }}</a></li>
              <li><a href="#">{{ __('Project Backstage') }}</a></li>
            </ul>
          </div>
          <div class="footer-column">
            <h4>{{ __('Stores') }}</h4>
            <ul>
              <li><a href="#">{{ __('Full Catalog') }}</a></li>
              <li><a href="#">{{ __('Start Selling Your Games') }}</a></li>
              <li><a href="#">{{ __('Top Creators') }}</a></li>
            </ul>
          </div>
          <div class="footer-column">
            <h4>{{ __('Contact Us') }}</h4>
            <ul class="contact-info">
              <li>
                <i class="fas fa-map-marker-alt"></i>123 After Street, Game City
              </li>
              <li><i class="fas fa-phone"></i>+55 (11) 90000-0000</li>
              <li><i class="fas fa-envelope"></i> info@aftergaming.com </li>
            </ul>
          </div>
        </div>
        <div class="footer-bottom">
          <p>© 2026 After Indie Gaming. {{ __('All rights reserved.') }}</p>
          <div class="footer-links">
            <a href="#">{{ __('Privacy Policy') }}</a>
            <a href="#">{{ __('Terms of Service') }}</a>
            <a href="#">{{ __('Accessibility') }}</a>
          </div>
        </div>
      </div>
    </footer>
  </body>
</html>
