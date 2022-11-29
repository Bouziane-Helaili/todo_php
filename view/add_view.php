<?php ob_start() ?>
<h2 class="mb-4 text-light text-center">Ajouter une tâche</h2>

<div class="container bg-dark text-light text-center py-5 rounded-5">
    <form action="" method="post">
        <div class="mb-4">
            <label for="task" class="mb-4">Tâche à réaliser :</label>
            <input type="text" name="task" id="task" class="form-control" required>
        </div>
        <div class="mb-4">
            <label for="date">Date limite :</label>
            <input type="date" name="date" id="date" value="">
        </div>
        <?php if (!empty($confirm)) { ?>
            <div class="alert alert-success"> <?= $confirm ?> </div>
        <?php
        }
        unset($_SESSION["error"]);
        ?>
        <div class="spaceChoice">
            <button type="submit" class="btn btn-primary" name="addMore">Ajouter</button>
            <a href="index.php" type="submit" class="btn btn-success" name="AddBack">Retourner à la liste</a>
        </div>
    </form>

    <?php 
$content = ob_get_clean();
$title = "Ajout des tâches";
include 'layout.php' 
?>