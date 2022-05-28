<?php
	session_start();
	include ('c_functions.php');
	echo adauga_header('Erori autentificare FlyTrip');
	$cPAtr = array(
	      "page_title" => "Eroare ",
		  "site_title" => "Fly Trip",
		  "page_description" => "la autentificare",
		  "legaturi" => array (
			array ( 
					"nume" => "Prima Pagina",
					"link_url" => "../pornire.html"
					),
			array ( 
					"nume" => "Autentificare",
					"link_url" => "../login.html"
					),
			array ( 
					"nume" => "Admin",
					"link_url" => "../loginA.html"
					)
				)
		  ); 
    echo adauga_meniu($cPAtr).'<div class="center"><p class="error">';
	//$_SESSION['numeutilizator']=$_POST["numeutilizator"];
	$_SESSION['parola']=$_POST["parola"];
	$_SESSION['email']=$_POST["email"];
	$b= new mysqli( $db_server, $db_user, $db_pass, $db_name);
    if (mysqli_connect_errno()) {
		exit('Connect failed: '. mysqli_connect_error());
	}
	$com="SELECT * FROM `utilizatori`";

	$info=$b->query($com);
	if($info->num_rows > 0)
	{
		$a=0;
		while($row=$info->fetch_assoc())
		{
			if($row['Email']==$_SESSION['email'] && $row['Parola']==$_SESSION['parola'])
				$a=1;
		}
		if($a==1)
		{
			header("Location: ../PaginaP.html");
		}
		else
		{
			echo "Utilizatorul nu a fost găsit";
		}
	}
	else
	{
		echo "Utilizatorul nu a fost găsit";
	}
	$b->close();
	echo '</p></div>'.add_footer();
?>