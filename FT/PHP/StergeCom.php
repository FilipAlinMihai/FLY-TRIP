<?php
    session_start();
	include ('c_functions.php');
    $id=$_POST["id"];
	$b = new mysqli($db_server, $db_user, $db_pass, $db_name);
	
	echo adauga_header("Se sterge comentariul");
	$CustomPageAtr = array(
	      "page_title" => "Stergere comentariu",
		  "site_title" => "Fly Trip",
		  "page_description" => "Afisaza erori",
		  "legaturi" => array (
			array ( 
					"nume" => "Prima Pagină",
					"link_url" => "../pornire.html"
					),
			array ( 
					"nume" => "Pagina Profilului",
					"link_url" => "../PaginaP.html"
					)
				)
		  );
	echo adauga_meniu($CustomPageAtr).'<div class="center"><section class="error">';

	if (mysqli_connect_errno()) {
		echo '<p>Connect failed: '. mysqli_connect_error().'</p>';
	}
	$com = "DELETE FROM `Comentarii` WHERE ID LIKE ".$id; 
	

	if(mysqli_query($b,$com)){
                     $_SESSION['Comentariu']=$idp;
					 $_SESSION['tip']=$tip;
					 
					 	header("Location: AfisarePostari.php");
                    }
				 else
					 echo "<p>Datele nu au putut fi sterse ". mysqli_errno($b). " : ". mysqli_error($b)."</p>";
	
	$b->close();
echo '</section></div>'.add_footer();

?>