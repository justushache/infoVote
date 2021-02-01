<?php
//this is a file, soly to echo the html to create the voting stars and to store changes of stars in the db
//when there is a valid post entry of pid, sid and stars with a number between 1 and 5, this file will store the values in a db

include_once 'validateInputText.php';

if(isset($_POST['pid'])&&isset($_POST['stars'])){
    echo '<br>ALL VARIABLES SET<br>';
    $pdo = new PDO('mysql:host=localhost;dbname=signin', 'root','');
    //get uid from sid
    include_once 'currentUser.php';
    $usr = getUser();
    if($usr==''){
        die('no valid user');
    }
    $uid = $usr[0];
    $pid = removeCriticalText($_POST['pid']);
    $stars = removeCriticalText($_POST['stars']);

    // check, if the user did already vote
    $sql =  "SELECT ID from stars WHERE pid = $pid AND uid = $uid";
    echo $sql;
    $result = $pdo->query($sql);
    if($result->rowCount()>0){
        // the user did already vote, update the entry
        $sql="UPDATE stars SET stars=$stars WHERE pid = $pid AND uid = $uid";
    }else{
        //the user did not vote yet, insert the entry
        $sql="INSERT INTO stars (pid,uid,stars) VALUES($pid,$uid,$stars)";
    }
    

    $pdo->query($sql);
}

function getStarHTMLToVote($pid){

    echo "<div class='rating'>";
        // echo each star as a radio buttion
        //check, if user is signed in, if not set color to grey, disable
        include_once 'currentUser.php';
        $disabled = 'disabled';
        $color = "style='color:grey'";
        if(getUser()!=''){
            $disabled = '';
            $color = '';
        }

        for($i=5;$i>0;$i--){
            echo "<input type='radio' name='rating' value=$i id=$i $disabled><label for=$i $color style='font-size:5vw'>☆</label>";
        }
    echo "</div>";
}

function getStarHTMLToShow($stars){
    $html= "<div class='rating'>";
        // echo the stars, which are coresponding  to the current value
        for($i=5;$i>0;$i--){
            if($i>$stars){
                $lbl = '☆';
            }else{
                $lbl = '★';
            }
            $html=$html."<label class='label'>$lbl</label>";
        }
    $html=$html."</div>";
    return $html;
}


function getStarCSS()
{
    return '
<style>
    .rating {
        display: flex;
        flex-direction: row-reverse;
        justify-content: center;
    }

    .rating>input{
        display:none
    }
    .rating>label{
        color:#f7d62d;
        font-size:2vw;
        position:relative;
        top:-1vw;
    }
    .rating>label:before{
        position:absolute;
        content: "\2605";
        opacity:0;
    }
    .rating>input:checked~label:before{
        opacity:1;
    }
    .rating>input:not(checked)~label:before{
        opacity:0;
    }
</style>';
}
function getStarJS()
{echo"
<script>
    function updateStars(stars, pid){
        let xhttp = new XMLHttpRequest();
        xhttp.open('POST','star.php',true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        xhttp.onreadystatechange  = function(){
            if(xhttp.readyState=== XMLHttpRequest.DONE){
                console.log(xhttp.responseText);
            }
        }
        xhttp.send('stars='+stars+'&pid='+pid);
    }
</script>";
}
?>