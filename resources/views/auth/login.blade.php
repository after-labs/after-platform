<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
      @vite(['resources/css/app.css', 'resources/css/auth/login.css'])
  </head>
  <body>
    <div class="container">
      <h1>{{ __('Login') }}</h1>
      <p>{{ __('Login quickly and start exploring indie worlds!') }}</p>
      <form method="post" action="">
        @csrf

        <label for="email">{{ __('Email') }}</label>
        <input type="email" name="email" id="email" />

        <label for="password">{{ __('Password') }}</label>
        <input type="password" name="password" id="" />

        <button type="submit">{{ __('Log In') }}</button>
      </form>
      <div class="footer-actions">
        <span>{{ __('Don\'t have an account?') }} <a href="">{{ __('Sign Up') }}</a></span>
        <a href="">{{ __('Contact Support') }}</a>
      </div>
    </div>
  </body>
</html>
