<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>New Password</title>
      @vite(['resources/css/app.css', 'resources/css/auth/new_password.css'])
  </head>
  <body>
    <div class="container">
      <h1>{{ __('Create Your New Password') }}</h1>
      <p>
        {{ __('Type your new strong (and memorable!) password. Your password must include:') }}
      </p>
      <ul>
        <li>{{ __('One capital letter & one small letter at least') }}</li>
        <li>{{ __('One special character') }}</li>
        <li>{{ __('Minimum 8 digits long') }}</li>
      </ul>
      <form method="post" action="">
        @csrf
        <label for="password">{{ __('New Password') }}</label>
        <input type="password" name="password" id="password" />

        <label for="confirm_password">{{ __('Confirm Password') }}</label>
        <input type="password" name="confirm_password" id="confirm_password" />

        <button type="submit">{{ __('Save Password') }}</button>
      </form>
    </div>
  </body>
</html>
