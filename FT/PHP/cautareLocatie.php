<?php
session_start();
	include ('c_functions.php');
	echo adauga_header('Gaseste Locatii FlyTrip');
	$nume=$_POST["numeL"];
	$_SESSION['Locatie']=$nume;
	$CustomPageAtr = array(
	      "page_title" => " Se caută locatia '".$nume."'",
		  "site_title" => "Fly Trip",
		  "page_description" => "Postare ID",//.$id,
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
	$nume = strtolower($nume);
	$com = "SELECT * FROM `postare` WHERE LOWER(`Locatie`) LIKE '%".$nume."%'"; 
	
	$info = $b->query($com);
	
	echo arata_postari($info);
	$b->close();
	echo '</div></div>'.add_footer('b');
?>