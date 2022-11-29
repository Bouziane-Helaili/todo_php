<?php

require_once 'partials/_start_session.php';
// require_once 'partials/_check_is_logged.php';

// session_start();
//Vérification de la présence de user dans la session, sinon redirection
if (!$_SESSION['user']) {
    header('Location: login.php');
}

require_once "partials/connect.php";

//Récupération de l'id pour afficher ses tâches
$id_edit = $_GET['id'];

//Enregistrement des modifications
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST["task"])) {
    try {
        $stmt = $pdo->prepare("UPDATE task SET `to_do` = :new_task, `to_do_at`= :new_date WHERE id = :id");
        $stmt->execute(array(
            'new_task' =>  strip_tags($_POST["task"]),
            'new_date' => $_POST['date'],
            'id' => $id_edit
        ));
    } catch (PDOException $th) {
        $message = $th->getMessage();
    }

    header("Location: index.php");
}
//Récupération des tâches
$stmt = $pdo->prepare("SELECT * FROM task WHERE id = :id");
$stmt->execute([
    'id' => $id_edit
]);

$lists = $stmt->fetch(PDO::FETCH_OBJ);
unset($pdo);

require_once 'view/edit_view.php';