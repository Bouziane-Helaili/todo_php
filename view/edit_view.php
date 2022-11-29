<?php ob_start() ?>

<h2 class="mb-4 text-light text-center">Modifier une tâche</h2>
<div class="container bg-dark text-light text-center py-5 rounded-5">
    <form action="" method="post">
        <div class="mb-4">
            <label for="task" class="mb-4">Tâche à réaliser :</label>
            <input type="text" name="task" id="task" class="form-control" value="<?= $lists->to_do ?>" >
        </div>
        <div class="mb-4">
            <label for="date">Date limite :</label>
            <input type="date" name="date" id="date"  value="<?= $lists->to_do_at ?>">
        </div>
        <div>
            <button type="submit" class="btn btn-primary" >Enregistrer la modification</button>
        </div>
    </form>

    <?php 
$content = ob_get_clean();
$title = "Modification des tâches";
include 'layout.php' 
?>