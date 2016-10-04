<?php
require("../../config.php");
require("auto_function.php");

$color = "";
$plate = "";



if ( isset($_POST["plate"]) && 
	isset($_POST["color"]) &&
	!empty($_POST["plate"]) && 
	!empty($_POST["color"])
){
	sisesta(($_POST["plate"]), ($_POST["color"]));
}
	$carData = getAllCars();
	echo "<pre>";
	var_dump($carData);
	echo "</pre>";
?>	
	
<!DOCTYPE html>
<html>
<body>

	<h1>Sisesta</h1>
	<form method="POST"> <br>
	
		<input name="plate" placeholder="Numbrimärk" type="text" ><br><br>
		<input name="color" placeholder="Värv" type="color"> <br><br>

		<input type="submit" value="Sisesta">
	
	</form>

	<h2>Autod</h2>
	<?php
	
	$html =  "<table>";
	
	$html .= "<tr>";
		$html .= "<th>id</th>";
		$html .= "<th>plate</th>";
		$html .= "<th>color</th>";
	$html .= "</tr>";
	
	//iga liikme kohta massiivis
	foreach($carData as $c){
		
		$html .= "<tr>";
		$html .= "<td>".$c->id."</td>";
		$html .= "<td>".$c->plate."</td>";
		$html .= "<td style='background-color:".$c->color."'>".$c->color."</td>";
	$html .= "</tr>";
		//iga auto on $c
		//echo $c->plate. "<br>";
		
	}
	
	$html .= "</table>";
	echo $html;
	
	$listHtml = "<br><br>";
	
	foreach($carData as $c) {
		
		$listHtml .="<h1 STYLE ='color:".$c->color."'>".$c->plate."</h>";
		
	
	}
	
	echo $listHtml;
	
	
	?>
	
	
	
</body>
</html>
