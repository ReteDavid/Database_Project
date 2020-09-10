<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>LIBRARY - Simulation</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Welcome to our library</h2>
  </div>
<style>
body{
	background-image: url('welcome.jpg');
}
</style>	
  <form method="post" action="register.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  	  <label>Username</label>
  	  <input type="text" name="username" value="<?php echo $username; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Email</label>
  	  <input type="email" name="email" value="<?php echo $email; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password_1">
  	</div>
  	<div class="input-group">
  	  <label>Confirm password</label>
  	  <input type="password" name="password_2">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user" style="margin:5px;">Register</button>
  	</div>
  	<p>
  		Already a member? <a href="login.php" style="margin:5px;">Sign in</a>
  	</p>
    <p>
      You the librarian, aren't you? <a href="login.php" style="margin:5px;">YESS</a>
    </p>
  </form>
</body>
</html>