<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Control</title>
    @vite(['resources/css/app.css', 'resources/css/backend/users/index.css'])
</head>
<body>
  @include('components/header_adm')
   
<main>
  <h1>{{ __('Users') }}</h1>

  <section class="card">

    <div class="search-row">
      <input type="text" placeholder="{{ __('Search by username, email or ID') }}">
      <span class="total">{{ __('Total Users: :count', ['count' => $totalUsers]) }}</span>
    </div>

    <div class="filters">
      <button class="btn active">{{ __('All Users') }}</button>
      <button class="btn">{{ __('Active Users') }}</button>
      <button class="btn">{{ __('Inactive Users') }}</button>
      <button class="btn">{{ __('Admin Users') }}</button>
      <button class="btn create">{{ __('Create User') }}</button>
    </div>
    </section> <br>


    <section class="card">
    <table>
      <thead>
        <tr>
          <th>{{ __('ID') }}</th>
          <th>{{ __('USERNAME') }}</th>
          <th>{{ __('EMAIL') }}</th>
          <th>{{ __('USER TYPE') }}</th>
          <th>{{ __('ACTIVE STATUS') }}</th>
        </tr>
      </thead>

      <tbody>
       
        @foreach ($users as $user)
        <a href="{{ route('admin.users.edit', ['user' => '$user']) }}">
          <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td class="select">{{ __($user->role)}} ▾</td>
            <td class="select">{{ __($user->status) }} ▾</td>
          </tr>
        </a>
        @endforeach
      </tbody>
    </table>

    <div class="pagination">
      <span>«</span>
      <span class="page active">1</span>
      <span class="page">2</span>
      <span class="page">3</span>
      <span class="page">4</span>
      <span>...</span>
      <span class="page">29</span>
      <span>»</span>
    </div>

  </section>
</main>
</main>
</body>
</html>