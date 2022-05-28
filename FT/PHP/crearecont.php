<?php
	session_start();
	include ('c_functions.php');
	$_SESSION['numeutilizator']=$_POST["numeutilizator"];
	$_SESSION['email']=$_POST["email"];
	$_SESSION['parola']=$_POST["parola1"];
	$parola2=$_POST["parola2"];
	$email=$_POST["email"];
	
	$pattern='/[a-zA-Z0-9._,+-]+@[a-zA-Z0-9._,+-]+\.[a-zA-Z]{2,6}/';
	echo adauga_header("Erori Creare Cont");
	$CustomPageAtr = array(
	      "page_title" => "Mesaje creare cont",
		  "site_title" => "Fly Trip",
		  "page_description" => "Adăugare utilizator",
		  "legaturi" => array (
			array ( 
					"nume" => "Prima Pagină",
					"link_url" => "../pornire.html"
					),
			array ( 
					"nume" => "Creare Cont",
					"link_url" => "../crearecont.html"
					)
				)
		  );
	echo adauga_meniu($CustomPageAtr).'<div class="center"><section class="error">';
	if(preg_match($pattern, $email)) {
	
	if(strlen($_SESSION['numeutilizator'])<5 || strlen($_SESSION['numeutilizator'])>25) {
		echo "<p>Nume de utilizator de dimensiuni nepotrivite (între 5 şi 25 de caractere)</p>";
	}
	else{
	if(strlen($parola2)>9 || strlen($parola2)<5)
	{
		echo "<p>Parola are dimensiuni nepotrivite</p>";
	}
	else
	{
	$b=mysqli_connect( $db_server, $db_user, $db_pass, $db_name);
    if (mysqli_connect_errno()) {
		exit('Connect failed: '. mysqli_connect_error());
	}
	
	if($_SESSION['parola']!=$parola2)
		echo '<p>Parola1 tebuie sa fie egala cu Parola2</p>';
	else 
	{
	
	$com="SELECT * FROM `utilizatori`";
	$bc=0;
	$info=$b->query($com);
	if($info->num_rows > 0)
	{
		$a=0;
		$bc=0;
		while($row=$info->fetch_assoc())
		{
			if($row['Nume']==$_SESSION['numeutilizator'])
				$a=1;
			if($row['Email']==$email)
				$bc=1;
		}
		if($a==1)
			echo '<p>Numele de utilizator este luat</p>';
		if($bc==1)
			echo '<p>Adresa de email este deja utilizată</p>';
		
	}
		if($a==0 && $bc==0)
		{
			if(strlen($email)<4){
				echo '<p>Adresa de email este invalidă</p>';
			}
			else
			{
				$utilizator="Insert into `utilizatori` (Email,Parola,Nume) values ('".$email."','".$_SESSION['parola']."','".$_SESSION['numeutilizator']."')"; 
				if(mysqli_query($b,$utilizator)):
					 echo "Contul a fost creat cu succes! <a href='../login.html' cass='button'>Autentifică-te!</a>";
				 else:
					 echo "Datele nu au putut fi adăugate ". mysqli_errno($b). " : ". mysqli_error($b);
					 endif;
			}
		}
	
	}
	$b->close();
	}
	}
	}
	else {
		echo "<p>Adresa de email nu este corecta</p>";
	}
	
		echo '</section></div>'.add_footer();
?>