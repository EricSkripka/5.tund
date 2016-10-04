<?php
	
	// see fail peab olema kõigil lehtedel, kus tahan kasutada SESSION muutujat
	session_start();

	function signUp ($email, $password) {
		
		
		$database = "if16_eric_2";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
		
		
		if ($mysqli->connect_error) {
			die('Connect Error: ' . $mysqli->connect_error);
		}
		
		
		$stmt = $mysqli->prepare("INSERT INTO user_sample (email, password) VALUES (?, ?)");
		
		echo $mysqli->error;
		

		$stmt->bind_param("ss", $email, $password);
		

		if($stmt->execute()) {
			
			echo "salvestamine õnnestus";
			
		} else {
		 	echo "ERROR ".$stmt->error;
		}
		
		$stmt->close();
		$mysqli->close();
	
	}



	function login ($email, $password) {
		
		$error = "";
		
		$database = "if16_eric_2";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
		
		$stmt = $mysqli->prepare("SELECT id, email, password, created FROM user_sample WHERE email = ?");
		echo $mysqli->error;
		
		//asendan küsimärgi
		$stmt->bind_param("s", $email);
		
		//määran väärtused muutujatesse
		$stmt->bind_result($id, $emailFromDb, $passwordFromDb, $created);
		$stmt->execute();
		
		//andmed tulid andmebaasist või mitte
		//on tõene kui on vähemalt üks vaste
		if($stmt->fetch()) {
			
			//oli sellise meiliga kasutaja
			//password, millega kasutaja tahab sisse logida
			$hash = hash("sha512", $password);
			if($hash == $passwordFromDb) {
				echo "Kasutaja logis sisse".$id;
				
				//määran sessiooni muutujad, millele saan ligi teiselt lehelt
				$_SESSION["userId"] = $id;
				$_SESSION["userEmail"] = $emailFromDb;
				
				$_SESSION["message"] = "<h1>Tere tulemast!</h1>";
				
				header("Location: data.php");
			
			
			}else {
				$error="Vale parool";
			}
		
		
		
		
		} else {
			
			//ei leidnud kasutajat sellise meiliga
			$error="ei ole sellist emaili";
		}
		
		
		return $error;
	}
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 	/*function hello($x, $y) {
		
		return $x + $y;
		
		
		
	}
	
	function hello($firstname, $lastname) {
		
		return "Tere tulemast, ".$firstname." ".$lastname. "!"; 
		
		
	}
	
	echo sum(43346,34634);
	echo "<br>";
	echo hello("Eric", "Skripka");
	*/


?>



	