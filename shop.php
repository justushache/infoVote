<html>


<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<body style='padding:15'>
<ul class="nav nav-tabs mb-2">
  <li class="nav-item">
    <a class="nav-link active" href="#">Startseite</a>
  </li>
  <li class="nav-item  justify-content-end">
    <a class="nav-link" href="addItem.php">Projekt hinzufügen</a>
  </li>
  <?php include_once 'currentUser.php'; echo getUserNavbar()?>  
</ul>

<?php
include_once 'star.php';
echo getStarCSS();

$pdo = new PDO('mysql:host=localhost;dbname=signin', 'root', '');

//get products sorted by votes,

  //table a is a table with all products joined on stars and admins where the uid is a admin
  //table u is a table with all products joined on stars and admins where the uid is not a admin
  //table p is a table with the average admin and user Star votes for each project

$sqlPrep = "CREATE TEMPORARY TABLE a SELECT products.ID, stars.stars as adminStars FROM products INNER JOIN stars ON products.ID = stars.pid LEFT JOIN admin ON admin.uid = stars.uid WHERE admin.uid IS NOT NULL;
            CREATE TEMPORARY TABLE u SELECT products.ID, stars.stars as userStars FROM products INNER JOIN stars ON products.ID = stars.pid LEFT JOIN admin ON admin.uid = stars.uid WHERE admin.uid IS NULL;
            CREATE TEMPORARY TABLE p SELECT avg(adminStars) as adminStars, avg(userStars) as userStars, a.ID as aID, u.ID as uID FROM products LEFT JOIN u ON u.ID=products.ID LEFT JOIN a ON a.ID = products.ID GROUP BY products.ID;
            UPDATE p SET aID = uID, adminStars = userStars WHERE aID IS NULL;
            UPDATE p SET uID = aID, userStars = adminStars WHERE uID IS NULL;";

  //actually gets the projects, uses the table p to sort the list.
$sql = "SELECT * FROM products LEFT JOIN (SELECT aid as pid, ROUND((adminStars+userStars)/2,0) as avgStars FROM p)t ON t.pid = products.ID ORDER BY t.avgStars DESC;";


$pdo->exec($sqlPrep);
$rows = $pdo->query($sql)->fetchAll();

echo '<div class="container-fluid pl-5 pr-5">';


for($i=0;$i<count($rows);$i+=1){

  // get username to uid for the row
  $row = $rows[$i];
  $pdo = new PDO('mysql:host=localhost;dbname=signin', 'root', '');
  $sql = 'SELECT name FROM users WHERE ID ='.$rows[$i]["uid"];
  $manufacturer = $pdo->query($sql)->fetch()[0];

  //start a new row every 3 cards
  if($i%3 == 0)
        echo'<div class="row mr-5 ml-5 mt-3 mb-0">';
  //show the card
  echo  "
  <div class='col-lg-4'>
    <div class='card h-100 w-100'>
      <div style='position:relative; padding-top: 56%;'>
        <img src='uploads/$row[imagepath].' class='img-fluid' alt='Product image' style='position:absolute;top:0;object-fit: cover;width:100%;height:100%'>
      </div >
      <div class='card-body w-100'>
        <div class='row'>
          <h5 class='col-8 my-1 card-title'>$row[name]</h5>
          <div class='col-4'>".getStarHTMLToShow($row['avgStars'])."</div>
        </div>
        <a href='u.php?uid=$row[uid]' class='card-link'>$manufacturer</a>
        <p class='card-text'>$row[description]</p>
        <a href='$row[homepage]' class='card-link'>Zur Website</a>
        <a href='p.php?pid=$row[ID]' class='card-link float-right'>Mehr</a>
      </div>
    </div>
  </div>";
  //end the row
  if($i%3 == 2|| $i == count($rows)-1)
    echo '</div>';
}

echo '</div>';
?>
</div>

</html>
