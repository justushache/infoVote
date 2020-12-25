<html>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<body style='padding:15'>

<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link" href="/shop.php">Homepage</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="/index.php">Login</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="#">Add User</a>
  </li>
</ul>

<content style='margin:15'>

<form method="POST">
  <div class="form-group">
    <label for="name">Username</label>
    <input type="text" class="form-control" name="name" aria-describedby="emailHelp">
    <small id="emailHelp" class="form-text text-muted">Ihr Name ist bei uns fast sicher</small>
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" name="password" aria-describedby="pwdHelp">
    <small id="pwdHelp" class="form-text text-muted">Ihr Passwort ist bei uns definitiv nicht sicher</small>
  </div>
  <button type="submit" class="btn btn-primary">Create new User</button>
</form>

</content>

<?php
if(isset($_POST["name"])&&isset($_POST["password"])){
	$username = $_POST["name"];
    $userPassword = $_POST["password"];
$servername = "localhost";
$serverusername = "root";
$password = "";
$dbname = "signin";

// Create connection
$conn = new mysqli($servername, $serverusername, $password,$dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 

//check if username exists
$sql = "SELECT password,ID FROM `users` WHERE name='$username'";
$result = $conn->query($sql);
if($result->num_rows >0){
  die('your username is already taken');
}

//insert user into database
$hashedPassword = password_hash($userPassword,PASSWORD_BCRYPT );
$sql = "INSERT INTO users(name,password) VALUES('".$username."','".$hashedPassword."')";
$result = $conn->query($sql);

if($result){
  echo"userCreated";
  include 'session.php';
  //TODO: create a new session
	createSession($username,$userPassword);
  header("Location: /shop.php");
}else{
	echo"Ihr Benutzer konnte leider nicht angelegt werden";
}

$conn->close();
}
?>


</html>


