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
      <span class="total">{{ __('Total Users: :count', ['count' => 340]) }}</span>
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
       
        <tr>
          <td>U-0001-0001</td>
          <td>quitten_h10</td>
          <td>thiago@email.com</td>
          <td class="select">{{ __('Client') }} ▾</td>
          <td class="select">{{ __('Active') }} ▾</td>
        </tr>

        <tr>
          <td>U-0001-0001</td>
          <td>quitten_h10</td>
          <td>thiago@email.com</td>
          <td class="select">{{ __('Client') }} ▾</td>
          <td class="select">{{ __('Active') }} ▾</td>
        </tr>

        <tr>
          <td>U-0001-0001</td>
          <td>quitten_h10</td>
          <td>thiago@email.com</td>
          <td class="select">{{ __('Client') }} ▾</td>
          <td class="select">{{ __('Active') }} ▾</td>
        </tr>
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