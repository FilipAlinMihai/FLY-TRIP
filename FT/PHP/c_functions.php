<?php
error_reporting(E_ALL);
$db_pass = '';
$db_server = 'localhost';
$db_name = 'FlyTrip';
$db_user = 'root';
function adauga_header($t1) {
	$txt = '<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
 <link rel="stylesheet" href="../CSS/front-style.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>'.$t1.'</title>
</head>';	
return $txt;
}
/* $CustomPageAtr = array(
	      page_title => "",
		  site_title => "",
		  page_description => "",
		  legaturi => array (
			array ( 
					nume => "",
					link_url => ""
					),
			array ( 
					nume => "",
					link_url => ""
					),
			array ( 
					nume => "",
					link_url => ""
					)
				)
		  ); */
function adauga_meniu($cPAtr) {
	//print_r($cPAtr);
	$txt ='<body>
<div class="site_header">
	<section class="header_content">
    <div id="titlu">
        <h1 class="page_title slide_f_left">'.$cPAtr["page_title"].'</h1>    
        <h2 class="site_title slide_2_left">'.$cPAtr["page_description"].'</h2>
		<h3 class="page_description slide_3_left">'.$cPAtr["site_title"].'</h3>
	</div>
    <ul class="meniu" id="main_menu">';
	foreach($cPAtr["legaturi"] as $key=>$link ) {
		    
			$txt .= '<li><a href="'.$link['link_url'].'">'.$link['nume'].'</a></li>';
	}
    $txt .= '</ul>
	</section>
</div>';
return $txt;
}
function add_form_com($id) {
	$txt ='<form action="Com.php" method="post" enctype="multipart/form-data">
	<fieldset><legend>Adaugă comentariu</legend>
	<p><label for="coment">Comentariu<input type="text" name="coment" class="textinput" value=""/></label>
	<input type="hidden" name="id" value="'.$id.'"/>
	<input type="hidden" name="tip" value="1"/>
	<input type="submit" value="Adauga" class="button"></p>
	</fieldset>
		</form>';
	return $txt;
}
function add_form_af_com($id) {
	$txt ='<form action="AfisareCom.php" method="post" enctype="multipart/form-data">
	<input type="hidden" name="id" value="'.$id.'"/>
	<input type="hidden" name="tip1" value="'.'1'.'"/>
	<input type="submit" value="Arată comentarii" class="button"></p>
		</form>';
	return $txt;
}

function add_footer($tip = "info") {
	$txt = '<div class="footer"><div class="fbox half" id="date">';
if ($tip == "info"): $txt .= '<h2>Despre noi</h2>
<ul>
<li>Aici puteti cunoaste experientele traite de altii</li>
<li>Va ajutam sa gasiti destinatia perfecta pentru urmatorrea vacanta </li>
<li>Pentru noi parerea utilizatorului e cea mai importanta </li>
</ul>';
else:
$txt .= '<form action="cautarePrieteni.php" method="post">
<h2>Caută prieteni</h2><input type="text" name="numeP" value=""   placeholder="Introduceți un nume" />
     <input type="submit" value="Căutare" class="button">
    </form>';
	endif;
$txt .= '</div>
<div class="fbox half" id="date1">';
if ($tip == "info"): $txt .= '
<h2>Date de contact</h2>
<p><strong>E-mail:</strong> fly.trip@gmail.com<br/>
<strong>Număr de telefon:</strong> 0734457383<br/>
<strong>Adresa:</strong> Timisoara, Strada Unirii Nr 27</p>';
else:
$txt .= '<form action="cautareLocatie.php" method="post">
	<h2>Caută un obiectiv</h2>
		<input type="text" name="numeL" value="" placeholder="Introduceți un nume de obiectiv"/>
		<input type="submit" value="Căutare" class="button"></td>
    </form>';
	endif;
$txt .= '</div>
</div><!-- end footer -->
<a id="mergisus" class="button" href="#main_menu">&#8593;</a>
</body>
</html>';
return $txt;
}
function arata_postari($info) {
	$html = "";
		if ($info->num_rows > 0) {
			$html .= "<h3>Sunt :".$info->num_rows. "postari</h3><div class='main'>";
	 while ($row =  mysqli_fetch_assoc($info)){
//print_r($row);	
		$html .= '<div class="grid-item" id="'.$row['Numar'].'">';
		
		$html .=  '<h2 class="post-title">'. $row['Locatie']."</h2>";
		if (isset($row['Imagine1'])):
					if (strlen($row['Imagine1'])>1):
					$html .=  '<img src="data:image/jpeg;base64,'.base64_encode( $row['Imagine1'] ).'" width="350" height="200" class="imagine" name="imgs"/>';
					endif;
		endif;
					$html .= '<p class="post_content">'.$row['Descriere'].'</p>';
		$html .= '<p class="post_meta"><span class="p_mail">email: '. $row['Email'].'</span>&nbsp;
		<span class="p_tip">Tip: '. $row['Tip'].'</span>&nbsp;
		<span class="p_id">ID: '.$row['Numar'].'</span></p>';
		$html .= add_form_com($row['Numar']);
		$html .= add_form_af_com($row['Numar']);
		
		
		$html .= '<form action="Apreciere.php" method="post" enctype="multipart/form-data">
		<input type="hidden" name="ida" value="'.$row['Numar'].'"/>
		<input type="hidden" name="tip2" value="'.'1'.'"/>
		<input type="submit" value="Apreciaza" id="apreciere" class="button">
		</form>';
		$html .= '<form action="Poze.php" method="post" enctype="multipart/form-data">
		<table>
		<tr> <td></td>  <td><input type="hidden" name="poze" value="'.$row['Numar'].'"/></td></tr>
		<tr> <td></td>  <td><input type="hidden" name="tip3" value="'.'1'.'"/></td></tr>
		<tr> <td><input type="submit" value="Pozele" id="pozele" class="button"></td>  </tr>
		</table>
		</form>';
		$html .= '<form action="Recomanda.php" method="post" enctype="multipart/form-data">
		<table>
		<tr> <td></td>  <td><input type="hidden" name="postare" value="'.$row['Numar'].'"/></td></tr>
		<tr> <td></td>  <td><input type="hidden" name="tip3" value="'.'1'.'"/></td></tr>
		<tr> <td><input type="submit" value="Recomanda" id="pozele" class="button"></td>  </tr>
		</table>
		</form>';
		/* 
		$com = "SELECT count(Postare) FROM `apreciere` where Postare=".$row['Numar']."";

		$numar = $b->query($com);
		//$rand=$numar->fetch_assoc();
		

		$interogare= "SELECT * from `apreciere` where Postare='".$row['Numar']."' and Persoana='".$_SESSION['email']."'";
		$aprec= $b->query($interogare);
		if($aprec->num_rows>0)
			echo '<p>Apreciata</p>';
		echo '<p>Aprecieri:'.$rand['count(Postare)'].'</p>';
 */
		$html .= '</div>';
	 }

	$html .= '</div>';
	$html .= "<div class='centrat1'>";
	$html .= '</div>';
	}
	else {
	$html .=  'Nu au fost gasite rezultate';
	}	
	return $html;
}
if (!function_exists('str_contains')) {
    function str_contains(string $haystack, string $needle)
    {
        return '' === $needle || false !== strpos($haystack, $needle);
    }
}
?>