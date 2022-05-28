<?php
   session_start();include ('c_functions.php');
	$p1=$_POST["persoana1"];
	echo adauga_header('Accepta Prieteni FlyTrip');
	$CustomPageAtr = array(
	      "page_title" => "Accept prieteni",
		  "site_title" => "Fly Trip",
		  "page_description" => "Afisare mesaje",
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
	
	$b=mysqli_connect( $db_server, $db_user, $db_pass, $db_name);
    if (mysqli_connect_errno()) {
		exit('Connect failed: '. mysqli_connect_error());
	}
	
		$a="DELETE FROM Cereri WHERE destinatar='".$_SESSION['email']."' AND utilizator='".$p1."'";
        
		if(mysqli_query($b,$a)){
			echo "Datele au fost sterse din cereri</br>";
        }
		else
			echo "Proces esuat". mysqli_errno($b). " : ". mysqli_error($b);
		
        $a="INSERT INTO Prieteni VALUES ('".$p1."','".$_SESSION['email']."')";
        
        if(mysqli_query($b,$a)){
             echo "Datele au fost adaugate in prieteni";
        }
        else
          echo "Proces esuat". mysqli_errno($b). " : ". mysqli_error($b);
$b->close();echo '</div>'.add_footer('b');
?>