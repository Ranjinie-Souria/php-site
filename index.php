<?php require_once("header.php") ?>

<h2>Index</h2>

<div class="boite">
    Bienvenue sur ce site web,
    <?php
    if (isset($_SESSION['name'])) {
        echo($_SESSION['name']);
    } else {
        echo(" visiteur ! N'hésitez pas à vous inscrire ou vous connecter pour accéder à toutes les pages du site ");
    }
    ?> !
</div>

<div class="boite">
    Vous pouvez accéder librement au projet <a href="../Collectify/web/app_dev.php">Collectify</a> !
</div>


<?php require_once("footer.php") ?>

