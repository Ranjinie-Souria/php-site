<?php include("header.php")?>

<h2>Connexion</h2>

<div class='boite'>
<?php 
function disconnect(){
	session_unset();
    echo "<script>location.href='deconnexion.php';</script>";
}
$disconnect = 0;
if ($disconnect==1){
	disconnect();
}
	
if(!isset($_SESSION['name'])){ 

$data = $_POST;
$name = isset($data['name']) ? $data['name'] : '';
$password = isset($data['password']) ? $data['password'] : '';
?>

<form method="post">
<?php if(!$name && count($_POST)){ ?><span style="color: red"> Ce champ est obligatoire !</span><?php } ?>
<label for="name">Nom : </label>
<input name="name" id="name" placeholder="Votre nom" value="<?php echo $name ?>" required /><br/><br/>
<?php if(!$password && count($_POST)){ ?><span style="color: red"> Ce champ est obligatoire !</span><?php } ?>
<label for="password">Mot de passe : </label>
<input name="password" type="password" id="password" placeholder="Votre mot de passe" value="<?php echo $password ?>" required /><br/><br/>
<button type ="submit">Soumettre</button>
</form>

<?php

if(isset($data['name'])&&!empty($data['name'])){
	if(isset($data['password'])&&!empty($data['password'])){
		connectUser($data['name'],$data['password'],$connexion);
	}
	}
}
?>

<?php 
	if(isset($_SESSION['name'])){
		echo("Vous êtes déjà connecté ! Souhaitez-vous vous déconnecter ?</br>
		<form method='get' action='deconnexion.php?disconnect=1'>
		<button type='submit'>Se déconnecter</button></form>");
	}
?>
</div>

</body>

<?php include("footer.php") ?>

