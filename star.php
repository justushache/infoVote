<?php
//this is a file, soly to echo the html to create the voting stars and to store changes of stars in the db
//when there is a valid post entry of pid, sid and stars with a number between 1 and 5, this file will store the values in a db

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
?>