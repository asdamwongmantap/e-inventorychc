<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
<title>Area Login</title>
    <link rel="stylesheet" href="logincss/style.css">
	<link rel="shortcut icon" href="images/logochclg.png" />

<link href="style.css" rel="stylesheet" type="text/css" />

 <!-- Le styles -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
	<link href="assets/css/vertikalmenu.css" rel="stylesheet">
    <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">
	

</head>

<body>

  <div class="login-wrap">
  <h2>Login</h2>

  <div class="form">
  <form action="cek_login.php" method="post" onSubmit=\"return validasi2(this)\">
    <input type="text" placeholder="NIP" name="nip" require autofocus />
    <input type="password" placeholder="Password" name="password" />
    <input type="submit" class="button" style="width:40%;background:#a2324c;" value="Login">&nbsp;
	<a href="" class="button" style="float:right;width:50%;background:#a2324c;">Daftar</a><p></p><a href="" class="button" style="width:100%;background:#a2324c;">Lupa Password?</a>
  </form>
  </div>
</div>

  <script src='js/jquery-1.11.3.min.js'></script>

  <script src="loginjs/index.js"></script>

</body>

</html>