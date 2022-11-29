<?php

require_once 'partials/_start_session.php';
// require_once 'partials/_check_is_logged.php';

// session_start();
//Vérification de la présence de user dans la session, sinon redirection
if (!$_SESSION['user']) {
    header('Location: login.php');
}

//Si une tâche est complétée, elle est enregistrée dans la BDD
if (isset($_POST['task'])  && !empty($_POST['task'])) {

    require_once "partials/connect.php";
    $confirm = "";
    $id_user = $_SESSION["user"]["id"];
    $stmt = $pdo->prepare("INSERT INTO `task` (`to_do`, `to_do_at`, `id_user` ) VALUES (:task, :date, :id_user) ");
    $stmt->execute(
        array(
            'task' =>  strip_tags($_POST["task"]),
            'date' => $_POST['date'],
            'id_user'=> $id_user 
        )
    );
    $confirm = "La tâche a bien été enregistrée";
};
unset($pdo);

require_once 'view/add_view.php';