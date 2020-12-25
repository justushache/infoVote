<html>


<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<body style='padding:15'>
<ul class="nav nav-tabs mb-2">
  <li class="nav-item">
    <a class="nav-link" href="/shop.php">Homepage</a>
  </li>
  <li class="nav-item  justify-content-end">
    <a class="nav-link" href="/addItem.php">add Item</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="#">Projekt</a>
  </li>
  <?php include_once 'currentUser.php'; echo getUserNavbar()?>  
</ul>


<div class="container-fluid pl-5 pr-5">
<?php
if(isset($_GET['pid'])){
  $pid = $_GET['pid'];
  $pdo = new PDO('mysql:host=localhost;dbname=signin', 'root', '');

  //chek if the uid is valid and get the username
  $sql = "SELECT * FROM products WHERE ID='$pid'";

  $project = $pdo->query($sql)->fetchAll()[0];

  //chek if the uid is valid and get the username
  $sql = "SELECT name FROM users WHERE ID='$project[uid]'";
  $username = $pdo->query($sql)->fetchAll()[0][0];

  echo "<center><h1><b><u>$project[name]</u> von $username</b></h1></center>";
  echo  "<div style='position:relative' class='mb-3'>
            <img src='uploads/$project[imagepath]' class='img-fluid' alt='Product image' style='top:0;object-fit:cover;width:100%'>
        </div>
        <h3>Beschreibung des Autors:</h3>
        <p>$project[description]</p>
        <a href='$project[homepage]' class='btn btn-primary stretched-link'>Zu der Website</a>";
}
?>
<div>

</html>