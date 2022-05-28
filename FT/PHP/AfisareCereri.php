<?php
     session_start();include ('c_functions.php');
	echo adauga_header('Recomandari Locatii FlyTrip');
	$CustomPageAtr = array(
	      "page_title" => " Cereri Primite",
		  "site_title" => "Fly Trip",
		  "page_description" => "Arata",
		  "legaturi" => array (
			array ( 
					"nume" => "Vezi Postari",
					"link_url" => "AfisarePostari.php#"
					),
			array ( 
					"nume" => "Pagina Profilului",
					"link_url" => "../PaginaP.html"
					)
				)
		  );
	echo adauga_meniu($CustomPageAtr).'<div class="center">';
	$b = new mysqli( $db_server, $db_user, $db_pass, $db_name);

	if (mysqli_connect_errno()) {
		exit('Connect failed: '. mysqli_connect_error());
	}
	$com = "SELECT * FROM `cereri`"; 
	

	$info = $b->query($com);
	echo '<div class="main">';
	if ($info->num_rows > 0) {
	while($row = $info->fetch_assoc()){
     if($_SESSION['email']==$row['Destinatar']){
		echo '<div class="grid-item">';
		echo '<p style="font-size:18"> Cerere de la : '. $row['Utilizator']."</p>";
		echo '<form action="AcceptaPrieten.php" method="post" enctype="multipart/form-data">
		<table>
		<tr> <td></td>  <td><input type="hidden" name="persoana1" value="'.$row['Utilizator'].'"/></td></tr>
		<tr> <td><input type="submit" value="Acceptare" class="button"></td>  </tr>
		</table>
		</form>';
     }
		echo '</div>';
	}

	
	echo "<div class='centrat'>";
	echo '<br><a href="../PaginaP.html"><button class="button">Pagina Principală</button></a>';
	echo '</div>';

}
	else {
	echo 'Nu au fost gasite rezultate';
	}	
	
	$b->close();echo '</div></div>'.add_footer('b');


?>