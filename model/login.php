<?php
class login extends model{
    public $pdo;
    public function check_users($name){
        $req = $this->pdo->prepare('SELECT * FROM users WHERE (username = :username OR email = :username) AND confirmed IS NOT NULL');
        $req->execute(['username' => $name]);
        $user = $req->fetch();
        return $user;
    }
}