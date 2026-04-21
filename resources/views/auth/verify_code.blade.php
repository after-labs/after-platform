<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Verify Code</title>
      @vite(['resources/css/app.css', 'resources/css/auth/verify_code.css'])
  </head>
  <body>
    <div class="container">
      <h1>Verify Code</h1>
      <p>
        Enter the passcode you just received on your email address ending with
        ********in@gmail.com.
      </p>
      <form method="post" action="">
        @csrf

        <div class="code-container">
          <input type="text" name="code[]" maxlength="1" class="code-input" />
          <input type="text" name="code[]" maxlength="1" class="code-input" />
          <input type="text" name="code[]" maxlength="1" class="code-input" />
          <input type="text" name="code[]" maxlength="1" class="code-input" />
          <input type="text" name="code[]" maxlength="1" class="code-input" />
          <input type="text" name="code[]" maxlength="1" class="code-input" />
        </div>

        <button>Verify Code</button>
        <a>Send Code Again</a>
      </form>
    </div>
  </body>
</html>
