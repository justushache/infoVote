<html>


<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<body style='padding:15'>

<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" href="#">Homepage</a>
  </li>
  <li class="nav-item  justify-content-end">
    <a class="nav-link" href="/newUser.php">Cart</a>
  </li>
</ul>

<?php
$pdo = new PDO('mysql:host=localhost;dbname=signin', 'root', '');

$sql = "SELECT * FROM products";

$rows = $pdo->query($sql)->fetchAll();

echo '<div class="container-fluid pl-5 pr-5">';

for($i=0;$i<count($rows);$i+=1){

if($i%3 == 0)
    echo'<div class="row mr-5 ml-5 mt-3 mb-0">';
echo  '
<div class="col-lg-4">
<div class="card h-100">
  <div class="card-body">
    <h5 class="card-title">'.$rows[$i]["name"].'</h5>
    <h6 class="card-subtitle mb-2 text-muted">'.$rows[$i]["manufacturer"].'</h6>
    <p class="card-text">'.$rows[$i]["description"].'</p>
    <a href="#" class="card-link">Card link</a>
    <a href="#" class="card-link">Another link</a>
  </div>
  </div>
</div>';

if($i%3 == 2|| $i == count($rows)-1)
    echo '</div>';
}

echo '</div>';
?>
</div>

</html>