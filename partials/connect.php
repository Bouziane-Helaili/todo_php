
<?php
//Connection à la BDD et PDO::FETCH_OBJ par défaut
try {
    $pdo = new PDO(
        "mysql:host=localhost;dbname=todoPortfolio",
        "root",
        "",
        [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    );
} catch (PDOException $e) {
die("Erreur : " .$e->getMessage());
};