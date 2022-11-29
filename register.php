<?php



require_once 'partials/_check_is_logged.php';
require_once 'partials/_start_session.php';

// session_start();
//Ouverture de la session pour vérifier si l'utilisateur est déja connecté
//Si oui, redirection vers le gestionnaire de tâche
if(isset($_SESSION["user"])){
header("Location: index.php");
exit;
}

if (!empty($_POST)) {
    if (
        isset($_POST['name'], $_POST['email'], $_POST['password'])
        && !empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password'])
    ) {
        //Récupération des données sécurisées
        $userName = htmlentities($_POST["name"]);
        $_SESSION["error"] = [];
        if (strlen($userName) < 3) {
            $_SESSION["error"][] = "Le nom est trop court";
        }
        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $_SESSION["error"][] = "L'adresse email est incorrecte";
        }
        if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/", $_POST['password'])){
            $_SESSION['error'][] = "Le mot de passe doit contenir au moins 8 caractères dont une minuscule, une majuscule, un chiffre et un caractère spécial";
        } 
        //Si il y a une erreur enregistrée dans la session, on arrête
        if ($_SESSION["error"] === []) {
            //On va hasher le mot de passe    
            $pass = password_hash($_POST["password"], PASSWORD_ARGON2ID);
            // On enregistre dans la BDD
            require_once "partials/connect.php";
            //Vérifier si le mail est déjà dans la BD 
            $stmt = $pdo->prepare("SELECT * FROM `user` WHERE `email` = ?");
            $stmt->execute(array($_POST["email"]));
            $count = $stmt->rowCount();
            if ($count > 0) {
                $_SESSION["error"][] = "Ce mail est déjà enregistré";
                $user = $stmt->fetch();
            } else {
                $stmt = $pdo->prepare("INSERT INTO `user` (`name`, `email`, `password`) VALUES (:user_name, :email, :user_password)");
                $stmt->execute([
                    'user_name' => $userName,
                    'email' => $_POST['email'],
                    'user_password' => $pass
                ]);
                unset($pdo);
                header('Location: login.php');
            }
        }
    } else {
        $_SESSION["error"] = "Le formulaire est incomplet";
    }
}

require_once 'view/register_view.php';