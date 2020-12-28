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

  // the project name
  echo "<center><h1><b><u>$project[name]</u> von $username</b></h1></center>";

  //a row containing the image and the professional descriptions
  echo "<div class='row'>";

    //container to display image and opinions of other users under the image
    echo "<div class='col-7'>";
        //the image of the project
        echo  "<div style='position:relative' class='row-sm'>
                    <img src='uploads/$project[imagepath]' class='img-fluid' alt='Product image' style='top:0;object-fit:cover;width:100%'>
                </div>";
        //display the opinions of other users
        $sql = "SELECT uid,name, title, review FROM reviews INNER JOIN users ON reviews.uid=users.ID WHERE pid = $pid ";
        $reviews = $pdo->query($sql)->fetchAll();
        for($i=0;$i<count($reviews);$i+=1){
            $p = $reviews[$i];
            //TODO: display how many stars the user voted
            echo "  <div class='card my-2 p-3'>
                        <h3>$p[title]</h3>
                        <a href='/u.php?uid=$p[uid]' class='card-link'>$p[name]</a>
                        <p>$p[review]</p>
                    </div>";
        }
    echo "</div>";

    //TODO: display above image, if space gets to small
    // a col containing the description of the maker and the opinion of the admin
    echo "<div class='col-5'>";
            //the description of the maker
                echo    "<div class='card col-sm my-2'>
                            <h3>Beschreibung des Autors:</h3>
                            <p>$project[description]</p>
                     </div>";
            //the opinion of the adimins
            //TODO: add stars to display the conclusion of the administrator
            echo    "<div class='card col-sm my-2'>
                        <h3>Beschreibung des Autors:</h3>
                        <p>$project[description]</p>
                        <h3>Bewertung der Administratoren:</h3>
                        <p>wir findens ganz toll</p>
                    </div>";
            //a row with buttons to write a review (new page) and to go to the website
            echo    "<div class='card col-sm'>
                        <div class='row'>
                            <a href='$project[homepage]' class='col btn btn-primary m-2'>Zu der Website</a>
                            <a href='/v.php?pid=$project[ID]' class='col btn btn-primary m-2'>Review schreiben</a>
                        </div>
                    </div>";
    echo "</div>";
  
  echo "</div>";
}
?>
<div>

</html>