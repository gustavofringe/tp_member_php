<?php
class Forget extends Controller{
    public function __construct()
    {
        parent::__construct();
    }
    public function forget(){
        if(!empty($_POST) && !empty($_POST['email'])){
            //search for user
            $user = $this->model->check_email_confirm($_POST['email']);
            if($user){
                //start session
                session_start();
                //update database
                $this->model->forget($user->id);
                Session::setFlash("Les instructions du rappel de mot de passe vous ont été envoyé par e-mail");
                header('Location: '.BASE_URL);
                die();
            }else{
                Session::setFlash("Aucun compte ne correspond a cette adresse");
            }
        }
        include ROOT.'/views/forget.php';
    }
}