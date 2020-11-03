<html>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<body style='padding:15'>

<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link" href="/index.php">Login</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="#">Add User</a>
  </li>
</ul>

<content style='margin:15'>

<form>
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
if(isset($_GET["name"])&&isset($_GET["password"])){
	$username = $_GET["name"];
    $userPassword = $_GET["password"];
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

$sql = "SELECT password,ID FROM `users`";
$result = $conn->query($sql);

$valid = true;
if($result){
foreach($result as $entry){
	if(password_verify($userPassword,$entry["password"])){
		$name = $conn->query("SELECT name FROM users WHERE ID='".$entry["ID"]."'")->fetch_all(MYSQLI_ASSOC)[0]["name"];
		echo "the password '".$userPassword."' is already taken by '".$name."'<br>";
		$valid = false;
	}
}
}else{
	echo"error";
}
if(!$valid){
	die();
}

$hashedPassword = password_hash($userPassword,PASSWORD_BCRYPT );
$sql = "INSERT INTO users(name,password) VALUES('".$username."','".$hashedPassword."')";
$result = $conn->query($sql);

if($result){
	echo"userCreated";
}else{
	echo"error";
}

$conn->close();
}
?>


</html>


