<?php require_once("header.php")?>

<h2>Panneau d'Administration</h2>

	<div class="boite">
<?php

if(!isset($_SESSION['name'])){
	echo("Vous n'êtes pas connecté. Veuillez-vous connecter pour accéder à cette page.");
}
if(!isset($_SESSION['role']) || $_SESSION['role'] != 1){
	echo("Vous n'avez pas la permission d'accéder à cette page.");
}
else{
	echo("Voici le panneau d'administration. Vous pouvez modifier les données liées aux utilisateurs.");
	getUsersAdmin($connexion);
}

?>
</div>

<?php require_once("footer.php") ?>

