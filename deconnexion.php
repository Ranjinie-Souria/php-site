<?php include("header.php") ?>

<?php 
if(isset($_GET['disconnect'])&&$_GET['disconnect']=='1'){
		session_unset();
	}
?>
<h2>Déconnexion</h2>

<div class="boite">Vous vous êtes bien déconnecté.</br></br>
	<a style="margin-left:auto;margin-right:auto;color: #ed8240;text-decoration: none;" href="index.php">Retourner à l'accueil</a></div>


</body>

<?php include("footer.php") ?>

