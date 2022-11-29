<?php ob_start() ?>

<h2 class="mb-4 text-light text-center">Bonjour <?= strtoupper($_SESSION["user"]["name"]) ?>, voici la liste de tes tâches</h2>

<?php if (isset($task) && empty($task)) : ?>
    <div class="container  py-5">
        <div class="spaceChoice pb-5">
            <div>
                <a href="add.php" class="btn btn-primary">Ajouter une tâche</a>
            </div>
            <div>
                <a href="deconnect.php" class="btn btn-danger">Déconnexion</a>
            </div>
        </div>
        <div class="m-4 text-dark text-center alert alert-success fs-2 font-weight-bold">Et si vous ajoutiez une tâche pour commencer</div>
    </div>
<?php else : ?>
    <div class="container  pt-5 pb-3">
        <div class="spaceChoice">
            <div>
                <form method="GET" id="orderForm" class="pb-5 ">
                    <select name="order" id="order">
                        <option value="">Trier à partir</option>
                        <option value="asc">Du moins récent</option>
                        <option value="desc">Du plus récent</option>
                    </select>
                </form>
            </div>
            <div>
                <a href="add.php" class="btn btn-primary">Ajouter une tâche</a>
            </div>
            <div>
                <a href="deconnect.php" class="btn btn-danger">Déconnexion</a>
            </div>
        </div>
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th></th>
                    <th>Tâche à réaliser</th>
                    <th>Pour le :</th>
                    <th>Action </th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <form method="post">
                    <?php foreach ($task as $list) : ?>
                        <tr>
                            <td><input class="form-check-input " type='checkbox' name='event[]' value='<?= $list->id; ?>'>
                            </td>
                            <?php if ($list->is_done == 1) : ?>
                                <td class="text-decoration-line-through">
                                    <?= $list->to_do ?>
                                </td>
                            <?php else : ?>
                                <td class="fs-5">
                                    <?= $list->to_do ?>
                                </td>
                            <?php endif ?>
                            <?php if ($list->to_do_at == "0000-00-00") : ?>
                                <td></td>
                            <?php else : ?>
                                <td><?= $list->to_do_at ?></td>
                            <?php endif ?>
                            <td><a href="edit.php?id=<?= $list->id ?>" class="btn btn-warning">Modifier</a></td>
                            <td class="text-danger">
                                <?php if ($list->is_done == 0 && $list->to_do_at != "0000-00-00" && $list->to_do_at < $dt) : ?>
                                    <?= "EN RETARD" ?>
                                <?php else : ?>
                                    <?= "" ?>
                                <?php endif ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <div class="text-center pb-5">
        <input type='submit' value='supprimer' name="delete" class="btn btn-danger mb-3 mx-auto">
        <input type='submit' value='Déja fait' name="done" class="btn btn-success mb-3 mx-auto taskDone">
        </form>
    </div>
<?php endif ?>
    <?php 
$content = ob_get_clean();
$title = "gestionnaire des tâches";
include 'layout.php' 
?>