<?php
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
	session_start();
	if (mysqli_connect_errno()) {
		exit('Connect failed: '. mysqli_connect_error());
	}
	$com = "SELECT * FROM `Prieteni` where Persoana2='".$_SESSION['email']."' OR Persoana1='".$_SESSION['email']."'"; 
	

	$info = $b->query($com);
	echo '<div class="centrat"></br><h1>Prieteni</h1></br></br></div>';
	echo '<div class="grid-container">';
	if ($info->num_rows > 0) {
	while($row = $info->fetch_assoc()){
		if( $row['Persoana1']==$_SESSION['email']){
		echo '<div class="grid-item">';
		echo '<p style="font-size:18"> Sunteti prieten cu :</p>';
		echo '<p style="font-size:18"> -- Utilizatorul : '. $row['Persoana2']."</p>";
		echo '</div>';
		}
		else{
		echo '<div class="grid-item">';
		echo '<p style="font-size:18"> Sunteti prieten cu :</p>';
		echo '<p style="font-size:18"> -- Utilizatorul : '. $row['Persoana1']."</p>";
		echo '</div>';
		}
	}

	echo '</div>';
	echo "<div class='centrat'>";
	echo '<br><a href="../Paginap.html"><button class="button">Pagina Principală</button></a>';
	echo '</div>';
	echo '</br></br></br></br>';
}
	else {
	echo 'Nu au fost gasite rezultate';
	}	
	
	$b->close();echo '</div></div>'.add_footer('b'); 


?>