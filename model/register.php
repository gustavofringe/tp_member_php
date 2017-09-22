<?php
class register extends model{
    public $pdo;
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
    public function regist($username, $email,$pass){
        $req = $this->pdo->prepare("INSERT INTO users SET username = ?, email = ?, password = ?, token = ?, created_at = NOW(), confirmed_at= ?");
        //hash password
        $password = password_hash($pass, PASSWORD_BCRYPT);
        //create token for verification
        $token = md5(time() * 5);
        //execute request
        $req->execute([$username, $email, $password, $token, false]);
        $user_id = $this->pdo->lastInsertId();
        mail($email, "Validation de votre compte", "Afin de valider votre compte merci de cliquer sur ce lien\n\nhttp://localhost/tp_member_php/confirm/$user_id/$token");

    }
    public function confirmed($id){
        $this->pdo->prepare('UPDATE users SET token = NULL, created_at = NOW(), confirmed = ?, confirmed_at=NOW() WHERE id=?')->execute([true, $id]);

    }
}