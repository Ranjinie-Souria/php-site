<?php require_once("header.php")?>

<h2>Suppression d'un utilisateur</h2>
	
	
<?php
$id = $_GET['id'];
$user = getUser($connexion,$id);
$message = false;

/* Permissions */
if(!isset($_SESSION['role'])||$_SESSION['role']!=1){
	echo("<div class='boite'>Accès restreint aux utilisateurs inscrits ! Veuillez vous connecter.</div>");
}

/* L'utilisateur est connecté */
else{
	echo("<div class='boite'><h3>Suppression de l'utilisateur ".$user['name']."</h3>");
	
	if (isset($_GET['delete'])) {
		  deleteUser($connexion,$id,$user['name']);
		  $message = true;
	}
	
if(!$message){
	echo("Attention ! Etes-vous sûr de vouloir supprimer l'utilisateur ".$user['name']." ?");
	echo("<br/><br/><br/><br/><a href='./delete.php?id=$id&delete=true' >Supprimer</a><br/><br/>");
}
else{
	echo("<h4> Utilisateur supprimé ! </h4>");
}

?><br/><br/>
<a style="margin-left:auto;margin-right:auto;color: #ed8240;text-decoration: none;" href="./admin.php"><?php if(!$message){echo("Non ! ");}?>Retourner au panneau d'administration.</a></div>



</div>
<br/><br/>
<?php 
}
require_once("footer.php"); ?>

