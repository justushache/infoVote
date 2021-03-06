<?php
    //returns '' if the user didnt sign in, else returns an array with {uid,username}
    function getUser(){

        if(session_id() == '' || !isset($_SESSION)) {
        // session isn't started
        session_start();
        }
        
        //check if log in was performed
        if(!isset($_SESSION['id'])){
          return '';
        }
    
        //check if session is valid
        include_once 'session.php';
        if(is_session_valid($_SESSION['id'])!=true){
          return '';
        }
        
        //get uid
        $uid = $_SESSION['uid'];
        $pdo = new PDO('mysql:host=localhost;dbname=signin', 'root', '');
        $sql = 'SELECT name FROM users WHERE ID ='.$_SESSION["uid"];
        $username = $pdo->query($sql)->fetch()[0];
        return array($uid,$username);
        session_destroy();
    }
    function getUserNavbar(){
        $returnString = '<ul class="nav nav-pills justify-content-end" style="flex-grow:1">';
        // $user will be an array if there is an user, else it will be an empy string
        $user = getUser();
        if($user!=''){
        //the card linking to the user profile
        $returnString =$returnString.'
        <li class="nav-item">
          <a class="nav-link" href="u.php?uid='.$user[0].'">
            <u>'.$user[1].'</u>
          </a>
        </li>';
        }   
        $cardLink = 'index.php';
        $cardTitle = 'Anmelden';   
        if($user!=''){
          $cardLink = 'logout.php';
          $cardTitle = 'Abmelden';
        }   
        //the card which is used for logout, and login depending on if there is a user
        $returnString =$returnString.'
        <li class="nav-item">
          <a class="nav-link" href="'.$cardLink.'">'.$cardTitle.'</a>
        </li>
        </ul>
        ';
        return $returnString;
    }
?>