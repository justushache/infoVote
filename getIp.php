<form action="getIp.php" method="post">
	<input type="text" name="homepage"/> .php <br>
	<input type="submit">
</form>

<?php
$localIP = getRealIpAddr();
if(!empty($_POST["homepage"])){
	echo $localIP;
	$homepage = $_POST["homepage"];
	echo "<a href=\"http://$localIP/$homepage.php\"> zur Website </a>";
}else{
	echo "bitte Startseite eingeben";
}
function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
 ?>