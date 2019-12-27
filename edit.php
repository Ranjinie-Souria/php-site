<?php require_once("header.php")?>

<h2>Edition d'un utilisateur</h2>
	
	
<?php
$id = $_GET['id'];
$modifier = false;
/* Permissions */
if(!isset($_SESSION['role'])||$_SESSION['role']!=1){
	echo("<div class='boite'>Accès restreint aux utilisateurs inscrits ! Veuillez vous connecter.</div>");
}

/* L'utilisateur est connecté */
else{
	$user = getUser($connexion, $id);
	echo("<div class='boite'><h3>Modification de l'utilisateur ".$user['name']."</h3>");
	
if($modifier){
	echo('aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
	if(isset($_POST['name']) && !empty($_POST['name'])){
		$newName = $_POST['name'];
		if(isset($_POST['password']) && !empty($_POST[''])){
			$newPass = $_POST['password'];
			if(isset($_POST['role']) && !empty($_POST['role'])){
				$newRole = $_POST['role'];
				if(isset($_POST['mail']) && !empty($_POST['mail'])){
					$newMail = $_POST['mail'];
				}
				else{
					$newMail = $mail;
				}
				if(isset($_FILES['avatar']) && !$_FILES['avatar']['error']){
					move_uploaded_file($_FILES['avatar']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/php/img/'.$name.'.png');
					$newAvatar = $name.'.png';
				}
				else{
					$newAvatar = $avatar;
				}
				$id = $_GET['id'];
				editUser($connection,$id,$newName,$newPass,$newMail,$newRole,$newAvatar);
			}
		}
	}
}
else{

?>
<form action="./edit.php?modifier=true&id=<?php echo($id);?>" method="POST" enctype="multipart/form-data">
<label for="nom">Nom : </label>
<input name="nom" id="nom" placeholder="Nom" value="<?php echo $user['name'] ?>" required /><br/><br/>

<label for="password">Mot de passe : </label>
<input name="password" id="password" placeholder="Mot de passe" value="<?php echo $user['password'] ?>" required /><br/><br/>

<label for="mail">Mail : </label>
<input name="mail" id="mail" placeholder="Mail" value="<?php echo $user['mail'] ?>" /><br/><br/>

<label for="role">Rôle : </label>
<select id="role">
  <option value="0" <?php if($user['role']==0){echo 'selected';}?>>Utilisateur</option> 
  <option value="1" <?php if($user['role']==1){echo 'selected';}?>>Admin</option>
</select><br/>
<br/>
<label for="avatar">Avatar : </label>
<input type="file" id="avatar" name="avatar"/><img alt="avatar" class="icon" style="width:100px;height:100px;" src="/php/img/<?php echo $user['avatar'] ?>" />


<br/>
<br/>


<button type="submit">Modifier</button></form></div>


<br/><br/><?php }} ?>
<?php require_once("footer.php") ?>