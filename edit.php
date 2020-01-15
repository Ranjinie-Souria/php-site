<?php require_once("header.php")?>

<h2>Edition d'un utilisateur</h2>
	
	
<?php
$id = $_GET['id'];
/* Permissions */
if(!isset($_SESSION['role'])||$_SESSION['role']!=1){
	echo("<div class='boite'>Accès restreint aux utilisateurs inscrits ! Veuillez vous connecter.</div>");
}
/* L'utilisateur est connecté */
else{
	$user = getUser($connexion, $id);
	$name = $user['name'];
    $password = $user['password'];
    $mail = $user['mail'];
    $avatar = $user['avatar'];
    $role = $user['role'];




    echo("<div class='boite'><h3>Modification de l'utilisateur ".$name."</h3>");

?>
<form action="./edit.php?modifier=1&id=<?php echo($id);?>" method="POST" enctype="multipart/form-data">
<label for="name">Nom : </label>
<input name="name" id="name" placeholder="Nom" value="<?php echo $name ?>" required /><br/><br/>

<label for="password">Mot de passe : </label>
<input name="password" id="password" placeholder="Mot de passe" value="<?php echo $password ?>" required /><br/><br/>

<label for="mail">Mail : </label>
<input name="mail" id="mail" placeholder="Mail" value="<?php echo $mail ?>" /><br/><br/>

<label for="role">Rôle : </label>
<select id="role">
  <option value="0" <?php if($role==0){echo 'selected';}?>>Utilisateur</option>
  <option value="1" <?php if($role==1){echo 'selected';}?>>Admin</option>
</select><br/>
<br/>
<label for="avatar">Avatar : </label>
<input type="file" id="avatar" name="avatar"/><img alt="avatar" class="icon" style="width:100px;height:100px;" src="/php/img/<?php echo $avatar ?>" />


<br/>
<br/>


<button type="submit">Modifier</button></form></div>


<br/><br/><?php

    if (isset($_POST['name']) && !empty($_POST['name'])) {
        $newName = $_POST['name'];
    }
    else{
        $newName = $user['name'];
    }
    if (isset($_POST['password']) && !empty($_POST[''])) {
        $newPass = $_POST['password'];
    }
    else{
        $newPass = $user['password'];
    }
    if (isset($_POST['role']) && !empty($_POST['role'])) {
        $newRole = $_POST['role'];

    }
    else{
        $newRole = $user['role'];
    }
    if (isset($_POST['mail']) && !empty($_POST['mail'])) {
        $newMail = $_POST['mail'];
    }
    else{
        $newMail = $user['mail'];
    }
    if (isset($_FILES['avatar']) && !$_FILES['avatar']['error']) {
        move_uploaded_file($_FILES['avatar']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/php/img/' . $name . '.png');
        $newAvatar = $name . '.png';
    }
    else{
        $newAvatar = $user['avatar'];
    }
    $id = $_GET['id'];
    editUser($connexion, $id, $newName, $newPass, $newMail, $newRole, $newAvatar);

} ?>
<?php require_once("footer.php") ?>