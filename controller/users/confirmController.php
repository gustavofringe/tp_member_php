<?php
class Confirm extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function user($id, $token)
    {
        //$this->loadModel('user');
        //$users = new User();
        $user = $this->model->check_id($id);
//start session
        if (!isset($_SESSION['user'])) {
            session_start();
        }

        if ($user && $user->token == $token) {
            //prepare table for update
            $userconf = $this->model->confirmed($id);
            //define session user
            $_SESSION['user'] = $user->username;
            Session::setFlash("Votre compte a bien été validé");
            header('Location: ' . BASE_URL);
            die();
        } else {
            Session::setFlash("Vous n'êtes pas un utilisateur enregisté", 'danger');
            header('Location: ' . BASE_URL . '/register');
            die();
        }
    }
}
?>