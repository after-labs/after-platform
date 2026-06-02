<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Admin Account') }}</title>
    @vite(['resources/css/app.css', 'resources/css/frontend/account/account.css'])
</head>
<body>
    @include('components/header_adm')

    @php
        $avatarUrl = $user->avatar
            ? asset('storage/' . $user->avatar)
            : asset('icons/user-icon.svg');
    @endphp

    <main class="account-page">

        <section class="account-hero">
            <div class="account-identity">
                <div class="account-avatar">
                    <img src="{{ $avatarUrl }}" alt="{{ $user->name }}">
                </div>

                <div>
                    <span class="account-kicker">{{ __('Admin Profile') }}</span>
                    <h1>{{ __('Welcome, :name', ['name' => $user->name]) }}</h1>
                    <p>{{ $user->email }}</p>
                </div>
            </div>
        </section>

        <section class="account-grid">
            <article class="account-panel account-profile-panel">
                <div class="panel-heading">
                    <span>{{ __('Profile') }}</span>
                    <h2>{{ __('Account details') }}</h2>
                </div>

                <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data" class="account-form">
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
                    <h2>{{ __('Admin data') }}</h2>
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
                        <dt>{{ __('Role') }}</dt>
                        <dd>{{ __('Admin') }}</dd>
                    </div>
                    <div>
                        <dt>{{ __('Status') }}</dt>
                        <dd>{{ ucfirst($user->status ?? 'active') }}</dd>
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
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">{{ __('Logout') }}</button>
                    </form>
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
                            <span>{{ __('Confirm New Password') }}</span>
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
        </section>
    </main>
</body>
</html>
