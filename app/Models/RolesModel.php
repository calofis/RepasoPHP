<?php

namespace Com\Daw2\Models;

use \PDO;

class RolesModel extends \Com\Daw2\Core\BaseModel{
    
    public function obtenerRoles(){
        $stmt = $this->pdo->query('SELECT * FROM aux_rol');
        return $stmt->fetchAll();
    }
}

