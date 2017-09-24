<?php
class User extends Model{
    public $pdo;
    public function __construct()
    {
        parent::__construct();
    }

    public function check_username($username){
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
    public function register($username, $email,$pass){
        $req = $this->pdo->prepare("INSERT INTO users SET username = ?, email = ?, password = ?, token = ?, created_at = NOW(), confirmed_at= ?");
        //hash password
        $password = password_hash($pass, PASSWORD_BCRYPT);
        //create token for verification
        $token = md5(time() * 5);
        //execute request
        $req->execute([$username, $email, $password, $token, false]);
        $user_id = $this->pdo->lastInsertId();
        mail($email, "Validation de votre compte", "Afin de valider votre compte merci de cliquer sur ce lien\n\nhttp://localhost/tp_member_php/confirm/user/$user_id/$token");

    }
    public function confirmed($id){
        $this->pdo->prepare('UPDATE users SET token = NULL, created_at = NOW(), confirmed = ?, confirmed_at=NOW() WHERE id=?')->execute([true, $id]);
    }
    public function check_users($name){
        $req = $this->pdo->prepare('SELECT * FROM users WHERE (username = :username OR email = :username) AND confirmed IS NOT NULL');
        $req->execute(['username' => $name]);
        $user = $req->fetch();
        return $user;
    }
    public function check_email_confirm($mail){
        $req = $this->pdo->prepare('SELECT * FROM users WHERE email = ? AND confirmed IS NOT NULL');
        $req->execute([$mail]);
        $user = $req->fetch();
        return $user;
    }
    public function forget($user){
        //create a token for reset password
        $reset = md5(time()*5);
        //update database
        $this->pdo->prepare('UPDATE users SET reset = ? WHERE id = ?')->execute([$reset, $user]);
        mail($_POST['email'], "Réinitialisation de votre mot de passe", "Afin de réinitialiser votre mot de passe merci de cliquer sur ce lien:\n\nhttp://localhost/tp_member_php/reset/user/$user/$reset");
    }
    public function check_reset($id, $token){
        $req = $this->pdo->prepare('SELECT * FROM users WHERE id = ? AND reset = ?');
        $req->execute([$id, $token]);
        $user = $req->fetch();
        return $user;
    }
    public function reset_password($password){
        $password = password_hash($password, PASSWORD_BCRYPT);
        $this->pdo->prepare('UPDATE users SET password = ?, reset = NULL')->execute([$password]);
    }
}