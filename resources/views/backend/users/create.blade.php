<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <link rel="stylesheet" href="/css/global.css">
    <link rel="stylesheet" href="/css/create_user_adm.css">
</head>
<body>

    <iframe src="header_adm.html" style="border:none; width:100%; height:100px;"></iframe>

   <main class="container">

  <section class="form-card">

    <div class="avatar">
        <img src="/icons/user2.svg" alt="">
    </div> 

    <h2>{{ __('CREATE NEW USER:') }} <span>{{ __('Details') }}</span></h2>

    <form class="form-grid">

      <div>
        <label>{{ __('First Name') }}</label>
        <input type="text" placeholder="{{ __('Enter first name') }}">
      </div>

      <div>
        <label>{{ __('Last Name') }}</label>
        <input type="text" placeholder="{{ __('Enter last name') }}">
      </div>

      <div>
        <label>{{ __('Username') }}</label>
        <input type="text" placeholder="{{ __('Enter username') }}">
      </div>

      <div>
        <label>{{ __('Email') }}</label>
        <input type="email" placeholder="{{ __('Enter email') }}">
      </div>

      <div>
        <label>{{ __('Password') }}</label>
        <input type="password" placeholder="{{ __('Enter password') }}">
      </div>

      <div>
        <label>{{ __('Confirm password') }}</label>
        <input type="password" placeholder="{{ __('Confirm password') }}">
      </div>

      <div>
        <label>{{ __('Phone Number') }}</label>
        <input type="text" placeholder="+55 (11) 90000-0000">
      </div>

      <div>
        <label>{{ __('Country') }}</label>
        <select>
      <option disabled selected>{{ __('Select country') }}</option>
      <option>{{ __('Brazil') }}</option>
        </select>
      </div>

      <div>
        <label>{{ __('User Type') }}</label>
        <select>
      <option disabled selected>{{ __('Select type') }}</option>
      <option>{{ __('Client') }}</option>
      <option>{{ __('Admin') }}</option>
        </select>
      </div>

      <div>
        <label>{{ __('Active Status') }}</label>
        <select>
      <option disabled selected>{{ __('Select status') }}</option>
      <option>{{ __('Active') }}</option>
      <option>{{ __('Inactive') }}</option>
        </select>
      </div>

    </form>

    <div class="actions">
      <button class="cancel">{{ __('Cancel') }}</button>
      <button class="save">{{ __('Save & Create') }}</button>
    </div>

  </section>

</main>


</body>
</html>

