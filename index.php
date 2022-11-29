<?php
require_once 'partials/_start_session.php';
// require_once 'partials/_check_is_not_logged.php';

// session_start();
//Vérification de la présence de user dans la session, sinon redirection
if (!$_SESSION['user']) {
    header('Location: login.php');
}

require_once "partials/connect.php";

//Récupération de la date du jour pour comparaison
$dt = date("Y-m-d");

//Suppression des tâches après selection
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["delete"]) && isset($_POST['event'])) {
    $sql = "DELETE FROM task WHERE id=:id";
    $stmt = $pdo->prepare($sql);
    foreach ($_POST['event'] as $id) {
        $stmt->execute(['id' => $id]);
    }
}
//Modifications du statut is_done après selection
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["done"]) && isset($_POST['event'])) {
    $sql = "UPDATE task set is_done = 1 WHERE id=:id";
    $stmt = $pdo->prepare($sql);
    foreach ($_POST['event'] as $id) {
        $stmt->execute(['id' => $id]);
    }
}

//Récupération des tâches de l'utilisateur
$id_user = $_SESSION["user"]["id"];
$stmt = $pdo->query("SELECT * FROM task WHERE id_user = $id_user ");
$task = $stmt->fetchAll();


// trier les éléments par prix 
$order_request = null;

if (isset($_GET['order']) && in_array($_GET['order'], ['asc', 'desc'])) {
    $order_request = 'ORDER BY to_do_at ' . $_GET['order'];
}


try {

    $stmt = $pdo->query("SELECT * FROM task WHERE id_user =$id_user $order_request");

    $task = $stmt->fetchAll();
} catch (PDOException $e) {

    echo "Nous avons eu un problème de récupération de données";
}

require_once 'view/index_view.php';