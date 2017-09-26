<?php

class Login extends Controller
{
    public $view;
    public function __construct()
    {
        parent::__construct();
        print_r(ROOT );
        $this->view = new View('users', 'login');
        
    }

    public function login()
    {
echo 111;
        //$model = new User();
        Session::start('user');
//verify entry
        if (!empty($_POST) && !empty($_POST['username']) && !empty($_POST['password'])) {
            $user = $this->model->check_users($_POST['username']);
            if (isset($user->confirmed) && $user->confirmed == true) {
                if (password_verify($_POST['password'], $user->password)) {
                    $_SESSION['user'] = $user->username;
                    Session::setFlash("Vous êtes maintenant connecté");
                    header('Location: ' . BASE_URL);
                } else {
                    Session::setFlash("Identifiant ou mot de passe incorrect", 'danger');
                }
            } else {
                Session::setFlash("Aucun compte ne correspond", 'danger');
            }
        }
        $this->view->render(['login']);
        //include ROOT . '/views/login.php';
        //$this->require_view('login');
    }

}