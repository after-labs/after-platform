<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Control</title>
    <link rel="stylesheet" href="/css/global.css">
    <link rel="stylesheet" href="/css/users_control_adm.css">
</head>
<body>

     <iframe src="header_adm.html" style="border:none; width:100%; height:100px;"></iframe>
   
<main>
  <h1>Users</h1>

  <section class="card">

    <div class="search-row">
      <input type="text" placeholder="Search by username, email or ID">
      <span class="total">Total Users: 340</span>
    </div>

    <div class="filters">
      <button class="btn active">All Users</button>
      <button class="btn">Active Users</button>
      <button class="btn">Inactive Users</button>
      <button class="btn">Admin Users</button>
      <button class="btn create">Create User</button>
    </div>
    </section> <br>


    <section class="card">
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>USERNAME</th>
          <th>EMAIL</th>
          <th>USER TYPE</th>
          <th>ACTIVE STATUS</th>
        </tr>
      </thead>

      <tbody>
       
        <tr>
          <td>U-0001-0001</td>
          <td>quitten_h10</td>
          <td>thiago@email.com</td>
          <td class="select">Client ▾</td>
          <td class="select">Active ▾</td>
        </tr>

        <tr>
          <td>U-0001-0001</td>
          <td>quitten_h10</td>
          <td>thiago@email.com</td>
          <td class="select">Client ▾</td>
          <td class="select">Active ▾</td>
        </tr>

        <tr>
          <td>U-0001-0001</td>
          <td>quitten_h10</td>
          <td>thiago@email.com</td>
          <td class="select">Client ▾</td>
          <td class="select">Active ▾</td>
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