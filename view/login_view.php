<?php ob_start() ?>

<div class="container bg-dark text-light text-center py-5 rounded-5">
    <h2 class="mb-4">Merci de vous connecter pour pouvoir y accéder</h2>

    <form action="login.php" method="post">
        <div class="mt-4">
            <label for="email">Email</label>
        </div>
        <input type="email" name="email" id="email" required>
        <div class="mt-4">
            <label for="password">Mot de passe</label>
        </div>
        <input type="password" name="password" id="password" required>
        <div class="m-4">
            <button type="submit" class="btn btn-primary" name="connection">Se connecter</button>
        </div>
    </form>
    <?php if (isset($_SESSION["error"])) {
        foreach ($_SESSION["error"] as $message) { ?>
            <div class="alert alert-danger"> <?= $message ?> </div>
    <?php
        }
        unset($_SESSION["error"]);
    } ?>
    <p>Si vous n'êtes pas enregistrée, vous pouvez le faire <a href="register.php"><b>ici</b></a></p>
    <a href="register.php" class="btn btn-success">S'enregistrer</a>
</div>


<?php 
$content = ob_get_clean();
$title = "Connexion";
include 'layout.php' 
?>