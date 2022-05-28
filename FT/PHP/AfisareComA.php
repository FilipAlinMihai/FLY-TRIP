<?php
$id=$_POST["id"];
session_start();include ('c_functions.php');
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
	$com = "SELECT * FROM `Comentarii` WHERE `IDPostare` LIKE '".$id."' "; 
	

	$info = $b->query($com);
	echo '<div class="main">';
	if ($info->num_rows > 0) {
	while($row = $info->fetch_assoc()){
     if($id==$row['IDPostare']){
		echo '<div class="grid-item">';
		echo '<p style="font-size:18">Comentariu : '. $row['Comentariu']."</p>";
		echo '<p style="font-size:18">Utilizator : '. $row['Utilizator']."</p>";
		echo '<p style="font-size:18">ID : '. $row['ID']."</p>";
		if($row['Utilizator']==$_SESSION['email'])
		{
		echo '<form action="StergeCom.php" method="post" enctype="multipart/form-data">
		<input type="hidden" name="id" value="'.$row['ID'].'"/><input type="submit" value="Sterge" class="button">
		</form>';

		}
     }
		echo '</div>';
	}
}
	else {
	echo 'Nu au fost gasite rezultate';
	}	
	
	$b->close();echo '</div></div>'.add_footer('b');


?>