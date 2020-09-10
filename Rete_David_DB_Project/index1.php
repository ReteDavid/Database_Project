<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>LIBRARY - Simulation</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
    <h2>Library Management</h2>
  </div>
<style>
body{
  background-image: url('welcome.jpg');
}
</style>  
  <form method="post" action="register.php">
    <?php include('errors.php'); ?>
    
    <div class="input-group">
      <button type="submit" class="btn" name="see_books" style="margin:5px;">Book and availability</button>
    </div>
    <div class="input-group">
      <button type="submit" class="btn" name="delete_books" style="margin:5px;">Delete Books</button>
    </div>
    <div class="input-group">
      <button type="submit" class="btn" name="update_books" style="margin:5px;">Update the state of books</button>
    </div>
    <div class="input-group">
      <button type="submit" class="btn" name="insert_books" style="margin:5px;">Insert New Books</button>
    </div>
     <p>
      HomePage? <a href="login.php" style="margin:5px;">YESS</a>
    </p>
  </form>
</body>
</html>