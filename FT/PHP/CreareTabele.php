<?php
include ('c_functions.php');
	$b = new mysqli( $db_server, $db_user, $db_pass, $db_name);
	echo adauga_header("Se crează tabelele bazei de date");
	$CustomPageAtr = array( page_title => "Inițializare baza de date",
		  "site_title" => "Fly Trip",
		  "page_description" => "Adăugare tabele",
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
	echo adauga_meniu($CustomPageAtr).'<div class="center"><ul class="error">';
if(mysqli_connect_errno()){
	exit('Connect failed: '.mysqli_connect_error());
	}
	
	$sql="CREATE TABLE `utilizatori` (
	`Email` VARCHAR(100) NOT NULL PRIMARY KEY,
	`Parola` VARCHAR(10) NOT NULL,
	`Nume` VARCHAR(50) NOT NULL
	) ";
	if($b->query($sql)===TRUE):
		echo "<li>Tabelul 'utilizatori' a fost creat cu succes  </li>";
	else :
		echo "<li>Eroare: ".$b->error."</li>";
	endif;
	$sql="CREATE TABLE `postare` (
	`Locatie` VARCHAR(100) NOT NULL,
	`Email` VARCHAR(100) NOT NULL,
	`Tip` VARCHAR(20) NOT NULL,
	`Descriere` VARCHAR(500) ,
	`Numar` INT(4) PRIMARY KEY,
	`Imagine1` LONGBLOB NOT NULL,
    `Imagine2` LONGBLOB NOT NULL,
    `Imagine3` LONGBLOB NOT NULL,
	`Data` DATETIME NOT NULL
	) ";
	if($b->query($sql)===TRUE)
		echo "<li>Tabelul 'postare' a fost creat cu succes </li>";
	else 
		echo "<li>Eroare: ".$b->error."</li>";
    

	$sql="CREATE TABLE `Comentarii` (
		`ID` INT(4) PRIMARY KEY,
		`Comentariu` VARCHAR(100) NOT NULL,
		`IDPostare` VARCHAR(100) NOT NULL,
		`Utilizator` VARCHAR(100) NOT NULL
		) ";
		if($b->query($sql)===TRUE)
			echo "<li>Tabelul 'comentarii' a fost creat cu succes </li>";
		else 
			echo "<li>Eroare: ".$b->error."</li>";

	$sql="CREATE TABLE `Cereri` (
		`Utilizator` VARCHAR(100) NOT NULL,
		`Destinatar` VARCHAR(100) NOT NULL
		) ";
		if($b->query($sql)===TRUE)
			echo "<li>Tabelul 'Cereri' a fost creat cu succes </li>";
		else 
			echo "<li>Eroare: ".$b->error."</li>";

	$sql="CREATE TABLE `Prieteni` (
		`Persoana1` VARCHAR(100) NOT NULL,
		`Persoana2` VARCHAR(100) NOT NULL
		) ";
		if($b->query($sql)===TRUE)
			echo "<li>Tabelul 'Prieteni' a fost creat cu succes  </li>";
		else 
			echo "<li>Eroare: ".$b->error."</li>";
	$sql="CREATE TABLE `Administrator` (
		`Nume` VARCHAR(100) NOT NULL PRIMARY KEY,
		`Parola` VARCHAR(100) NOT NULL
		) ";
		if($b->query($sql)===TRUE)
			echo "<li>Tabelul 'Administrator' a fost creat cu succes </li>";
		else 
			echo "<li>Eroare: ".$b->error."</li>";	

	$sql="CREATE TABLE `Apreciere` (
		`Postare` INT(4) NOT NULL ,
		`Persoana` VARCHAR(100) NOT NULL
		) ";
		if($b->query($sql)===TRUE)
			echo "<li>Tabelul 'Apreciere' a fost creat cu succes </li>";
		else 
			echo "<li>Eroare: ".$b->error."</li>";
	$sql="CREATE TABLE `Recomandari` (
		`Locatie` VARCHAR(100) NOT NULL,
		`Administrator` VARCHAR(100) NOT NULL,
		`Descriere` VARCHAR(200) ,
		`Numar` INT(4) PRIMARY KEY,
		`Imagine1` LONGBLOB NOT NULL,
		`Imagine2` LONGBLOB NOT NULL,
		`Imagine3` LONGBLOB NOT NULL,
		`Data` DATETIME NOT NULL
		) ";
		if($b->query($sql)===TRUE)
			echo "<li>Tabelul 'Recomandari' a fost creat cu succes </li>";
		else 
			echo "<li>Eroare: ".$b->error."</li>";

	$sql="CREATE TABLE `RecomandariPrieteni` (
		`Utilizator1` VARCHAR(100) NOT NULL,
		`Utilizator2` VARCHAR(100) NOT NULL,
		`Postare` INT(4) NOT NULL
		) ";
		if($b->query($sql)===TRUE):
		echo "<li>Tabelul 'RecomandariPrieteni' a fost creat cu succes </li>";
			else:
		echo "<li>Eroare: ".$b->error."</li>";
			endif;
		echo '</ul></div>'.add_footer();
	$b->close();

?>