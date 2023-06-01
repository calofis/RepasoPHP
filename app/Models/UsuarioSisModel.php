<?php

namespace Com\Daw2\Models;

use \PDO;

class UsuarioSisModel extends \Com\Daw2\Core\BaseModel {
 
    public function existEmail(string $email){
        $stmt = $this->pdo->prepare('SELECT * FROM usuario_sistema WHERE email LIKE ?');
        $stmt->execute([$email]);
        return $stmt->rowCount() > 0;
    }
    
    public function createUser(array $valores) : bool{
        $stmt = $this->pdo->prepare('INSERT INTO usuario_sistema(id_rol, email, pass, nombre, idioma) VALUES (:roles, :email, :password, :username, :idioma)');
        $stmt->execute($valores);
        return $stmt->rowCount() > 0;
    }
}