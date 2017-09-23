<?php

class Login extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->loadModel('user');
        $model = new User();
        if (!isset($_SESSION['user'])) {
            session_start();
        }
//verify entry
        if (!empty($_POST) && !empty($_POST['username']) && !empty($_POST['password'])) {
            $user = $model->check_users($_POST['username']);
            if (isset($user->confirmed) && $user->confirmed == true) {
                if (password_verify($_POST['password'], $user->password)) {
                    $_SESSION['user'] = $user->username;
                    Session::setFlash("Vous êtes maintenant connecté");
                    header('Location: ' . BASE_URL);
                } else {
                    Session::setFlash("Identifiant ou mot de passe incorrect", 'danger');
                }
            } else {
                Session::setFlash("Vous devez confirmer votre compte", 'danger');
            }
        }
        include ROOT . '/views/login.php';
        //$this->require_view('login');
    }

}