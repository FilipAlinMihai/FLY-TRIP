<?php
session_start();include ('c_functions.php');
	echo adauga_header('Comentarii FlyTrip');
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
	$com = "SELECT * FROM `comentarii`"; 
	

	$info = $b->query($com);
	echo '<div class="centrat"></br><h1>Comentarii</h1></br></br></div>';
	echo '<div class="grid-container">';
	if ($info->num_rows > 0) {
	while($row = $info->fetch_assoc()){
     if($_SESSION['Comentariu']==$row['IDPostare']){
		echo '<div class="grid-item">';
		echo '<p style="font-size:18"> --Comentariu : '. $row['Comentariu']."</p>";
		echo '<p style="font-size:18"> --Utilizator : '. $row['Utilizator']."</p>";
		echo '<p style="font-size:18"> --ID : '. $row['ID']."</p>";
		if($row['Utilizator']==$_SESSION['email'])
		{
		echo '<form action="StergeCom.php" method="post" enctype="multipart/form-data">
		<table>
		<tr> <td></td>  <td><input type="hidden" name="id" value="'.$row['ID'].'"/></td></tr>
		<tr> <td></td>  <td><input type="hidden" name="idp" value="'.$row['IDPostare'].'"/></td></tr>
		<tr> <td><input type="submit" value="Sterge" class="button"></td>  </tr>
		</table>
		</form>';

		}
     }
		echo '</div>';
	}

	echo '</div>';
	echo "<div class='centrat'>";
	if($_SESSION['tip']=='1')
			echo '<br><a href="AfisarePostari.php#'.$_SESSION['Comentariu'].'" ><button class="button">Pagina Principală</button></a>';
			else if($_SESSION['tip']=='2')
				echo '<br><a href="PostariApreciate.php#'.$_SESSION['Comentariu'].'" ><button class="button">Pagina Principală</button></a>';
				else if ($_SESSION['tip']=='3') 
					echo '<br><a href="PostariComentate.php#'.$_SESSION['Comentariu'].'" ><button class="button">Pagina Principală</button></a>';
					else if($_SESSION['tip']=='4')
						echo '<br><a href="PostariPropri.php#'.$_SESSION['Comentariu'].'" ><button class="button">Pagina Principală</button></a>';
						else if($_SESSION['tip']=='5')
						echo '<br><a href="cautareLocatie1.php#'.$_SESSION['Comentariu'].'" ><button class="button">Pagina Principală</button></a>';
						else if($_SESSION['tip']=='6')
						echo '<br><a href="AfisareRecP.php#'.$_SESSION['Comentariu'].'" ><button class="button">Pagina Principală</button></a>';

	echo '</div>';
	echo '</br></br></br></br>';
}
	else {
	echo 'Nu au fost gasite rezultate';
	}	
	
	$b->close();echo '</div></div>'.add_footer('b');


?>