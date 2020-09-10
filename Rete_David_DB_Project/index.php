<?php 
  session_start(); 

  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>LIBRARY - Simulation</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<style>
body{
  background-image: url('welcome.jpg');
}
</style>  
<div class="header">
	<h2>Library is full of books ready to be read!</h2>
</div>

<div class="content">

  	
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>

    
    <?php  if (isset($_SESSION['username'])) : ?>
    	<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>

    <?php endif ?>
    
    <!-- insert books table into form-->
    <div class="input-group">
      <label style="margin:5px;">Enter the id of book you want to borrow..</label>
      <input type="text" name="borrow_id" value="<?php echo $borrow_id; ?>">

      <div class="input-group">
      <button type="submit" class="btn" name="borrow_btn">Borrow</button>

    </div>
  </div>

  <table>
  <th>Id </th>
  <th>Book</th>
  <th>Author</th>
  <th>State</th>
  <?php
    $conn = mysqli_connect("localhost", "root", "samidavid2", "registration");
    
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT id, name, author, state FROM books";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    echo "<tr><td>" . $row["id"]. "</td><td>" . $row["name"] . "</td><td>"
    . $row["author"]. "</td><td>" . $row["state"] . "</td></tr>";
    }
    echo "</table>";
    } else { echo "0 results"; }

  ?>
</table>

 <!-- logout action-->
<?php  if (isset($_SESSION['username'])) : ?>

      <p> <a style="margin:5px;" href="index.php?logout='1'" style="color: red;" >logout</a> </p>
    <?php endif ?>

</div>
		
</body>
</html>