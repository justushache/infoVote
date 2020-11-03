<html>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<body style='padding:15'>

<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" href="#">Login</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="/newUser.php">Add User</a>
  </li>
</ul>

<content style='margin:15'>

<form>
  <div class="form-group">
    <label for="name">Username</label>
    <input type="text" class="form-control" name="name" aria-describedby="emailHelp">
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" name="password">
  </div>
  <button type="submit" class="btn btn-primary">Log in</button>
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

$sql = "SELECT password FROM `users` WHERE name = '".$username."'";
$result = $conn->query($sql);

if($result && $result->num_rows>0){
    $result->fetch_all(MYSQLI_ASSOC);
}

foreach($result as $service){
	foreach ($service as $string){
		$hashedPassword = password_hash($userPassword,PASSWORD_BCRYPT );
		if(password_verify($userPassword,$string)){
			echo "loged in";
		}
	}
	echo "<br>";
	}

$conn->close();
}
?>


</body>
</html>