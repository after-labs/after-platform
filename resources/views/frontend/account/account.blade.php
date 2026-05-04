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
              <a class="active">User Account</a>
              <a>Games Wishlist</a>
              <a>My Orders</a>
              <a>How the Platform Works?</a>
              <a>Terms & Condition</a>
              <a>Privacy Policy</a>
              <a>Project Backstage</a>
          </nav>
      </aside>
  
      <main class="content">
          <div class="topbar">
              <h1>Welcome, Thyago!</h1>
              
          </div>
  
          <div class="grid">
              <section class="card profile">
                  <div class="avatar">
                      <img src="{{ asset('imgs/quintas-profile.png') }}" alt="">
                  </div>
                  <div class="main-info">
                    <p><strong>Username:</strong>quintou_th10</p>
                    <p><strong>Email:</strong>user@email.com</p>
                  </div>
                  <div class="info">
                      <h3>Information</h3>
                      <p><strong>Name:</strong> Name, Last Name</p>
                      <p><strong>Email:</strong> user@email.com</p>
                      <p><strong>Phone:</strong> +55 (11) 90000-0000</p>
                      <p><strong>Country:</strong> Brazil</p>
                  </div>
                  <div class="profile-buttons">
                    <button class="btn outline">Log Out</button>
                    <button class="btn danger">Delete Account</button>
                  </div>
              </section>
  
              <section class="card settings">
                  <h2>User Settings</h2>
  
                  <form>
                    @csrf
                      <div class="form-grid">
                          <input placeholder="First Name">
                          <input placeholder="Last Name">
                          <input placeholder="Username">
                          <input placeholder="Email">
                          <div class="phone">
                              <input value="+55">
                              <input placeholder="(11) 90000-0000">
                          </div>
                          <select>
                              <option>Brazil</option>
                          </select>
                      </div>
  
                      <button class="btn primary">Save changes</button>
  
                      <h3>Password</h3>
  
                      <div class="form-grid">
                          <div class="password">
                              <input type="password" placeholder="Your password">
                              <button type="button" class="toggle">
                                <i class="fa-solid fa-eye"></i>
                              </button>
                          </div>
  
                          <input type="password" placeholder="Repeat password">
  
                          <div class="password">
                              <input type="password" placeholder="New password">
                              <button type="button" class="toggle">
                                <i class="fa-solid fa-eye"></i>
                              </button>
                          </div>
  
                          <input type="password" placeholder="Confirm password">
                      </div>
  
                      <button class="btn primary">Save changes</button>
                  </form>
              </section>
          </div>
      </main>
  </div>
</body>
</html>