<?php
    session_start();include ('c_functions.php');
	echo adauga_header('Recomandari Locatii FlyTrip');
	$CustomPageAtr = array(
	      "page_title" => " Recomandare Prieten",
		  "site_title" => "Fly Trip",
		  "page_description" => "Adauga",
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
	
	$p1=$_POST["prieten"];
    $postare=$_POST['postare'];
    if (mysqli_connect_errno()) {
		exit('Connect failed: '. mysqli_connect_error());
	}
	
    $com="SELECT * FROM `RecomandariPrieteni`";
	$bc=0;
	$info=$b->query($com);
	if($info->num_rows > 0)
	{
		$a=0;
		$bc=0;
		while($row=$info->fetch_assoc())
		{
			if($row['Utilizator2']==$_SESSION['email'] && $row['Utilizator1']==$p1 && $row['Postare']==$postare)
				$a=1;
		}
		if($a==1)
			echo 'Exista deja o recomandare trimisa';
	}
		if($a==0)
		{
        $a="INSERT INTO RecomandariPrieteni VALUES ('".$p1."','".$_SESSION['email']."','".$postare."')";
        
        if(mysqli_query($b,$a)){
            header("Location: AfisarePostari.php#".$postare."");
        }
        else
          echo "Proces esuat". mysqli_errno($b). " : ". mysqli_error($b);
	}
$b->close();echo '</div>'.add_footer('b');
?>