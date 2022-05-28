<?php
	
	session_start();
		include ('c_functions.php');
	echo adauga_header('Gestionare comentarii FlyTrip');
	$CustomPageAtr = array(
		"page_title" => " Gestionare comentarii A",
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
	$com = "SELECT * FROM `Recomandari` ORDER BY Data DESC;"; 
	
	$numar=0;
	$info = $b->query($com);
	echo '<div class="centrat"></br><h1>Recomandari Oficiale</h1></br></br></div>';
	echo '<div class="grid-container">';
	if ($info->num_rows > 0) {
		
	while($row = $info->fetch_assoc()) {
		echo '<div class="grid-item">';
		echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['Imagine1'] ).'" width="350" height="200" id="imagine" name="imgs"/>';
		echo '<p style="font-size:18" id='.$row['Numar'].'> Obiectiv: '. $row['Locatie']."</p>";
		echo '<p style="font-size:18"> -- Scrisa de  : '. $row['Administrator']."</p>";
		echo '<div class="continut">';
		echo '<p style="font-size:18"> -- Descriere: '.$row['Descriere']."</p>";
		echo '</div>';
		echo '<p style="font-size:18"> --ID: '.$row['Numar']."</p>";
		
		

		echo '</div>';
	}

	echo '</div>';
	echo "<div class='centrat1'>";
	echo '<br><a href="../PaginaP.html"><button class="button">Pagina Principală</button></a>';
	echo '</div>';
	}
	else {
	echo 'Nu au fost gasite rezultate';
	}	
	
	$b->close();echo '</div></div>'.add_footer('b'); 


?>