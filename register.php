<?php
	session_start();
	
	// initializing variables
	$fullname    = "";
	$username = "";
	$errors = array(); 
	
	// connect to the database
	$db = mysqli_connect('localhost', 'root', '', 'myapp');

	// REGISTER USER
	if (isset($_POST['reg_user'])) {
		// receive all input values from the form
		$fullname = mysqli_real_escape_string($db, $_POST['fullname']);
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);


		// form validation: ensure that the form is correctly filled ...
		// by adding (array_push()) corresponding error unto $errors array
		if (empty($fullname)) { array_push($errors, "Fullname is required"); }
		if (empty($username)) { array_push($errors, "Username is required"); }
		if (empty($password)) { array_push($errors, "Password is required"); }

		// If no error, add data into database
		if( count($errors)==0){
			$query = "INSERT INTO users (username, password, fullname) VALUES('$username', MD5('$password'), '$fullname' )";
			mysqli_query($db, $query);

			//Add to session variables
			$_SESSION['username'] = $username;
			$_SESSION['fullname'] = $fullname;
			$_SESSION['loggedin'] = True;

			//Redirect to index.php
			header('location: index.php');
		}

	}
?>


<html>
<head>
  <title>Registration</title>
  <style>
	div{padding:5px;}
  </style>
</head>
<body>

  <h1>Register</h1>
  <hr/>
  <form method="post" action="register.php">
  	<div>
  	  <label>Fullname</label>
  	  <input type="text" name="fullname" value="<?php echo $fullname; ?>">
  	</div>

  	<div>
  	  <label>Username</label>
  	  <input type="text" name="username" value="<?php echo $username; ?>">
  	</div>

  	<div>
  	  <label>Password</label>
  	  <input type="password" name="password">
  	</div>

  	<div>
  	  <button type="submit" class="btn" name="reg_user">Register</button>
  	</div>
  </form>

<?php  if (count($errors) > 0) : ?>
  <hr/>
  <ul style="color:red;">
  	<?php foreach ($errors as $error) : ?>
  	  <li><?php echo $error ?></li>
  	<?php endforeach ?>
  </ul>
<?php  endif ?>


</body>
</html>