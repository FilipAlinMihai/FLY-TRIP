<?php
session_start();
	include ('c_functions.php');
	$id=$_POST["id"];
	$tip=$_POST["tip1"];
	$b = new mysqli( $db_server, $db_user, $db_pass, $db_name);

	echo adauga_header("Se afiseaza comentarii la Postarea cu ID:".$id);
	$CustomPageAtr = array(
	      "page_title" => "Comentarii",
		  "site_title" => "Fly Trip",
		  "page_description" => "Postare ID".$id,
		  "legaturi" => array (
			array ( 
					"nume" => "Vezi Postarea",
					"link_url" => "AfisarePostari.php#".$id
					),
			array ( 
					"nume" => "Pagina Profilului",
					"link_url" => "../PaginaP.html"
					)
				)
		  );
	echo adauga_meniu($CustomPageAtr).'<div class="center"><section class="error">';
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

	echo '</div>';
	echo "<div class='centrat'>";

	if($tip=='1')
			echo '<a href="AfisarePostari.php#'.$id.'" ><button class="button">Arata Postarea</button></a>';
			else if($tip=='2')
				echo '<a href="PostariApreciate.php#'.$id.'" ><button class="button">Arata Postarea</button></a>';
				else if ($tip=='3') 
					echo '<a href="PostariComentate.php#'.$id.'" ><button class="button">Arata Postarea</button></a>';
					else if($tip=='4')
						echo '<a href="PostariPropri.php#'.$id.'" ><button class="button">Arata Postarea</button></a>';
						else if($tip=='5')
						echo '<a href="cautareLocatie1.php#'.$id.'" ><button class="button">Arata Postarea</button></a>';
						else if($tip=='6')
						echo '<a href="AfisareRecP.php#'.$id.'" ><button class="button">Arata Postarea</button></a>';
	echo '</div>';
}
	else {
	echo '<p>Nu au fost gasite rezultate</p>';
	}	
	
	$b->close();

echo '</section></div>'.add_footer("c");

?>