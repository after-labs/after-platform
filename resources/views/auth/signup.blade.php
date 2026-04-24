<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign Up</title>
      @vite(['resources/css/app.css', 'resources/css/auth/signup.css'])
  </head>
  <body>
    <div class="container">
      <h1>{{ __('Sign Up!') }}</h1>
      <p>
        {{ __('Ready to see what comes After? Fill in the details below, and let the journey begin!') }}
      </p>
      <form method="post" action="">
        @csrf

        <label for="username">{{ __('Username') }}</label>
        <input type="text" name="username" id="username" />

        <label for="email">{{ __('Email') }}</label>
        <input type="email" name="email" id="email" />

        <p>{{ __('Your password must include:') }}</p>
        <ul>
          <li>{{ __('One capital letter & one small letter at least') }}</li>
          <li>{{ __('One special character') }}</li>
          <li>{{ __('Minimum 8 digits long') }}</li>
        </ul>
        <label for="password">{{ __('Password') }}</label>
        <input type="password" name="password" id="password" />

        <label for="confirm_password">{{ __('Confirm Password') }}</label>
        <input type="password" name="confirm_password" id="confirm_password" />

        <button type="submit">{{ __('Sign Up') }}</button>
        <span>{{ __('or') }}</span>
        <button>{{ __('Log In') }}</button>
        <div class="footer-actions">
          <span>{{ __('Already have an account?') }} <a href="">{{ __('Login') }}</a></span>
          <a href="">{{ __('Contact Support') }}</a>
        </div>
      </form>
    </div>
  </body>
</html>
