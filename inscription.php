<?php require_once("header.php")?>

<h2>Inscription</h2>

<?php 

$data = $_POST;
$name = isset($data['name']) ? $data['name'] : '';
$password = isset($data['password']) ? $data['password'] : '';
$mail = isset($data['mail']) ? $data['mail'] : '';

if (isset($_GET['create'])) {
    echo '<br/><div class="boite">Votre compte a été crée ! </div>';
}


?>


<div class="boite">
    <form action="./inscription.php?create=true" method="post">
<?php if(!$name && count($_POST)){ ?><span style="color: red"> Ce champ est obligatoire !</span><?php } ?>
<label for="name">Nom *: </label>
<input name="name" id="name" placeholder="Votre nom" value="<?php echo $name ?>" required /><br/><br/>

<label for="password">Mot de passe *: </label>
<?php if(!$password && count($_POST)){ ?><span style="color: red"> Ce champ est obligatoire !</span><?php } ?>
        <input name="password" type="password" id="password" placeholder="Votre mot de passe"
               value="<?php echo $password ?>"
               required/><br/><br/>

<label for="mail">Email : </label>
<input name="mail" id="mail" placeholder="Votre email" value="<?php echo $mail ?>" /><br/><br/>
<button type ="submit">Soumettre</button>
</form><br/>
<i style="font-size:12px;" >Les champs * sont obligatoires</i>
</div>
<?php

if(isset($data['name'])&&!empty($data['name'])){
	if(isset($data['password'])&&!empty($data['password'])){
		addUser($data['name'],$data['password'],$data['mail'],$connexion);
	}
}
?>

</body>

<?php require_once("footer.php") ?>

