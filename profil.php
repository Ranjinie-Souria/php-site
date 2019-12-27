<?php require_once("header.php")?>

<h2>Profil</h2>
	
	
<?php

/* L'utilisateur n'est pas connecté */
if(!isset($_SESSION['name'])){
	echo("<div class='boite'>Accès restreint aux utilisateurs inscrits ! Veuillez vous connecter.</div>");
}

/* L'utilisateur est connecté */
else{
	echo("<div class='boite'>Bienvenue sur votre profil, ".$_SESSION['name']);
	echo('<form action="./profil.php" method="POST" enctype="multipart/form-data"> 
	Vous pouvez changer votre avatar : <input type="file" name="avatar"/><button type ="submit">Soumettre</button></form></div>');
	
	if(isset($_FILES['avatar']) && !$_FILES['avatar']['error']){
			move_uploaded_file($_FILES['avatar']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/php/img/'.$_SESSION['name'].'.png');
			$_SESSION['image'] = $_SESSION['name'].'.png';
			addAvatar($_SESSION['image'],$_SESSION['name'],$connexion);
	}
}
?>

<br/><br/>
<?php require_once("footer.php") ?>

