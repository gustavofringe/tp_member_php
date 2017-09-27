<?php

class Register extends Controller
{
public $view;
public $errors;
    public function __construct()
    {
        parent::__construct();
        $this->view = new View('users', 'register');
    }

    public function register()
    {
        Session::start('user');
        if (!empty($_POST)) {
            //verify entry
            if (empty($_POST['username']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['username'])) {
                $this->errors['username'] = "Votre nom d'utilisateur est incorrect";
            } else {

                $user = $this->model->check_username($_POST['username']);
                if ($user) {
                    $this->errors['username'] = "Ce nom d'utilisateur est déjà utilisé";
                }
            }
            //verify entry
            if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $this->errors['email'] = "Votre email n'est pas valide";
            } else {
                // verify if isset another identical user
                $email = $this->model->check_email($_POST['email']);
                if ($email) {
                    $this->errors['email'] = "Cette email est déjà utilisé";
                }
            }
            //verify password
            $this->errors['password'] = Service::checkPassword($_POST['confirm_password'], $_POST['password']);
            if (empty($this->errors)) {
                $this->model->register($_POST['username'], $_POST['email'], $_POST['password']);
                //send mail
                Session::setFlash("Un e-mail de confirmation vous a été envoyé pour valider votre compte");
                header('Location: ' . BASE_URL . '/login');
                die();
            }
        }
        $this->view->title = "S'enregistrer";
        $this->view->render(['register'],$this->errors);
    }
}

