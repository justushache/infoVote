<?php
  //delete the session and redirect to login page
  session_start();
  $_SESSION = array();
  session_destroy();
  header('Location: index.php');
?>