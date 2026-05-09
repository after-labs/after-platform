<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Account') }}</title>
    @vite(['resources/css/app.css', 'resources/css/frontend/account/account.css'])
</head>
<body>
    @include('components/header_client')

    @php
        $avatarUrl = $user->avatar
            ? asset('storage/' . $user->avatar)
            : asset('icons/user-icon.svg');
        $level = $gamification?->level ?? 1;
        $points = $gamification?->points ?? 0;
        $coins = $gamification?->coins ?? 0;
    @endphp

    <main class="account-page">
        <nav class="account-tabs" aria-label="{{ __('Account navigation') }}">
            <a href="{{ route('account') }}" class="account-tab active">{{ __('Account') }}</a>
            <a href="/wishlist" class="account-tab">{{ __('Wishlist') }}</a>
            <a href="{{ route('orders.index') }}" class="account-tab">{{ __('Orders') }}</a>
        </nav>

        <section class="account-hero">
            <div class="account-identity">
                <div class="account-avatar">
                    <img src="{{ $avatarUrl }}" alt="{{ $user->name }}">
                </div>

                <div>
                    <span class="account-kicker">{{ __('Player Profile') }}</span>
                    <h1>{{ __('Welcome, :name', ['name' => $user->name]) }}</h1>
                    <p>{{ $user->email }}</p>
                </div>
            </div>

            <div class="account-stats">
                <article>
                    <span>{{ __('Level') }}</span>
                    <strong>{{ $level }}</strong>
                </article>
                <article>
                    <span>{{ __('Points') }}</span>
                    <strong>{{ $points }}</strong>
                </article>
                <article>
                    <span>{{ __('Coins') }}</span>
                    <strong>{{ $coins }}</strong>
                </article>
            </div>
        </section>

        <section class="account-grid">
            <article class="account-panel account-profile-panel">
                <div class="panel-heading">
                    <span>{{ __('Profile') }}</span>
                    <h2>{{ __('Account details') }}</h2>
                </div>

                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="account-form">
                    @csrf
                    @method('patch')

                    <div class="avatar-upload-field">
                        <label for="avatar">
                            <span>{{ __('Avatar') }}</span>
                            <input id="avatar" name="avatar" type="file" accept="image/*">
                            <small>{{ __('Upload a square image for the best result.') }}</small>
                        </label>
                        <x-input-error :messages="$errors->get('avatar')" />
                    </div>

                    <div class="form-grid">
                        <label>
                            <span>{{ __('Name') }}</span>
                            <input name="name" type="text" value="{{ old('name', $user->name) }}" required autocomplete="name">
                            <x-input-error :messages="$errors->get('name')" />
                        </label>

                        <label>
                            <span>{{ __('Email') }}</span>
                            <input name="email" type="email" value="{{ old('email', $user->email) }}" required autocomplete="username">
                            <x-input-error :messages="$errors->get('email')" />
                        </label>

                        <label>
                            <span>{{ __('Phone') }}</span>
                            <input name="phone" type="text" value="{{ old('phone', $user->phone) }}" autocomplete="tel">
                            <x-input-error :messages="$errors->get('phone')" />
                        </label>

                        <label>
                            <span>{{ __('Country') }}</span>
                            <input name="country" type="text" value="{{ old('country', $user->country) }}" autocomplete="country-name">
                            <x-input-error :messages="$errors->get('country')" />
                        </label>
                    </div>

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <div class="account-notice">
                            <p>{{ __('Your email address is unverified.') }}</p>
                            <button form="send-verification" type="submit">{{ __('Resend verification email') }}</button>
                        </div>
                    @endif

                    @if (session('status') === 'profile-updated')
                        <p class="form-status">{{ __('Profile saved.') }}</p>
                    @endif

                    <button class="account-button primary" type="submit">{{ __('Save profile') }}</button>
                </form>

                <form id="send-verification" method="POST" action="{{ route('verification.send') }}">
                    @csrf
                </form>
            </article>

            <aside class="account-panel account-side-panel">
                <div class="panel-heading">
                    <span>{{ __('Overview') }}</span>
                    <h2>{{ __('Player data') }}</h2>
                </div>

                <dl class="profile-list">
                    <div>
                        <dt>{{ __('Name') }}</dt>
                        <dd>{{ $user->name }}</dd>
                    </div>
                    <div>
                        <dt>{{ __('Email') }}</dt>
                        <dd>{{ $user->email }}</dd>
                    </div>
                    <div>
                        <dt>{{ __('Phone') }}</dt>
                        <dd>{{ $user->phone ?: __('Not informed') }}</dd>
                    </div>
                    <div>
                        <dt>{{ __('Country') }}</dt>
                        <dd>{{ $user->country ?: __('Not informed') }}</dd>
                    </div>
                </dl>

                <div class="quick-links">
                    <a href="/wishlist">{{ __('Open wishlist') }}</a>
                    <a href="{{ route('orders.index') }}">{{ __('View orders') }}</a>
                    <a href="{{ route('games.index') }}">{{ __('Browse store') }}</a>
                </div>
            </aside>
        </section>

        <section class="account-grid secondary">
            <article class="account-panel">
                <div class="panel-heading">
                    <span>{{ __('Security') }}</span>
                    <h2>{{ __('Update password') }}</h2>
                </div>

                <form method="POST" action="{{ route('password.update') }}" class="account-form">
                    @csrf
                    @method('put')

                    <div class="form-grid">
                        <label>
                            <span>{{ __('Current Password') }}</span>
                            <input name="current_password" type="password" autocomplete="current-password">
                            <x-input-error :messages="$errors->updatePassword->get('current_password')" />
                        </label>

                        <label>
                            <span>{{ __('New Password') }}</span>
                            <input name="password" type="password" autocomplete="new-password">
                            <x-input-error :messages="$errors->updatePassword->get('password')" />
                        </label>

                        <label>
                            <span>{{ __('Confirm Password') }}</span>
                            <input name="password_confirmation" type="password" autocomplete="new-password">
                            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" />
                        </label>
                    </div>

                    @if (session('status') === 'password-updated')
                        <p class="form-status">{{ __('Password saved.') }}</p>
                    @endif

                    <button class="account-button primary" type="submit">{{ __('Save password') }}</button>
                </form>
            </article>

            <article class="account-panel danger-zone">
                <div class="panel-heading">
                    <span>{{ __('Danger Zone') }}</span>
                    <h2>{{ __('Delete account') }}</h2>
                </div>

                <p>{{ __('This action permanently removes your account after password confirmation.') }}</p>

                <form method="POST" action="{{ route('profile.destroy') }}" class="account-form">
                    @csrf
                    @method('delete')

                    <label>
                        <span>{{ __('Password') }}</span>
                        <input name="password" type="password" autocomplete="current-password">
                        <x-input-error :messages="$errors->userDeletion->get('password')" />
                    </label>

                    <button class="account-button danger" type="submit">{{ __('Delete account') }}</button>
                </form>
            </article>
        </section>
    </main>

    @include('components/footer')
</body>
</html>
