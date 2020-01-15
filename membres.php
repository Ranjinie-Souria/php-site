<?php require_once("header.php")?>

<h2>Liste des membres</h2>
<div class="boite">
<?php

if(!isset($_SESSION['name'])){
    echo("Vous n'êtes pas connecté. Veuillez-vous connecter pour accéder à cette page.");
}
else{
    getUsers($connexion);
}

?></div>

<?php require_once("footer.php") ?>

