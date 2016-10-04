<?php	

function sisesta($plate, $color) {
	$database = "if16_eric_2";

		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);

		// mysqli rida
		$stmt = $mysqli->prepare("INSERT INTO cars_and_colors (plate, color) VALUES (?, ?)");
		echo $mysqli->error;
		$stmt->bind_param("ss",$plate, $color);
		
		//täida käsku
		if($stmt->execute()) {
			echo "Salvestamine õnnestus";
			
		} else {
		 	echo "ERROR ".$stmt->error;
		}
		//panen ühenduse kinni
		$stmt->close();
		$mysqli->close();
	}

		function getAllCars() {
			
			$database = "if16_eric_2";
			$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
			
			$stmt = $mysqli->prepare("
				SELECT id, plate, color
				FROM cars_and_colors
			");
			
			$stmt->bind_result($id, $plate, $color);
			$stmt->execute();
			
			// tekitan massiivi
			$result = array();
			
			// tee seda seni, kuni on rida andmeid
			// mis vastab select lausele
			while($stmt->fetch()) {
				
				//tekitan objekti
				$car = new StdClass();
				
				$car->id=$id;
				$car->plate=$plate;
				$car->color=$color;
				
				
				//echo $plate."<br>";
				// iga kord massiivi numbrimärgi
				array_push($result, $car);
			}
			
			
			$stmt->close();
			$mysqli->close();
			
			return $result;
		}
?>