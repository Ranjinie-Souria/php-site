<?php
$connexion = new mysqli('localhost', 'root', '', 'sitephp');
if($connexion->error){
	die('Erreur de connexion : ' .$connexion->error);
}
?>