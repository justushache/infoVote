<html>


<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<body style='padding:15'>

<?php
    include_once 'star.php';
    echo getStarCSS();
    echo getStarJS();
?>


<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link" href="/shop.php">Homepage</a>
  </li>
  <li class="nav-item  justify-content-end">
    <a class="nav-link " href="/addItem.php">add Item</a>
  </li>
  <li class="nav-item  justify-content-end">
    <a class="nav-link active" href="">Review</a>
  </li>
  <?php include_once 'currentUser.php'; echo getUserNavbar()?>  
</ul>

<?php
    //display project-title
    if(isset($_GET['pid'])){
        $pdo = new PDO('mysql:host=localhost;dbname=signin', 'root', '');
        $sql = "SELECT name FROM products WHERE ID = $_GET[pid]";
        $res = $pdo->query($sql);
        if($res){
            $n = $res->fetch()[0];
            echo "<h2 class='text-center m-2'>Neues Review zu $n</h2>";
        }
    }
?>

<form action="#" method="post" enctype="multipart/form-data">
<div class="input-group pt-3 w-75 mx-auto">
  <div class="form-group w-100 pt-1">
    <label for="title">Review - Titel</label>
    <input type="text" class="form-control" name="title">
  </div>
  <?php
    echo getStarHTMLToVote($_GET['pid']);
  ?>
  <div class="form-group w-100 pt-1">
    <label for="review">Review</label>
    <textarea class="form-control" aria-label="With textarea" name='review'></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Review absenden</button>
</div>
</form>

<?php

  if(isset($_POST["title"])&&isset($_POST["review"])&&isset($_GET["pid"])&&
    $_POST["title"]!=''&& $_POST["review"] !='' &&is_numeric($_GET["pid"])){
      
    if(session_id() == '' || !isset($_SESSION)) {
        session_start();
    }

    //check if log in was performed
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
    $pid = $_GET['pid'];

    $pdo = new PDO('mysql:host=localhost;dbname=signin', 'root', '');

    //check if the user didnt write a review already  
    $sql = "SELECT ID from reviews WHERE uid ='$uid' AND pid = '$pid'";
    if($pdo->query($sql)->rowCount()>0){
        die ('sie dürfen nur ein Review pro Produkt schreiben');
    };

    //put uid, title, review and pid in the database,
      $sql = 'INSERT INTO reviews (uid,title,review,pid) VALUES ("'
	  .$uid.'","'
	  .$_POST["title"].'","'
	  .$_POST["review"].'","'
	  .$pid.'")';
    $pdo->query($sql);
    echo "<script>alert('HI')</script>";
    
    //redirect to the projekt
    header('Location: /shop.php');
  }else{
	  echo("not all field are populated");
  }
?>

</html>