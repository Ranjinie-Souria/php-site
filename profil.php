<?php require_once("header.php") ?>

<h2>Profil</h2>


<?php

/* L'utilisateur n'est pas connecté */
if (!isset($_SESSION['name'])) {
    echo("<div class='boite'>Accès restreint aux utilisateurs inscrits ! Veuillez vous connecter.</div>");
} /* L'utilisateur a soumis le formulaire */
else if (isset($_GET['add'])) {
    $image = $_SESSION['name'] . '.png';
    $nom = $_SESSION['name'];
    if (isset($_FILES['avatar'])) {
        if (isset($_SESSION['image'])) {
            unlink($_SERVER['DOCUMENT_ROOT'] . '/php/img/' . $image);
        }
        move_uploaded_file
        ($_FILES['avatar']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/php/img/' . $image);
        addAvatar($image, $nom, $connexion);
        $_SESSION['image'] = $image;
    }
    if (isset($_POST['mail'])) {
        $mail = $_POST['mail'];
        addMail($connexion, $_SESSION['name'], $mail);
    }
    echo '<br/><div class="boite">Modifications au profil effectuées !<br/><br/>
<a style="margin-left:auto;margin-right:auto;color: #ed8240;text-decoration: none;" href="./profil.php">Retourner au profil.</a></div>
</div>';
} /* L'utilisateur est connecté */
else {

    echo("<div class='boite'>Bienvenue sur votre profil, " . $_SESSION['name']);
    if (isset($_SESSION['image'])) {
        ?>

        <img alt="avatar" class="icon" style="float: right;" src="/php/img/<?php echo $_SESSION['image'] ?>"/>


        <?php
    }
    echo('<br/><br/><form action="./profil.php?add=true" method="POST" enctype="multipart/form-data">
<label for="avatar">Vous pouvez changer votre avatar :</label><br/><br/><input type="file" id="avatar" name="avatar"/><br/><br/>');

    if (isset($_SESSION['mail']) && !empty($_SESSION['mail'])) {
        $mail = $_SESSION['mail'];
        echo("Vous pouvez changer votre adresse mail. ");
    } else {
        $mail = "";
    }
    if (strlen($mail) == 0) {
        echo("Vous n'en avez pas ajouté lors de votre inscription, vous pouvez en ajouter une ici : ");
    }

    ?><br/><br/>
    <label for="mail">Email : </label>
    <input name="mail" id="mail" placeholder="Votre email" value="<?php echo $mail ?>"/><br/><br/>
    <button type="submit">Soumettre</button></form></div>
    <?php


    ?>


    <?php
}
?>

<br/><br/>
<?php require_once("footer.php") ?>

