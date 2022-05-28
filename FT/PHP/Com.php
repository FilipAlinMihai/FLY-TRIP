<?php
	session_start();
	include ('c_functions.php');
	print_r($_POST);
    $coment=$_POST["coment"];
	$id=$_POST["id"];
	$tip=$_POST["tip"];
	echo adauga_header("Se adauga comentarii la Postarea cu ID:".$id);
	$CustomPageAtr = array(
	      "page_title" => " Eroare Comentarii",
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
	$b = new mysqli( $db_server, $db_user, $db_pass, $db_name);
    if (mysqli_connect_errno()) {
		exit('Connect failed: '. mysqli_connect_error());
	}
	
	
    if(strlen($coment)>0)
	{
		$codul=1;
	$verif=1;
	while($codul<1000 && $verif==1)
	{
		$comanda="select * from `comentarii`";
		$info1=$b->query($comanda);
		$verif=0;
		while($row1=$info1->fetch_assoc())
		{
			if($row1['ID']==$codul)
			$verif=1;	
		}
		if($verif==0 )
			break;
		$codul=$codul+1;
	}
    	$adauga="Insert into `Comentarii` values ('".$codul."','".$coment."','".$id."','".$_SESSION['email']."')";
		//echo $adauga;
	if(mysqli_query($b,$adauga)){
		if($tip=='1')
			header("Location: AfisarePostari.php#".$id."");
			else if($tip=='2')
				header("Location: PostariApreciate.php#".$id."");
				else if ($tip=='3') 
					header("Location: PostariComentate.php#".$id."");
					else if($tip=='4')
						header("Location: PostariPropri.php#".$id."");
						else if($tip=='5')
						header("Location: cautarelocatie1.php#".$id."");
						else if($tip=='6')
						header("Location: AfisareRecP.php#".$id."");
	}
	 	else
			echo  'Esuare la introducere';
}
else
			echo  'Comentariul nu trebuie sa fie gol';
    
    
$b->close();
echo '</section></div>'.add_footer('cautare');
?>