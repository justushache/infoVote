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
  <li class="nav-item  justify-content-end">
    <a class="nav-link active" href="">add Item</a>
  </li>
  <?php include_once 'currentUser.php'; echo getUserNavbar()?>  
</ul>


<form action="#" method="post" enctype="multipart/form-data">
<div class="input-group pt-3 w-75 mx-auto">
  <div class="custom-file">
    <input type="file" class="custom-file-input" id="fileToUpload" name="fileToUpload">
    <label class="custom-file-label" for="fileToUpload">Choose file</label>
  </div>

  <div class="form-group w-100 pt-1">
    <label for="name">Name</label>
    <input type="text" class="form-control" name="name">
  </div>
  <div class="form-group w-100 pt-1">
    <label for="manufacturer">manufacturer</label>
    <input type="text" class="form-control" name="manufacturer">
  </div>
  <div class="form-group w-100 pt-1">
    <label for="number">Number</label>
    <input type="number" class="form-control" name="number">
  </div>
  <div class="form-group w-100 pt-1">
    <label for="description">Description</label>
    <input type="text" class="form-control" name="description">
  </div>
  <div class="form-group w-100 pt-1">
    <label for="homepage">Homepage.php</label>
    <input type="text" class="form-control" name="homepage">
  </div>
  <button type="submit" class="btn btn-primary">Add a new item</button>
</div>
</form>

<?php
  if(isset($_POST["name"])&&isset($_POST["manufacturer"])&&isset($_POST["number"])&&isset($_POST["description"])&&isset($_POST["homepage"])&&$_FILES["fileToUpload"]&&
    $_POST["name"]!=''&&$_POST["manufacturer"]!=''&&$_POST["number"]!=''&&$_POST["description"]!=''&&$_POST["homepage"]){
    //for some reason empty fields are now empty strings, so check for that

    //check if log in was performed
    
    if(session_id() == '' || !isset($_SESSION)) {
      // session isn't started
      session_start();
    }
    
    if(!isset($_SESSION['id'])){
      header('Location: /index.php');
      die('bitte erst anmelden');
    }

    //check if session is valid
    include_once 'session.php';
    if(is_session_valid($_SESSION['id'])!=true){
      header('Location: /index.php');
      die('sie wurden automatisch abgemeldet');
    }

    //gey uid
    $uid = $_SESSION['uid'];

	  //save img as millis+productname.dateiextension
	  $target_dir = "uploads";
	  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	  $uploadOk = 1;
	  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	  $imagepath = round(microtime(true)*1000).$_POST["name"].".".$imageFileType;
	  if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'],"$target_dir/".$imagepath)==false){
	  	echo "we had an error";
	  }
  
	  //add product to database
      $pdo = new PDO('mysql:host=localhost;dbname=signin', 'root', '');
      $sql = 'INSERT INTO products (name, uid,number,description,imagepath,homepage) VALUES ("'
	  .$_POST["name"].'","'
	  .$uid.'","'
	  .$_POST["number"].'","'
	  .$_POST["description"].'","'
	  .$imagepath.'","'
	  .$_POST["homepage"].'")';
    $pdo->query($sql);
    
    // redirect to shop.php
    header('Location: /shop.php');
  }elseif(isset($_POST["name"])||isset($_POST["manufacturer"])||isset($_POST["number"])||isset($_POST["description"])||isset($_POST["homepage"])||isset($_FILES["fileToUpload"])){
    //only display error, if user sent data
	  echo("not all field are populated");
  }
?>


<script type="application/javascript">
    $('input[type="file"]').change(function(e){
        var fileName = e.target.files[0].name;
        $('.custom-file-label').html(fileName);
    });
</script>

</html>