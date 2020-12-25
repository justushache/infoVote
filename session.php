<?php
	//returns true if the session is valid may return false if the sessions is not valid but wont do so reliably
	function is_session_valid($hash){
		$sql = "SELECT millisCreated FROM sessions WHERE hash = '$hash'";
		$pdo = new PDO('mysql:host=localhost;dbname=signin', 'root', '');
		$result = $pdo->query($sql);
		$fetched = $result->fetch();
		$millisCreated =  (float)$fetched['millisCreated'];
		$millis = microtime(true);
		if($millis-$millisCreated>1800){
			return false;
		}else{
			return true;
		}
	}

	//returns true, if the session was succesfully created, if not, false
	function createSession($username,$password){
		$succesfull = FALSE;
		// Create connection
		$conn = new mysqli("localhost", "root", "","signin");

		// Check connection
		if ($conn->connect_error) {
		  die("Connection failed: " . $conn->connect_error);
		} 

		$sql = "SELECT password, ID FROM `users` WHERE name = '".$username."'";
		$result = $conn->query($sql);

		if($result && $result->num_rows>0){
		    $result->fetch_all(MYSQLI_ASSOC);
		}

		foreach($result as $row){
				$string = $row["password"];
				$id = $row["ID"];
				if(password_verify($password,$string)){
					echo "loged in";
					echo "user id:".$id;
					//get millis
					$millis = microtime(true);
					//hash uname+millis for session-hash
					$hashedString = hash("sha1",$username.$millis);
					echo "<br> millis:".$millis. " hash:". $hashedString."<br>";
					//add session to db
					$pdo = new PDO('mysql:host=localhost;dbname=signin', 'root', '');
					$sql = "INSERT INTO sessions (hash,uid,millisCreated) VALUES('$hashedString','$id','$millis')";
					echo $sql;
					$pdo->query($sql);
					session_start();
					$_SESSION['id']=$hashedString;
					$_SESSION['uid']=$id;
					//if the session is created, exit the loop
					$succesfull = TRUE;
					break;
			}
			echo "<br>";
			}
		
		$conn->close();
		return $succesfull;
	}

?>