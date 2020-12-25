<html>


<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<body style='padding:15'>
<ul class="nav nav-tabs mb-2">
  <li class="nav-item">
    <a class="nav-link active" href="#">Homepage</a>
  </li>
  <li class="nav-item  justify-content-end">
    <a class="nav-link" href="/addItem.php">add Item</a>
  </li>
  <?php include 'currentUser.php'; echo getUserNavbar()?>  
</ul>

<?php
$pdo = new PDO('mysql:host=localhost;dbname=signin', 'root', '');

//TODO: if the voting system is implemented, sort by votes
$sql = "SELECT * FROM products";

$rows = $pdo->query($sql)->fetchAll();

echo '<div class="container-fluid pl-5 pr-5">';

for($i=0;$i<count($rows);$i+=1){

  // get username to uid for the row
  $pdo = new PDO('mysql:host=localhost;dbname=signin', 'root', '');
  $sql = 'SELECT name FROM users WHERE ID ='.$rows[$i]["uid"];
  $manufacturer = $pdo->query($sql)->fetch()[0];

  //start a new row every 3 cards
  if($i%3 == 0)
        echo'<div class="row mr-5 ml-5 mt-3 mb-0">';
  //show the card
  echo  '
  <div class="col-lg-4">
    <div class="card h-100 w-100">
      <div style="position:relative; padding-top: 56%;">
        <img src="uploads/'.$rows[$i]["imagepath"].'" class="img-fluid" alt="Product image" style="position:absolute;top:0;object-fit: cover;width:100%;height:100%">
      </div >
      <div class="card-body w-100">
        <h5 class="card-title">'.$rows[$i]["name"].'</h5>
        <a href="/u.php?uid='.$rows[$i]["uid"].'" class="card-link">'.$manufacturer.'</a>
        <p class="card-text">'.$rows[$i]["description"].'</p>
        <a href="'.$rows[$i]['homepage'].'" class="card-link">Website</a>
        <a href="/p.php?pid='.$rows[$i]['ID'].'" class="card-link float-right">More</a>
      </div>
    </div>
  </div>';
  //end the row
  if($i%3 == 2|| $i == count($rows)-1)
    echo '</div>';
}

echo '</div>';
?>
</div>

</html>