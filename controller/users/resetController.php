<?php
class Reset extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function user($id, $token)
    {
        if (isset($id) && isset($token)) {
            $user = $this->model->check_reset($id, $token);
            if ($user) {
                if (!empty($_POST)) {
                    if (!empty($_POST['password']) && $_POST['password'] == $_POST['password_confirm']) {
                        $this->model->reset_password($_POST['password']);
                        session_start();
                        Session::setFlash("Votre mot de passe a bien été modifié");
                        $_SESSION['auth'] = $user;
                        header('Location: '.BASE_URL);
                        die();
                    }
                }
            } else {
                session_start();
                Session::setFlash("Ce lien n'est plus valide");
                header('Location: '.BASE_URL.'/login');
                die();
            }
        } else {
            header('Location: '.BASE_URL.'/login');
            die();
        }
        include ROOT.'/views/reset.php';
        //$this->require_view('reset');
    }
}
?>