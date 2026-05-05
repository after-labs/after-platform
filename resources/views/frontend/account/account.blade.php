<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Account</title>
  @vite(['resources/css/app.css', 'resources/css/frontend/account/account.css'])
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
  <div class="account">
      <aside class="sidebar">
          <div class="logo"><img src="{{ asset('icons/after-logomarca-branco.svg') }}" alt=""></div>
  
          <nav>
              <a class="active">{{ __('User Account') }}</a>
              <a>{{ __('Games Wishlist') }}</a>
              <a>{{ __('My Orders') }}</a>
              <a>{{ __('How the Platform Works?') }}</a>
              <a>{{ __('Terms & Condition') }}</a>
              <a>{{ __('Privacy Policy') }}</a>
              <a>{{ __('Project Backstage') }}</a>
          </nav>
      </aside>
  
      <main class="content">
          <div class="topbar">
              <h1>{{ __('Welcome, Thyago!') }}</h1>
              
          </div>
  
          <div class="grid">
              <section class="card profile">
                  <div class="avatar">
                      <img src="{{ asset('imgs/quintas-profile.png') }}" alt="">
                  </div>
                  <div class="main-info">
                    <p><strong>{{ __('Username:') }}</strong> quintou_th10</p>
                    <p><strong>{{ __('Email:') }}</strong> user@email.com</p>
                  </div>
                  <div class="info">
                      <h3>{{ __('Information') }}</h3>
                      <p><strong>{{ __('Name:') }}</strong> Name, Last Name</p>
                      <p><strong>{{ __('Email:') }}</strong> user@email.com</p>
                      <p><strong>{{ __('Phone:') }}</strong> +55 (11) 90000-0000</p>
                      <p><strong>{{ __('Country:') }}</strong> Brazil</p>
                  </div>
                  <div class="profile-buttons">
                     <button class="btn outline">{{ __('Log Out') }}</button>
                     <button class="btn danger">{{ __('Delete Account') }}</button>
                  </div>
              </section>
  
              <section class="card settings">
                  <h2>{{ __('User Settings') }}</h2>

                <form>
                    @csrf
                    <div class="form-grid">
                        <input placeholder="{{ __('Last Name') }}">
                        <input placeholder="{{ __('First Name') }}">
                        <input placeholder="{{ __('Username') }}">
                        <input placeholder="{{ __('Email') }}">
        
                        <div class="phone">
                            <input value="+55">
                            <input placeholder="{{ __('(11) 90000-0000') }}">
                        </div>

                        <select>
                            <option>{{ __('Brazil') }}</option>
                        </select>
                      </div>
  
                      <button class="btn primary">{{ __('Save changes') }}</button>
  
                      <h3>{{ __('Password') }}</h3>
  
                      <div class="form-grid">
                          <div class="password">
                              <input type="password" placeholder="{{ __('Your password') }}">
                              <button type="button" class="toggle">
                                <i class="fa-solid fa-eye"></i>
                              </button>
                          </div>
  
                          <input type="password" placeholder="{{ __('Repeat password') }}">
  
                          <div class="password">
                              <input type="password" placeholder="{{ __('New password') }}">
                              <button type="button" class="toggle">
                                <i class="fa-solid fa-eye"></i>
                              </button>
                          </div>
  
                          <input type="password" placeholder="{{ __('Confirm password') }}">
                      </div>
  
                      <button class="btn primary">{{ __('Save changes') }}</button>
                  </form>
              </section>
          </div>
      </main>
  </div>
</body>
</html>