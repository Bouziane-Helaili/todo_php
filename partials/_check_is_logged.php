<?php

require_once '_start_session.php';


if(isset($_SESSION['user']['is_logged']) && $_SESSION['user']['is_logged']){
    header('Location: index.php');
    exit;
}

