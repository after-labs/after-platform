<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }} — {{ __('Edit User') }}</title>
    @vite(['resources/css/app.css', 'resources/css/backend/users/edit.css'])
</head>
<body>
@include('components/header_adm')

<div class="wrapper">
<div class="user-card">

    <div class="avatar">
        <img src="{{ asset('icons/user-icon.svg') }}" alt="{{ __('User') }}">
    </div>

    <h2>{{ $user->name }}: <span>{{ __('Details') }}</span></h2>

    @if($errors->any())
        <div class="alert-error">
            <strong>{{ __('Please fix the errors below:') }}</strong>
            <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <form class="form-grid" action="{{ route('admin.users.update', $user) }}" method="POST" id="edit-form">
    @csrf

        <!--Name-->
        <div class="field-group">
            <label for="name">{{ __('Name') }} <span class="req">*</span></label>
            <input id="name" name="name" type="text"
                value="{{ old('name', $user->name) }}"
                class="{{ $errors->has('name') ? 'is-invalid' : '' }}">
            @error('name')<span class="field-error">{{ $message }}</span>@enderror
        </div>

        <!--Email-->
        <div class="field-group">
            <label for="email">{{ __('Email') }} <span class="req">*</span></label>
            <input id="email" name="email" type="email"
                value="{{ old('email', $user->email) }}"
                class="{{ $errors->has('email') ? 'is-invalid' : '' }}">
            @error('email')<span class="field-error">{{ $message }}</span>@enderror
        </div>

        <!--New password-->
        <div class="field-group">
            <label for="password">
                {{ __('New Password') }}
                <span class="field-hint">{{ __('leave blank to keep current') }}</span>
            </label>
            <input id="password" name="password" type="password"
                placeholder="{{ __('Min. 8 characters') }}"
                class="{{ $errors->has('password') ? 'is-invalid' : '' }}">
            @error('password')<span class="field-error">{{ $message }}</span>@enderror
        </div>

        <!--Confirm new password-->
        <div class="field-group">
            <label for="password_confirmation">{{ __('Confirm New Password') }}</label>
            <input id="password_confirmation" name="password_confirmation" type="password"
                placeholder="{{ __('Repeat new password') }}">
        </div>

        <!--Phone-->
        <div class="field-group">
            <label for="phone">{{ __('Phone Number') }}</label>
            <input id="phone" name="phone" type="text"
                value="{{ old('phone', $user->phone) }}"
                placeholder="+55 (11) 90000-0000">
        </div>

        <!--Country-->
        <div class="field-group">
            <label for="country">{{ __('Country') }}</label>
            <select id="country" name="country">
                <option value="">{{ __('Select country') }}</option>
                @foreach([
                    'BR' => 'Brazil', 'US' => 'United States', 'PT' => 'Portugal',
                    'AR' => 'Argentina', 'MX' => 'Mexico', 'CO' => 'Colombia',
                    'GB' => 'United Kingdom', 'DE' => 'Germany', 'FR' => 'France',
                    'JP' => 'Japan', 'CA' => 'Canada', 'AU' => 'Australia',] as $code => $name)
                    <option value="{{ $code }}"
                        {{ old('country', $user->country) === $code ? 'selected' : '' }}>
                        {{ __($name) }}
                    </option>
                @endforeach
            </select>
        </div>

        <!--User type-->
        <div class="field-group">
            <label for="role">{{ __('User Type') }} <span class="req">*</span></label>
            <select id="role" name="role"
                class="{{ $errors->has('role') ? 'is-invalid' : '' }}">
                <option value="client" {{ old('role', $user->role) === 'client' ? 'selected' : '' }}>{{ __('Client') }}</option>
                <option value="admin"  {{ old('role', $user->role) === 'admin'  ? 'selected' : '' }}>{{ __('Admin') }}</option>
            </select>
            @error('role')<span class="field-error">{{ $message }}</span>@enderror
        </div>

        <!--Status-->
        <div class="field-group">
            <label for="status">{{ __('Active Status') }} <span class="req">*</span></label>
            <select id="status" name="status"
                class="{{ $errors->has('status') ? 'is-invalid' : '' }}">
                <option value="active"   {{ old('status', $user->status) === 'active'   ? 'selected' : '' }}>{{ __('Active') }}</option>
                <option value="inactive" {{ old('status', $user->status) === 'inactive' ? 'selected' : '' }}>{{ __('Inactive') }}</option>
            </select>
            @error('status')<span class="field-error">{{ $message }}</span>@enderror
        </div>

        <!--User ID-->
        <div class="field-group full">
            <label>{{ __('User ID') }}</label>
            <input type="text" value="{{ $user->id }}" readonly class="readonly">
        </div>

        <!--Member since-->
        <div class="field-group full">
            <label>{{ __('Member Since') }}</label>
            <input type="text" value="{{ $user->created_at->format('d/m/Y H:i') }}" readonly class="readonly">
        </div>

    </form>

    <div class="actions">
        <a class="delete"
           href="{{ route('admin.users.delete', $user) }}"
           onclick="return confirm('{{ __('Delete this user? This cannot be undone.') }}')">
            {{ __('Delete User') }}
        </a>
        <button class="save" type="submit" form="edit-form">
            {{ __('Save Changes') }}
        </button>
    </div>

</div>
</div>
</body>
</html>
