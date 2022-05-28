<?php
	
	session_start();
		include ('c_functions.php');
	echo adauga_header('Recomandari de la prieteni FlyTrip');
	$CustomPageAtr = array(
	      "page_title" => " Recomandari de la prieteni",
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

    echo '<div class="centrat"></br><h1>Recomandate de prietenii tai</h1></br></br></div>';
	echo '<div class="grid-container">';
    $com1 = "SELECT * FROM `RecomandariPrieteni` where Utilizator1='".$_SESSION['email']."'"; 
	
	
	$info1 = $b->query($com1);
    if ($info1->num_rows > 0) {
        while($row1 = $info1->fetch_assoc()) {

	$com = "SELECT * FROM `postare` where Numar LIKE '".$row1['Postare']."';"; 
	
	$numar=0;
	$info = $b->query($com);
	
	if ($info->num_rows > 0) {
		
	while($row = $info->fetch_assoc()) {
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
		<tr> <td></td>  <td><input type="hidden" name="tip" value="'.'6'.'"/></td></tr>
		<tr> <td><input type="submit" value="Adauga" class="button"></td>  </tr>
		</table>
		</form>';
		echo '<form action="AfisareCom.php" method="post" enctype="multipart/form-data">
		<table>
		<tr> <td></td>  <td><input type="hidden" name="id" value="'.$row['Numar'].'"/></td></tr>
		<tr> <td></td>  <td><input type="hidden" name="tip1" value="'.'6'.'"/></td></tr>
		<tr> <td><input type="submit" value="Comentarii" class="button"></td>  </tr>
		</table>
		</form>';
		echo '<form action="Apreciere.php" method="post" enctype="multipart/form-data">
		<table>
		<tr> <td></td>  <td><input type="hidden" name="ida" value="'.$row['Numar'].'"/></td></tr>
		<tr> <td></td>  <td><input type="hidden" name="tip2" value="'.'6'.'"/></td></tr>
		<tr> <td><input type="submit" value="Apreciaza" id="apreciere" class="button"></td>  </tr>
		</table>
		</form>';
		echo '<form action="Poze.php" method="post" enctype="multipart/form-data">
		<table>
		<tr> <td></td>  <td><input type="hidden" name="poze" value="'.$row['Numar'].'"/></td></tr>
		<tr> <td></td>  <td><input type="hidden" name="tip3" value="'.'6'.'"/></td></tr>
		<tr> <td><input type="submit" value="Pozele" id="pozele" class="button"></td>  </tr>
		</table>
		</form>';
		
		
		$com = "SELECT count(Postare) FROM `apreciere` where Postare=".$row['Numar']."";

		$numar = $b->query($com);
		$rand=$numar->fetch_assoc();
		

		$interogare= "SELECT * from `apreciere` where Postare='".$row['Numar']."' and Persoana='".$_SESSION['email']."'";
		$aprec= $b->query($interogare);
		if($aprec->num_rows>0)
			echo '<p>Apreciata</p></br>';
		echo '<p>Aprecieri:'.$rand['count(Postare)'].'</p>';

		echo '</div>';
	}

	
	}
	else {
	echo 'Nu au fost gasite rezultate';
	}	
}
    }
    echo '</div>';
	echo "<div class='centrat1'>";
	echo '<a href="../PaginaP.html"><button class="button">Pagina Principală</button></a>';
	echo '</div>';
	$b->close();echo '</div></div>'.add_footer('b'); 

//SELECT count(Persoana),NUmar FROM `postare`,`apreciere` WHERE Postare=Numar GROUP BY Numar ORDER BY count(Persoana) DESC
?>