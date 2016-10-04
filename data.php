<?php 
	
	require("functions.php");
	
	//kui ei ole kasutaja id'd
	if (!isset($_SESSION["userId"])){
		
		//suunan sisselogimise lehele
		header("Location: login.php");
		
	}
	
	//kui on ?logout aadressireal siis login välja
	if (isset($_GET["logout"])) {
		
		session_destroy();
		header("Location: login.php");
		
	}
	


	
	
?>
<h1>Register plate number and car color</h1>

<p>
	Tere tulemast <?=$_SESSION["userEmail"];?>!
	<a href="?logout=1">Logi välja</a>
</p>

</form method="POST">

<label>Insert plate number</label>
<br>
<input name="plate" placeholder="plate number" type="text">
<br><br>
<label>Choose car color</label>
<input name="color" placeholder="car color" type="color">
<br><br>
<input type="submit" value="salvesta">

</form>


