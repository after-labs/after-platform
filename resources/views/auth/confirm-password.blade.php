<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - Confirm Password</title>
    @vite(['resources/css/app.css','resources/css/auth.css'])
</head>
<body>
    <div class="container">
        <p>{{ __('This is a secure area of the application. Please confirm your password before continuing.') }}</p>


        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <h1>{{ __('Confirm Password') }}</h1>


            <div class="form-group">
                <label for="password">{{ __('Password') }}</label>
                <input id="password" type="password" name="password" required autocomplete="current-password">
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="footer-actions">
                 <button type="submit">{{ __('Confirm') }}</button>
            </div>
        </form>
    </div>
</body>
</html>
