<?php
session_start();include ('c_functions.php');
    $descriere=$_POST["descriere"];
	$locatie=$_POST["locatie"];
	$imagine=addslashes (file_get_contents($_FILES['imagine']['tmp_name']));
	$imagine2=addslashes (file_get_contents($_FILES['imagine2']['tmp_name']));
    $imagine3=addslashes (file_get_contents($_FILES['imagine3']['tmp_name']));
	$b=mysqli_connect( $db_server, $db_user, $db_pass, $db_name);
	
	echo adauga_header('Recomandari Locatii FlyTrip');
	$CustomPageAtr = array(
	      "page_title" => " Se recomanda locatia '".$locatie."'",
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
    if (mysqli_connect_errno()) {
		exit('Connect failed: '. mysqli_connect_error());
	}
	$com="SELECT * FROM `recomandari`";
		$info=$b->query($com);


    $codul=1;
	$verif=1;
	 while($codul<1000 && $verif==1)
	{
		$comanda="select * from `recomandari`";
		$info1=$b->query($comanda);
		$verif=0;
		while($row1=$info1->fetch_assoc())
		{
			if($row1['Numar']==$codul)
			$verif=1;	
		}
		if($verif==0 )
			break;
		$codul=$codul+1;
	}
	date_default_timezone_set("Europe/Bucharest");
	$d=date("Y/m/d ").date("h:i");
    $postare="Insert into `Recomandari` values ('".$locatie."','".$_SESSION['Admin']."','".$descriere."',".$codul.",'".$imagine."','".$imagine2."','".$imagine3."','".$d."')";
		if(mysqli_query($b,$postare))
			echo "Recomandare a fost adăugată";
		else
			echo "Procesul eşuat". mysqli_errno($b). " : ". mysqli_error($b);
    
    
$b->close();echo '</div>'.add_footer('b');
?>
