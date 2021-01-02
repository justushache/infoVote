<html>


<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<body class="bg-light">
<ul class="nav nav-tabs mb-2 bg-white">
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


<div class="container-fluid w-75 bg-white">
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
    echo "<div class='col-md'>";
        //the image of the project
        echo  "<div style='position:relative' class='row-sm'>
                    <img src='uploads/$project[imagepath]' class='img-fluid' alt='Product image' style='top:0;object-fit:cover;width:100%'>
                </div>";
                
        //a row with buttons to write a review (new page) and to go to the website
        echo    "<div class='card col-sm my-2'>
            <div class='row'>
                <a href='$project[homepage]' class='col btn btn-primary m-2'>Zu der Website</a>
                <a href='/v.php?pid=$project[ID]' class='col btn btn-primary m-2'>Review schreiben</a>
            </div>
        </div>";
        //display the opinions of other users, excluding those of admins
        $sql = "SELECT reviews.uid,name, title, review, stars FROM reviews INNER JOIN users ON reviews.uid=users.ID LEFT JOIN admin ON admin.uid = users.ID LEFT JOIN stars ON (reviews.pid=stars.pid AND reviews.uid=stars.uid) WHERE reviews.pid = $pid and admin.uid IS NULL";
        $reviews = $pdo->query($sql)->fetchAll();
        include_once 'star.php';
        echo getStarCSS();
        for($i=0;$i<count($reviews);$i+=1){
            $p = $reviews[$i];
            //display how many stars the user voted
            $s = '';
            if(is_numeric($p['stars'])){
                $s = getStarHTMLToShow($p['stars']);
            }
            echo "  <div class='card my-2 p-3'>
                        <div class='row'>
                        <h3 class='col-8'>$p[title]</h3>
                        $s
                        </div   >
                        <a href='/u.php?uid=$p[uid]' class='card-link'>$p[name]</a>
                        <p>$p[review]</p>
                    </div>";
        }
    echo "</div>";

    // a col containing the description of the maker and the opinion of the admin
    echo "<div class='col-sm order-md-last order=sm-first'>";
            //the description of the maker
                echo    "<div class='card col-sm my-2'>
                            <h3>Beschreibung des Autors:</h3>
                            <p>$project[description]</p>
                     </div>";
            echo '<h4>Das sagen die Administratoren:</h4>';
            //the opinion of the adimins 
            //the opinions of the admins are normal reviews, but admins are listed in the admin table
            $sql = "SELECT reviews.uid,name, title, review, stars FROM reviews INNER JOIN admin ON reviews.uid=admin.uid INNER JOIN users ON users.ID=admin.uid LEFT JOIN stars ON (reviews.pid=stars.pid AND reviews.uid=stars.uid) WHERE reviews.pid = $pid ";
            $reviews = $pdo->query($sql)->fetchAll();
            for($i=0;$i<count($reviews);$i+=1){
                $p = $reviews[$i];
                //display how many stars the user voted
                $s = '';
                if(is_numeric($p['stars'])){
                    $s = getStarHTMLToShow($p['stars']);
                }
                echo "  <div class='card my-2 p-3'>
                            <div class='row'>
                            <h3 class='col-8'>$p[title]</h3>
                            $s
                            </div   >
                            <a href='/u.php?uid=$p[uid]' class='card-link'>$p[name]</a>
                            <p>$p[review]</p>
                        </div>";
                }
    echo "</div>";
  
  echo "</div>";
}
?>
<div>

</html>