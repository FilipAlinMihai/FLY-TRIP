<?php
	$nume=$_POST["numeP"];
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
	$com = "SELECT * FROM `utilizatori` WHERE `Email` LIKE '%".$nume."%' OR `Nume` LIKE '%".$nume."%'"; 
	
	$info = $b->query($com);
	$a=0;
	if ($info->num_rows > 0) {
	
	echo '<div class="centrat"></br><h2>Rezultatele Căutării</h2></br></br>';
	while($row = $info->fetch_assoc()) {
		
			$a=1;
	
			echo '<div class="grid-item">';
			echo '<p style="font-size:18">Email: '. $row['Email']."</p>";
			echo '<p style="font-size:18">Nume: '. $row['Nume']."</p>";
            echo '<p style="font-size:18">Trimite cerere de prietenie 
		    <form action="TrimiteCereri.php" method="post" enctype="multipart/form-data">
		    <table>
		    <tr> <td></td>  <td><input type="hidden" name="destinatar" value="'.$row['Email'].'"/></td></tr>
		    <tr> <td><input type="submit" value="Trimite" class="button"></td>  </tr>
		    </table>
		    </form></p>';
			echo '</div>';
			
		
	}
	if($a==0)
		echo 'Nu au fost găsite rezultate';
	}
	else 
	{
		echo 'Nu au fost găsite rezultate';
	}	
	
	echo '<br><a href="../PaginaP.html"><button class="button">Pagina Principală</button></a>';
	echo '</div>';
	$b->close();echo '</div></div>'.add_footer('b'); 
?>