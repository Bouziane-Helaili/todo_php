<?php ob_start() ?>


<div class="container bg-dark text-light text-center py-5 rounded-5">
    <h2 class="mb-4">Merci de vous enregistrer pour pouvoir y accéder</h2>

    <form action="register.php" method="post">
        <div class="mt-4">
            <label for="name">Prénom</label>
        </div>
        <input type="name" name="name" id="name" required><br>
        <div class="mt-4">
            <label for="email">email</label>
        </div>
        <input type="email" name="email" id="email" required>
        <div class="mt-4">
            <label for="password">Mot de passe</label>
        </div>
        <input type="password" name="password" id="password" required>
        <div class="m-4">
            <button type="submit" class="btn btn-primary" name="register">S'enregistrer</button>
        </div>
    </form>

    <?php if (isset($_SESSION["error"])) {
        foreach ($_SESSION["error"] as $message) { ?>
            <div class="alert alert-danger"> <?= $message ?>
            </div>
    <?php
        }
        unset($_SESSION["error"]);
    }
    ?>
    <p>Si vous êtes enregistrée, vous devez vous vous connecter <a href="login.php"><b>ici</b></a></p>
    <a href="login.php" class="btn btn-success">Se connecter</a>
</div>


<?php 
$content = ob_get_clean();
$title = "Enregistrement";
include 'layout.php' 
?>