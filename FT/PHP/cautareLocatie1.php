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
	$com = "SELECT * FROM `postare`"; 
	
	$info = $b->query($com);
	$a=0;
	if ($info->num_rows > 0) {
	
	echo '<div class="centrat"></br><h2>Rezultatele Căutării</h2></br></br></div>';
	echo '<div class="grid-container">';
	while($row = $info->fetch_assoc()) {
		if( str_contains(strtoupper($row['Locatie']), strtoupper($_SESSION['Locatie'])))
		{
			$a=1;
	
			echo '<div class="grid-item">';
		echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['Imagine1'] ).'" width="350" height="200" id="imagine" name="imgs"/>';
		echo '<p style="font-size:18" id='.$row['Numar'].'> Obiectiv: '. $row['Locatie']."</p>";
		echo '<p style="font-size:18"> -- Email : '. $row['Email']."</p>";
		echo '<p style="font-size:18"> -- Tip: '. $row['Tip']."</p>";
		echo '<div class="continut">';
		echo '<p style="font-size:18"> -- Descriere: '.$row['Descriere']."</p>";
		echo '</div>';
		echo '<p style="font-size:18"> --ID: '.$row['Numar']."</p>";
		echo '<p style="font-size:18"> --Lasa un comentariu</p> </br> 
		<form action="Com.php" method="post" enctype="multipart/form-data">
		<table>
		<tr> <td><p>Comentariu</p></td>  <td><input type="text" name="coment" class="textinput" value=""/></td></tr>
		<tr> <td></td>  <td><input type="hidden" name="id" value="'.$row['Numar'].'"/></td></tr>
		<tr> <td></td>  <td><input type="hidden" name="tip" value="'.'5'.'"/></td></tr>
		<tr> <td><input type="submit" value="Adauga" class="button"></td>  </tr>
		</table>
		</form>';
		echo '<form action="AfisareCom.php" method="post" enctype="multipart/form-data">
		<table>
		<tr> <td></td>  <td><input type="hidden" name="id" value="'.$row['Numar'].'"/></td></tr>
		<tr> <td></td>  <td><input type="hidden" name="tip1" value="'.'5'.'"/></td></tr>
		<tr> <td><input type="submit" value="Comentarii" class="button"></td>  </tr>
		</table>
		</form>';
			echo '</div>';
			
		}
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
	$b->close();echo '</div>'.add_footer('b'); 
?>