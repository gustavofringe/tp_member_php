<?php
class logout
{
    public function __construct()
    {
        session_start();
        unset($_SESSION['user']);
        Session::setFlash('Vous êtes maintenant déconnecter','danger');
        header('Location: '.BASE_URL);
        die();
    }
}