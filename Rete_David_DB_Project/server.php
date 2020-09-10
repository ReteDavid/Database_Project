<?php
session_start();

$username = "";
$email    = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', 'samidavid2', 'registration');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

 
  $user_check_query ="SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

 
  if (count($errors) == 0) {
  	$password = md5($password_1);

  	$query = "INSERT INTO `users` (username, email, password) 
  			  VALUES('$username', '$email', '$password')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: index.php');
  }
}

// LOGIN USER
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$password = md5($password);
  	$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['username'] = $username;
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: index.php');
  	}else {
  		//array_push($errors, "Wrong username/password combination");
  		header('location: index.php');
  	}
  }
}

//LOGIN LIBRARIAN
if(isset($_POST['login_librarian'])){
	$code = mysqli_real_escape_string($db, $_POST['code']);

	if (empty($code)) {
  	array_push($errors, "code is required");
  }
  $query = "SELECT * FROM librarian WHERE codes='$code'";
  $results = mysqli_query($db, $query);
  if (mysqli_num_rows($results) == 1) {
  	$_SESSION['codes'] = $code;
    $_SESSION['success'] = "You are now logged in";
  	 header('location: index1.php');
  }
}
//SEE AVAILABILITY OF BOOKS -> FOR LIBRARIAN
if(isset($_POST['see_books'])){
	$_SESSION['success'] = "You are now logged in";
  	 header('location: index.php');
	}

//DELETE BOOKS -> LIBRARIAN
	if(isset($_POST['delete_books'])){
		$sql = "DELETE FROM books WHERE name='Book'";
	if(mysqli_query($db, $sql)){
   	 echo "Records were deleted successfully.";
   	 		$_SESSION['success'] = "You are now logged in";
  	 		header('location: index.php');
	} else{
    	echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
	}
	}
//UPDATE availability?
if(isset($_POST['update_books'])){
	$sql = "UPDATE books SET state='unavailable' WHERE id=3";

	if ($db->query($sql) === TRUE) {
  		echo "Record updated successfully";
  		$_SESSION['success'] = "You are now logged in";
  	 	header('location: index.php');
	} else {
  	echo "Error updating record: " . $db->error;
}
}
//INSERT NEW BOOKS
if(isset($_POST['insert_books'])){
$sql = "INSERT INTO books (id, name, author, state)
VALUES ('1', 'Book', 'eu', 'available')";

if ($db->query($sql) === TRUE) {
  echo "New record created successfully";
  	$_SESSION['success'] = "You are now logged in";
  	 header('location: index.php');
} else {
  echo "Error: " . $sql . "<br>" . $cdb->error;
}
}
?>