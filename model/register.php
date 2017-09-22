<?php
class register{
    public $pdo;
    public function __construct(){
        $this->pdo = new Database();
    }
    public function check_username($username){
        print_r($this->pdo);
        $req = $this->pdo->prepare("SELECT id FROM users WHERE username = ?");
        $req->execute([$username]);
        $user = $req->fetch();
        return $user;
    }
    public function check_email($mail){
        $req = $this->pdo->prepare("SELECT id FROM users WHERE email = ?");
        $req->execute([$mail]);
        $email = $req->fetch();
        return $email;
    }
    public function check_id($id){
        //prepare table for verify token
        $req = $this->pdo->prepare('SELECT * FROM users WHERE id = ?');
        $req->execute([$id]);
        $user = $req->fetch();
        return $user;
    }
    public function confirmed($id){
        $this->pdo->prepare('UPDATE users SET token_confirmed = NULL, created_at = NOW(), confirmed = ? WHERE id=?')->execute([true, $id]);
        
    }
    public function regist($username, $email,$pass){
        $req = $this->pdo->prepare("INSERT INTO users SET username = ?, email = ?, password = ?, token = ?, created_at = NOW(), confirmed_at= ?");
        //hash password
        $password = password_hash($pass, PASSWORD_BCRYPT);
        //create token for verification
        $token = md5(time() * 5);
        //execute request
        $req->execute([$username, $email, $password, $token, false]);
        $user_id = $this->pdo->lastInsertId();
        //send mail
        mail($_POST['email'], "Validation de votre compte", "Afin de valider votre compte merci de cliquer sur ce lien\n\nhttp://localhost/Lab/tp_member_php/confirm/$user_id/$token");
        setFlash("Un e-mail de confirmation vous a été envoyé pour valider votre compte");
    }
}