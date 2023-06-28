<?php 

function requireValidSession() {
    $user $_SESSION['user'];
    if(!isset($user)) {
        heaader('Location: login.php');
        exit();
    }
}