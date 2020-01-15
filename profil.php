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
	echo('<br/><br/><form action="./profil.php" method="POST" enctype="multipart/form-data">
<label for="avatar">Vous pouvez changer votre avatar :</label><br/><br/><input type="file" name="avatar"/><br/><br/>');

	if(isset($_SESSION['mail'])){
        $mail = $_SESSION['mail'];
        echo ("Vous pouvez changer votre adresse mail. ");
    }
    else{
        $mail = "";
    }
    if (strlen($mail)==0){
        echo ("Vous n'en avez pas ajouté lors de votre inscription, vous pouvez en ajouter une ici : ");
    }

    ?><br/><br/>
    <label for="mail">Email : </label>
    <input name="mail" id="mail" placeholder="Votre email" value="<?php echo $mail ?>" /><br/><br/>
    <button type ="submit">Soumettre</button></form></div>
    <?php

	if(isset($_FILES['avatar']) && !$_FILES['avatar']['error']){
			move_uploaded_file($_FILES['avatar']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/php/img/'.$_SESSION['name'].'.png');
			$_SESSION['image'] = $_SESSION['name'].'.png';
			addAvatar($_SESSION['image'],$_SESSION['name'],$connexion);
	}
	if (isset($_POST['mail'])){
	    $mail = $_POST['mail'];
	    addMail($connexion,$_SESSION['name'],$mail);
    }


    ?>





    <?php
}
?>

<br/><br/>
<?php require_once("footer.php") ?>

