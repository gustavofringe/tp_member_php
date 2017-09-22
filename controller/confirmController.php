<?php
$user_id = $url[1];
$token = $url[2];
$users = new register();
$user = $users->check_id($user_id);
//start session
session_start();
if ($user && $user->token == $token) {
    //prepare table for update
    $user = $users->confirmed($user_id);
    //define session user
    $_SESSION['user'] = $user;
    setFlash("Votre compte a bien été validé");
    header('Location: '.BASE_URL.'/login');
    die();
} else {
    setFlash("Vous n'êtes pas un utilisateur enregisté", 'danger');
    header('Location: '.BASE_URL.'/register');
    die();
}
?>