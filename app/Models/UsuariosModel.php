<?php

namespace Com\Daw2\Models;

use \PDO;

class UsuariosModel extends \Com\Daw2\Core\BaseModel{
    
    private const SELECT_FROM = 'SELECT usuario.*, aux_rol.nombre_rol FROM usuario LEFT JOIN aux_rol ON aux_rol.id_rol = usuario.id_rol';
    
    public function obtenerTodos() : array{
        $stmt = $this->pdo->query(self::SELECT_FROM);
        return $stmt->fetchAll();
    }
    
    public function obtenerRetenciones() : array{
        $stmt = $this->pdo->query('SELECT DISTINCT usuario.retencionIRPF FROM usuario');
        return $stmt->fetchAll();
    }
    
    public function ordenarPorSalario() : array{
        $stmt = $this->pdo->query(self::SELECT_FROM.' ORDER BY salarioBruto DESC');
        return $stmt->fetchAll();
    }
    
    public function rolStandart() : array{
        $stmt = $this->pdo->query(self::SELECT_FROM.' WHERE nombre_rol="standard";');
        return $stmt->fetchAll();
    }
    
    public function nameCarlos() : array{
        $stmt = $this->pdo->query(self::SELECT_FROM.' WHERE username REGEXP "^Carlos*"');
        return $stmt->fetchAll();
    }
    
    public function getDatosRol(int $id_rol) : array{
         $stmt = $this->pdo->prepare(self::SELECT_FROM.' WHERE aux_rol.id_rol= ?');
         $stmt->execute([$id_rol]);
         return $stmt->fetchAll();
    }
    
    public function getDatosUsername(string $username) : array{
         $stmt = $this->pdo->prepare(self::SELECT_FROM.' WHERE username = ?');
         $stmt->execute([$username]);
         return $stmt->fetchAll();
    }
    public function getDatosSalario(int $salrioBajo, int $salarioAlto) : array{
         $stmt = $this->pdo->prepare(self::SELECT_FROM.' WHERE  salarioBruto BETWEEN ? AND ? ORDER BY salarioBruto DESC');
         $stmt->execute([$salrioBajo, $salarioAlto]);
         return $stmt->fetchAll();
    }
     public function getDatosRetenciones(int $retencion) : array{
         $stmt = $this->pdo->prepare(self::SELECT_FROM.' WHERE retencionIRPF = ?');
         $stmt->execute([$retencion]);
         return $stmt->fetchAll();
    }
    
    public function filtrarA(array $filtros, array $var) : array{
         $filtro = implode(' AND ', $filtros);
         $stmt = $this->pdo->prepare(self::SELECT_FROM.' WHERE '.$filtro.' ORDER BY salarioBruto DESC');
         $stmt->execute($var);
         return $stmt->fetchAll();
    }
    
    public function filtrar(array $filtros) : array{
        $where = [];
        $var = [];
        if (filter_var($filtros['roles'], FILTER_VALIDATE_INT) && (int) $filtros['roles'] > 0) {
            $where[] = 'aux_rol.id_rol= :id_rol';
            $var['id_rol'] = $filtros['roles'];
        }
        if (strlen($filtros['username']) > 0) {
            $where[] = 'username = :username';
            $var['username'] = $filtros['username'];
        }
        if (is_numeric($filtros['minimoSalario']) && (float) $filtros['minimoSalario'] > 0) {
            $where[] = ' salarioBruto >= :min';
            $var['min'] = $filtros['minimoSalario'];
        }
        if (is_numeric($filtros['maximoSalario']) && (float) $filtros['maximoSalario'] > 0) {
            $where[] = ' salarioBruto <= :max';
            $var['max'] = $filtros['maximoSalario'];
        }
        if (filter_var($filtros['retenciones'], FILTER_VALIDATE_FLOAT) && $filtros['retenciones'] > 0) {
            $where[] = 'retencionIRPF = :retenciones';
            $var['retenciones'] = $filtros['retenciones'];
        }
        if (empty($where)) {
            return $this->obtenerTodos();
        }else{
            return $this->filtrarA($where, $var);
        }
    }
}