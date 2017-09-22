<?php
$user_id = $url[1];
$token = $url[2];
$users = new register;
$user = $users->check_id($user_id);
//start session
if(!isset($_SESSION['user'])){
    session_start();
}
if ($user && $user->token == $token) {
    //prepare table for update
    $userconf = $users->confirmed($user_id);
    //define session user
    $_SESSION['user'] = $user->username;
    setFlash("Votre compte a bien été validé");
    header('Location: '.BASE_URL);
    die();
} else {
    setFlash("Vous n'êtes pas un utilisateur enregisté", 'danger');
    header('Location: '.BASE_URL.'/register');
    die();
}
?>