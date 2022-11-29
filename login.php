<?php
require_once 'partials/_start_session.php';
require_once 'partials/_check_is_logged.php';

// session_start();
//Ouverture de la session pour vérifier si l'utilisateur est déja connecté
//Si oui, redirection vers le gestionnaire de tâche
if(isset($_SESSION["user"])){
header("Location: index.php");
exit;
}

if (!empty($_POST)) {
    if (
        isset($_POST['email'], $_POST['password'])
        && !empty($_POST['email']) && !empty($_POST['password'])
    ) {
        $_SESSION["error"] = [];
        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $_SESSION["error"][] = "L'adresse email est incorrecte";
        }
        //Le mot de passe est hasher   
        $pass = password_hash($_POST["password"], PASSWORD_ARGON2ID);

        //Connection à la BDD
        require_once "partials/connect.php";
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        $stmt = $pdo->prepare("SELECT * FROM `user` WHERE `email` = :email");
        $stmt->execute([
            'email' => $_POST['email'],
        ]);
        $user = $stmt->fetch();
        if (!$user) {
            $_SESSION["error"][] = "Le mail ou le mot de passe est incorrecte";
            $user["password"] = "";
        }
        //Si le mail est existant, verification du mot de passe
        if (!password_verify($_POST["password"], $user["password"])) {
            $_SESSION["error"][] = "Le mail ou le mot de passe est incorrecte";
        }
        //Si il y a une erreur enregistrée dans la session, ça s'arrête
        if ($_SESSION["error"] === []) {

            //Ouverture de la session pour la connection au gestionnaire de tâche
            session_start();
            $_SESSION["user"] = [
                "id" => $user["id"],
                'is_logged' => TRUE,
                "name" => $user["name"],
                "email" => $user["email"]
            ];
            unset($pdo);
            header('Location: index.php');
        }
    }
}

require_once 'view/login_view.php';
