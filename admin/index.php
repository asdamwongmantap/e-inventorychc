<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
<title>Login</title>
        <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <div class="container">
  <div id="login-form">
    <h3>Login Admin</h3>
    <fieldset>
      <form action="cek_login.php" method="POST">
        <input type="text" required  name="username" placeholder="Username" onBlur="if(this.value=='')this.value='Username'" onFocus="if(this.value=='Username')this.value='' "> <!-- JS because of IE support; better: placeholder="Username" -->
        <input type="password" name="password" required placeholder="Password" onBlur="if(this.value=='')this.value='Password'" onFocus="if(this.value=='Password')this.value='' "> <!-- JS because of IE support; better: placeholder="Password" -->
        <input type="submit" value="Login">
        <footer class="clearfix">
          <p><span class="info">?</span><a href="#">Forgot Password</a></p>
        </footer>
      </form>
    </fieldset>
  </div> <!-- end login-form -->
</div>
  </body>
</html>
