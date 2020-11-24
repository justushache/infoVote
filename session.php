<?php
	//returns true if the session is valid may return false if the sessions is not valid but wont do so reliably
	function is_session_valid($hash){
		$sql = "SELECT millisCreated FROM sessions WHERE hash = '$hash'";
		$pdo = new PDO('mysql:host=localhost;dbname=signin', 'root', '');
		$result = $pdo->query($sql);
		$fetched = $result->fetch();
		$millisCreated =  (float)$fetched['millisCreated'];
		$millis = microtime(true);
		if($millis-$millisCreated>30){
			return false;
		}else{
			return true;
		}
	}

?>