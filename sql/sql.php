<?php
require("baseconnexion.php"); /* Connexion à la base de données */

/* Fonctions faisant appel à la base de données */

/* Ajout d'un utilisateur */
function addUser($name,$password,$mail,$connexion){
	$doublonRequete = "SELECT COUNT(*) as user FROM users WHERE name = '$name'"; /* Recherche au cas où le nom est déjà pris */
	$doublons = $connexion->query($doublonRequete);
	$doublon = $doublons->fetch_object();
	if($doublon->user >= 1 ){
		echo '<br/><div class="boite">Ce nom d\'utilisateur est déjà pris.</div>';
	}
	else{
		$sql = "INSERT INTO `sitephp`.`users` (`name`, `password`, `mail`,`role`) VALUES ('$name', '$password','$mail',0)";
		$requete = $connexion->query($sql);
		echo '<br/><div class="boite">Votre compte a été crée ! </div>';
	}
}

/* Connexion d'un utilisateur */
function connectUser($name,$password,$connexion){
	$sql = "SELECT COUNT(*) as user FROM users WHERE name = '$name' AND password = '$password'";
	$resultats = $connexion->query($sql);
	$result = $resultats->fetch_object();
	if($result->user == 1 ){
		$_SESSION['name'] = $name;
		$_SESSION['password'] = $password;
		$requeteRole = "SELECT role FROM users WHERE `name`='$name'";
		$role = $connexion->query($requeteRole);
		$role = mysqli_fetch_array($role);
		$_SESSION['role'] = $role[0];
		$requeteAvatar = "SELECT avatar FROM users WHERE `name`='$name'";
		$avatar = $connexion->query($requeteAvatar);
		$avatar = mysqli_fetch_array($avatar);
		$_SESSION['image'] = $avatar[0];
		$requeteMail = "SELECT mail FROM users WHERE `name`='$name'";
		$mail = $connexion->query($requeteMail);
		$mail = mysqli_fetch_array($mail);
		$_SESSION['mail'] = $mail[0];
		echo "<script>location.href='index.php';</script>";
	}
	else{
		echo '<br/><div class="boite">Nom d\'utilisateur ou mot de passe incorrect !</div>';
	}
}

/* Ajout d'un avatar */
function addAvatar($avatar,$name,$connexion){
	$sql = "UPDATE `sitephp`.`users` SET `avatar`='$avatar' WHERE `name`='$name'";
	if($connexion->query($sql)){
		echo '<br/><div class="boite">Avatar ajouté !</div>';
	}
	else{
		echo $connexion->error;
	}
}

/* add mail */
function addMail($connexion,$name,$mail){
    $sql = "UPDATE `sitephp`.`users` SET `mail`='$mail' WHERE `name`='$name'";
    if($connexion->query($sql)){
        echo '<br/><div class="boite">Email modifié !</div>';
        $_SESSION['mail'] = $mail;
    }
    else{
        echo $connexion->error;
    }
}

/* Affichage des utilisateurs */
function getUsers($connexion){
	if($connexion){
		$sql = "SELECT name,mail FROM `sitephp`.`users`";
		$result=mysqli_query($connexion,$sql);
		echo("<table><tr><th>Nom</th><th>Mail</th></tr>");
		while ($row=mysqli_fetch_array($result)) {
			echo("<tr><td>".$row['name']."</td>");
			if(empty($row['mail'])){
				echo("<td>Pas d'email ajoutée</td></tr>");}
			else{
				echo("<td>".$row['mail']."</td></tr>");
			}
		}
		echo("</table>");
	}
}






/*************** Panneau d'administration ***************/
/* Affichage des utilisateurs */
function getUsersAdmin($connexion){
	if($connexion){
		$sql = "SELECT * FROM `sitephp`.`users`";
		$result=mysqli_query($connexion,$sql);
		echo("<table><tr><th>Nom</th><th>Mot De Passe</th><th>Mail</th><th>Rôle</th><th>Avatar</th><th>Modifier</th><th>Supprimer</th></tr>");
		while ($row=mysqli_fetch_array($result)) {
			$id = $row['id'];
			echo("<tr><td>".$row['name']."</td>");
			echo("<td>".$row['password']."</td>");
			if(empty($row['mail'])){
				echo("<td>Pas d'email ajoutée</td>");}
			else{
				echo("<td>".$row['mail']."</td>");
			}
			if($row['role']==1){
				echo("<td>Admin</td>");}
			else{
				echo("<td>Utilisateur</td>");
			}
			if(empty($row['avatar'])){
				echo("<td>Pas d'avatar ajouté</td>");
			}
			else{
				echo('<td><img alt="avatar" class="icon" src="/php/img/'.$row['avatar'].'" /></td>');
			}
			echo("<td><a href='./edit.php?id=$id'><button>X</button></td>");
			echo("<td><a href='./delete.php?id=$id'><button>X</button></td></tr>");
			}
		echo("</table>");
	}
}

/* Suppression d'un utilisateur */
function deleteUser($connexion,$id,$name){
	$sql = "DELETE FROM `sitephp`.`users` WHERE `id`=$id";
	if($connexion->query($sql)){
		unlink($_SERVER['DOCUMENT_ROOT'].'/php/img/'.$name.'.png');
	}
	else{
		echo $connexion->error;
	}
}	
/* get utilisateur */
function getUser($connexion,$id){
	$sql = "SELECT * FROM `sitephp`.`users` WHERE `id`='$id'";
	if($connexion->query($sql)){
		$user = $connexion->query($sql);
		$user = mysqli_fetch_array($user);
		return $user;
	}
	else{
		echo $connexion->query($sql);
	}
}
	
/* Modification d'un utilisateur */
function editUser($connexion,$id,$name,$password,$mail,$role,$avatar){
	$sql = "UPDATE `sitephp`.`users` SET `name`='$name',`password`='$password', `mail`='$mail',`role`='$role',`avatar`='$avatar' WHERE `id`='$id'";
	if($connexion->query($sql)){
	}
	else{
		echo $connexion->error;
	}
}

?>