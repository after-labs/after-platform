<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Create User') }}</title>
    @vite(['resources/css/app.css', 'resources/css/backend/users/create.css'])
</head>
<body>
@include('components/header_adm')

<main class="container">
<section class="form-card">

    <div class="avatar">
        <img src="{{ asset('icons/user-icon.svg') }}" alt="User">
    </div>

    <h2>{{ __('CREATE NEW USER:') }} <span>{{ __('Details') }}</span></h2>

    @if($errors->any())
        <div class="alert-error">
            <strong>{{ __('Please fix the errors below:') }}</strong>
            <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    <form class="form-grid" action="{{ route('admin.users.store') }}" method="POST">
    @csrf

        {{-- Name --}}
        <div class="field-group">
            <label for="name">{{ __('Name') }} <span class="req">*</span></label>
            <input id="name" name="name" type="text"
                value="{{ old('name') }}"
                placeholder="{{ __('Full name') }}"
                class="{{ $errors->has('name') ? 'is-invalid' : '' }}">
            @error('name')<span class="field-error">{{ $message }}</span>@enderror
        </div>

        {{-- Email --}}
        <div class="field-group">
            <label for="email">{{ __('Email') }} <span class="req">*</span></label>
            <input id="email" name="email" type="email"
                value="{{ old('email') }}"
                placeholder="{{ __('user@email.com') }}"
                class="{{ $errors->has('email') ? 'is-invalid' : '' }}">
            @error('email')<span class="field-error">{{ $message }}</span>@enderror
        </div>

        {{-- Password --}}
        <div class="field-group">
            <label for="password">{{ __('Password') }} <span class="req">*</span></label>
            <input id="password" name="password" type="password"
                placeholder="{{ __('Min. 8 characters') }}"
                class="{{ $errors->has('password') ? 'is-invalid' : '' }}">
            @error('password')<span class="field-error">{{ $message }}</span>@enderror
        </div>

        {{-- Confirm password --}}
        <div class="field-group">
            <label for="password_confirmation">{{ __('Confirm Password') }} <span class="req">*</span></label>
            <input id="password_confirmation" name="password_confirmation" type="password"
                placeholder="{{ __('Repeat password') }}">
        </div>

        {{-- Phone --}}
        <div class="field-group">
            <label for="phone">{{ __('Phone Number') }}</label>
            <input id="phone" name="phone" type="text"
                value="{{ old('phone') }}"
                placeholder="+55 (11) 90000-0000">
        </div>

        {{-- Country --}}
        <div class="field-group">
            <label for="country">{{ __('Country') }}</label>
            <select id="country" name="country">
                <option value="" disabled {{ old('country') ? '' : 'selected' }}>{{ __('Select country') }}</option>
                @foreach([
                    'BR' => 'Brazil', 'US' => 'United States', 'PT' => 'Portugal',
                    'AR' => 'Argentina', 'MX' => 'Mexico', 'CO' => 'Colombia',
                    'GB' => 'United Kingdom', 'DE' => 'Germany', 'FR' => 'France',
                    'JP' => 'Japan', 'CA' => 'Canada', 'AU' => 'Australia',
                ] as $code => $name)
                    <option value="{{ $code }}" {{ old('country') === $code ? 'selected' : '' }}>{{ $name }}</option>
                @endforeach
            </select>
        </div>

        {{-- User type --}}
        <div class="field-group">
            <label for="role">{{ __('User Type') }} <span class="req">*</span></label>
            <select id="role" name="role"
                class="{{ $errors->has('role') ? 'is-invalid' : '' }}">
                <option value="" disabled {{ old('role') ? '' : 'selected' }}>{{ __('Select type') }}</option>
                <option value="client" {{ old('role') === 'client' ? 'selected' : '' }}>{{ __('Client') }}</option>
                <option value="admin"  {{ old('role') === 'admin'  ? 'selected' : '' }}>{{ __('Admin') }}</option>
            </select>
            @error('role')<span class="field-error">{{ $message }}</span>@enderror
        </div>

        {{-- Status --}}
        <div class="field-group">
            <label for="status">{{ __('Active Status') }} <span class="req">*</span></label>
            <select id="status" name="status"
                class="{{ $errors->has('status') ? 'is-invalid' : '' }}">
                <option value="" disabled {{ old('status') ? '' : 'selected' }}>{{ __('Select status') }}</option>
                <option value="active"   {{ old('status') === 'active'   ? 'selected' : '' }}>{{ __('Active') }}</option>
                <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>{{ __('Inactive') }}</option>
            </select>
            @error('status')<span class="field-error">{{ $message }}</span>@enderror
        </div>

    </form>

    <div class="actions">
        <a class="cancel" href="{{ route('admin.users.index') }}">{{ __('Cancel') }}</a>
        <button class="save" form="create-form" type="submit" onclick="document.querySelector('.form-grid').requestSubmit()">
            {{ __('Save & Create') }}
        </button>
    </div>

    {{-- Move submit inside form via JS since button is outside --}}
    <script>
        document.querySelector('.save').addEventListener('click', function () {
            document.querySelector('.form-grid').submit()
        })
    </script>

</section>
</main>
</body>
</html>