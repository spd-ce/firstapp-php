<?php
    session_start();
?>

<html>
<head>
  <title>My App</title>
</head>
<body>
    <h1>My App</h1>
    <hr/>
<?php  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']==True){ ?>
    <h2>Welcome <?php echo($_SESSION['fullname']); ?></h2>
<?php }else{ ?>
    <h2><a href="register.php">Register</a> | <a href="login.php">Login</a> </h2>
<?php } ?>
    <hr/>
    <img src="https://upload.wikimedia.org/wikipedia/commons/f/f7/PHP_-_learn_php_programming_online_programming_practice.jpg"/>
</body>
</html>