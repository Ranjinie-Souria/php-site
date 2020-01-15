<?php require("sql/baseconnexion.php");
require("sql/sql.php");
session_start() ?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type"content="text/html;charset=utf-8" />
		<link rel="stylesheet" media="screen" type="text/css" href="style.css"/>
		<link href="https://fonts.googleapis.com/css?family=Lobster&display=swap" rel="stylesheet">
		<title>PHP</title>
		<div style="titre"><h1>Compte Rendu PHP</h1></div>
		
	</head>
	<header>
	<nav class="navMain">
	<a href="index.php">Page d'accueil </a>
	<?php if(isset($_SESSION['name'])){echo("<a href='profil.php'>Profil</a>");}
			elseif(!isset($_SESSION['name'])){echo("<a href='inscription.php'>Inscription</a>
			 <a href='connexion.php'>Connexion</a>");}
	?>
	<?php if(isset($_SESSION['name']) && $_SESSION['role']==1){echo("<a href='admin.php'>Panneau d'Administration</a>");}?>

	<a href="contact.php"> Contact</a>
	<a href="../Collectify/web/app_dev.php/">Collectify</a></ul>
	
	<?php
	if(isset($_SESSION['name'])){
	    echo("<a href=\"membres.php\"> Liste des membres</a>");
		echo("<a href='./deconnexion.php?disconnect=1'>Se déconnecter</a>");
		if(isset($_SESSION['image'])){
			echo('<img alt="avatar" class="avatar" src="/php/img/'.$_SESSION['image'].'" />');
		}
		echo("<a style='padding: 5px 0px;color: #ed8240;text-decoration: none;' href='profil.php'>Bienvenue, ".$_SESSION['name']." !</a>");
	}
	?></nav>
	</header>
	<body>
