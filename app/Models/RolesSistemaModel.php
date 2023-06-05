<?php

namespace Com\Daw2\Models;

use \PDO;

class RolesSistemaModel extends \Com\Daw2\Core\BaseModel{
    
    public function obtenerRoles(){
        $stmt = $this->pdo->query('SELECT id_rol, rol as nombre_rol FROM rol');
        return $stmt->fetchAll();
    }
    
    public function obtenerNombreRol(int $idrol){
        $stmt = $this->pdo->prepare('SELECT rol as nombre_rol FROM rol WHERE id_rol = ?');
        $stmt->execute([$idrol]);
        return $stmt->fetch();
    }
}