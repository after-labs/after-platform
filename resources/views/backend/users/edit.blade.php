<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User record</title>
    <link rel="stylesheet" href="/css/global.css">
    <link rel="stylesheet" href="/css/user_record_adm.css">
</head>
<body>
  @include('components/header_adm')

    <div class="wrapper">

  <div class="user-card">

    <button class="close-btn">✕</button>

   <div class="avatar">
        <img src="/icons/user2.svg" alt="">
    </div>

    <h2>Quintou_th10: <span>{{ __('Details') }}</span></h2>

    <form class="form-grid">

      <div>
        <label>{{ __('First Name') }}</label>
        <input type="text" value="Thyago">
      </div>

      <div>
        <label>{{ __('Last Name') }}</label>
        <input type="text" value="Quintas">
      </div>

      <div>
        <label>{{ __('Username') }}</label>
        <input type="text" value="quintou_th10">
      </div>

      <div>
        <label>{{ __('Email') }}</label>
        <input type="email" value="thyago.quintas@email.com">
      </div>

      <div class="phone-group">
        <label>{{ __('Phone Number') }}</label>
        <div class="phone-input">
          <input class="code" type="text" value="+55">
          <input type="text" value="(11) 90000-0000">
        </div>
      </div>

      <div>
        <label>{{ __('Country') }}</label>
        <select>
      <option>{{ __('Brazil') }}</option>
        </select>
      </div>

      <div>
        <label>{{ __('User Type') }}</label>
        <select>
      <option>{{ __('Client') }}</option>
        </select>
      </div>

      <div>
        <label>{{ __('Active Status') }}</label>
        <select>
      <option>{{ __('Active') }}</option>
        </select>
      </div>

      <div class="full">
        <label>{{ __('User ID') }}</label>
        <input type="text" value="U-0001-0001">
      </div>
    </form>

    <div class="actions">
      <button class="delete">{{ __('Delete User') }}</button>
      <button class="save">{{ __('Save changes') }}</button>
    </div>


  </div>
   
</div>

</div>

</body>
</html>