<?php
	
	session_start();
	include('c_functions.php');
	$html = adauga_header("Afișare Postări FlyTrip");
	$b= new mysqli($db_server, $db_user, $db_pass, $db_name);

	if (mysqli_connect_errno()) {
		exit('Connect failed: '. mysqli_connect_error());
	}
	$com = "SELECT * FROM `postare` ORDER BY Data DESC"; 
	
	$numar=0;
	$info = $b->query($com);
	$CustomPageAtr = array(
	      "page_title" => "Postari Noi",
		  "site_title" => "Fly Travel",
		  "page_description" => " » ",
		  "legaturi" => array (
			array ( 
					"nume" => "Pagina Principală",
					"link_url" => "../PaginaP.html"
					),
			array ( 
					"nume" => "Adaugă Postare",
					"link_url" => "../AdaugaPostare.html"
					)//,
			// array ( 
			// 		"nume" => "Adauga Recomandare",
			// 		"link_url" => "../AdaugaRecomandare.html"
			// 		)
		 	)
		  );
		  
	$html .= adauga_meniu($CustomPageAtr); 
	$html .='<div class="center">';
	$html .= arata_postari($info);
	echo $html;
	$b->close();
echo '</div></div>'.add_footer('c');
//SELECT count(Persoana),NUmar FROM `postare`,`apreciere` WHERE Postare=Numar GROUP BY Numar ORDER BY count(Persoana) DESC
?>