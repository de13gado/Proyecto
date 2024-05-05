<?php

include_once 'db.php';

class User extends DB{

    private $nombre;
    private $username;

    public function userExists($user, $pass) {
        // Utilizamos una consulta preparada con marcadores de posición para evitar inyecciones SQL
        $query = $this->connect()->prepare('SELECT username, password FROM administradores WHERE username = :user');
        // Vinculamos el parámetro :user con el valor de $user
        $query->bindParam(':user', $user);
        $query->execute();

        if ($query->rowCount() > 0) {
            $userData = $query->fetch();
            return password_verify($pass, $userData['password']);
        }

        return false;
    }

    public function setUser($user){
        // Utilizamos una consulta preparada para evitar inyecciones SQL
        $query = $this->connect()->prepare('SELECT * FROM administradores WHERE username = :user');
        // Vinculamos el parámetro :user con el valor de $user
        $query->bindParam(':user', $user);
        $query->execute();

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
