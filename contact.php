<?php require_once("header.php")?>

<h2>Contact</h2>

<?php
$afficheFormu = false;
$erreurFormu = false;
$erreurTexte = array();


if(isset($_SESSION['name'])){
	$nom = $_SESSION['name'];
	if(isset($_SESSION['mail'])){
		$courriel = $_SESSION['mail'];
	}
	else{
		$courriel = "";
	}
}
else{
	$nom = "";
	$courriel = "";
}

if(!isset($_POST['Envoyer']) || $_POST['Envoyer'] != 'Envoyer'){
	$afficheFormu = true;
}
else{
	if(empty($_POST['nom']) || !preg_match("/^[a-zàâäçéèêëïîôöûü\-\s']{3,}$/i", $_POST['nom'])){
		$afficheFormu = true;
		$erreurFormu = true;
		if(isset($_SESSION['name'])){
			$nom = $_SESSION['name'];
		}
		else{
			$nom = "";
		}
		$erreurTexte[] = 'Le champ "Nom" ne doit comporter que des lettres, espaces, tirets ou apostrophes.';
	}
	else{
		$nom = $_POST['nom'];
	}
	if(empty($_POST['courriel']) || !preg_match("/^[-+.\w]{1,64}@[-.\w]{1,64}\.[-.\w]{2,6}$/i", $_POST['courriel'])){
		$afficheFormu = true;
		$erreurFormu = true;
		if(isset($_SESSION['mail'])){
			$courriel = $_SESSION['mail'];
		}
		else{
			$courriel = "";
		}
		$erreurTexte[] = 'Le champ "E-mail" doit contenir une adresse valide.';
	}
	else{
		$courriel = $_POST['courriel'];
	}
	if(empty($_POST['objet'])){
		$afficheFormu = true;
		$erreurFormu = true;
		$erreurTexte[] = 'Merci de préciser l\'objet de votre mail.';
	}
	else{
		$objet = strip_tags($_POST['objet']);
		$objet = htmlentities($objet, ENT_QUOTES, "UTF-8");
	}
	if(empty($_POST['message'])){
		$afficheFormu = true;
		$erreurFormu = true;
		$erreurTexte[] = "Merci d'écrire un message.";
	}
	else{
		$message = strip_tags($_POST['message']);
		$message = htmlentities($message, ENT_QUOTES, "UTF-8");
	}
}
?>

<div class="boite">

<?php

if($afficheFormu){
	if($erreurFormu){
		echo("<p>Des erreurs ont été détectées dans le formulaire<br/>");
		echo(implode('<br />',$erreurTexte).'</p>');
	}
	else{
		echo '<h3>Vous pouvez utiliser ce formulaire afin d\'envoyer un mail.</h3>';	
	}
?>
<form method="post" action="contact.php">
<label for="nom">Nom : </label>
<input name="nom" id="nom" placeholder="Nom" value="<?php echo $nom ?>" required /><br/><br/>
<label for="courriel">Email : </label>
<input name="courriel" id="courriel" placeholder="Email" value="<?php echo $courriel ?>" required /><br/><br/>
<label for="objet">Objet : </label>
<input name="objet" id="objet" placeholder="Objet" required /><br/><br/>
<label for="message">Message : </label>
<textarea name="message" id="message" rows="10" cols="100" placeholder="Message" required ></textarea><br/>
<br/>
<input type="submit" name="Envoyer" value="Envoyer" />
</form>
<?php
}
else{
	$dest = 'ranjinie.souria@gmail.com';
	$exp = $courriel;
	$enteteMsg = $nom.' <'.$exp.'> a écrit :'."\r\n\r\n";
	$message = nl2br($enteteMsg.$message);
	$headers = 'MIME-Version: 1.0'."\r\n".'Content-type: text/html; charset=utf-8' . "\r\n".'Reply-To : '.$exp."\n".'From: '.$nom.' <'.$exp.'>'."\n";
	if (mail($dest,$objet,$message, $headers)){
		echo('<h3>Votre message a été envoyé.</h3>');
	}
	else{
		echo('<h3>Une erreur est survenue, veuillez réessayer plus tard</h3>');
	}
}



?>
</div>


<?php require_once("footer.php") ?>

