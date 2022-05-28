<?php
session_start();
	echo "<style>
	body 
	{  
		background-image: url('../imagini/background15.jpg');
		background-size: 1700px 2000px;
	} 
	.centrat
	{
		text-align:center;
	}
	.grid-container
	{
		
		display: grid;
		grid-template-columns: auto;
	}
	
	div.grid-item:hover 
	{
		border: 5px solid #0066cc;
	}
	.grid-item 
	{
		margin: auto;
		display:inline-grid;
	background-color:#f5f5dc;
	width: 50%;
	text-align: center;
	box-shadow:inset 0 0 6px 2px #ccc;
	padding:12px;
	box-sizing:border-box;
	margin-bottom:18px;
	}
	.button
		{
			border-radius: 7%;
			box-shadow:0 0 10px #3337;
			background-color:#029;
			color:#fff;
			transition:all 0.6s;
		padding: 10px 15px;
			font-size: 19x;
			box-shadow: 0 9px #999;
			font-family: Arial, Helvetica, sans-serif;
		font-weight: bold;
		}
	#apreciere
	{
		border-radius: 50%;
		background-color: #00BFFF;
		padding: 10px 15px;
			font-size: 19x;
			box-shadow: 0 9px #999;
	}
	.continut{

		width: 600px;
		text-align: center;
		margin: auto;
	}
	p {
		font-family: Arial, Helvetica, sans-serif;
		font-weight: bold;
        font-size: 23px;
	  }
	.textinput{
		width: 100%;
		box-sizing: border-box;
		border: 2px solid #ccc;
		border-radius: 4px;
		font-size:110%;
		background-color: white;
		background-position: 10px 10px; 
		background-repeat: no-repeat;
		padding:3px;
	}
	</style>
	";

	$b = new mysqli('localhost', 'root', '', 'FlyTrip');

	if (mysqli_connect_errno()) {
		exit('Connect failed: '. mysqli_connect_error());
	}
	$com = "SELECT Locatie,count(Numar) FROM `postare` GROUP BY Locatie ORDER BY count(Numar) DESC"; 
	

	$info = $b->query($com);
	echo '<div class="centrat"></br><h1>Comentarii</h1></br></br></div>';
	echo '<div class="grid-container">';
	if ($info->num_rows > 0) {
	while($row = $info->fetch_assoc()){
     
		echo '<div class="grid-item">';
		echo '<p>--Locatie: '.$row['Locatie'].'</p>';
        echo '<p>--Numar de postari: '.$row['count(Numar)'].'</p>';
		echo '</div>';
	}

	echo '</div>';
	echo "<div class='centrat'>";

			echo '<br><a href="../PA.html" ><button class="button">Pagina Principală</button></a>';
			
	echo '</div>';
	echo '</br></br></br></br>';
}
	else {
	echo 'Nu au fost gasite rezultate';
	}	
	
	$b->close();


?>