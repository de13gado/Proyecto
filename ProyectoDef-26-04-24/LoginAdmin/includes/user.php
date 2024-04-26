<?php

include_once 'db.php';

class User extends DB{

    private $nombre;
    private $username;

    public function userExists($user, $pass) {
        $query = $this->connect()->prepare('SELECT username, password FROM administradores WHERE username = :user');
        $query->execute(['user' => $user]);

        if ($query->rowCount() > 0) {
            $userData = $query->fetch();
            return password_verify($pass, $userData['password']);
        }

        return false;
    }

    public function setUser($user){
        $query = $this->connect()->prepare('SELECT * FROM administradores WHERE username = :user');
        $query->execute(['user' => $user]);

        foreach ($query as $currentUser) {
            $this->nombre = $currentUser['nombre'];
            $this->username = $currentUser['username'];
        }
    }

    public function getNombre(){
        return $this->nombre;
    }
}

?>
