<?php

namespace Com\Daw2\Models;

use \PDO;

class UsuariosModel extends \Com\Daw2\Core\BaseModel {

    private const POSICIONES = ['username', 'salarioBruto', 'retencionIRPF', 'aux_rol.nombre_rol'];
    private const SELECT_FROM = 'SELECT usuario.*, aux_rol.nombre_rol FROM usuario LEFT JOIN aux_rol ON aux_rol.id_rol = usuario.id_rol';

    public function obtenerTodos(int $posicion = 1, int $inicio = 1): array {
        $stmt = $this->pdo->query(self::SELECT_FROM . ' ORDER BY ' . self::POSICIONES[$posicion - 1].' LIMIT '.$this->calcularNumPag($inicio).',20');
        return $stmt->fetchAll();
    }

    public function obtenerRetenciones(): array {
        $stmt = $this->pdo->query('SELECT DISTINCT usuario.retencionIRPF FROM usuario');
        return $stmt->fetchAll();
    }

    public function ordenarPorSalario(): array {
        $stmt = $this->pdo->query(self::SELECT_FROM . ' ORDER BY salarioBruto DESC');
        return $stmt->fetchAll();
    }

    public function rolStandart(): array {
        $stmt = $this->pdo->query(self::SELECT_FROM . ' WHERE nombre_rol="standard";');
        return $stmt->fetchAll();
    }

    public function nameCarlos(): array {
        $stmt = $this->pdo->query(self::SELECT_FROM . ' WHERE username REGEXP "^Carlos*"');
        return $stmt->fetchAll();
    }

    public function getDatosRol(int $id_rol): array {
        $stmt = $this->pdo->prepare(self::SELECT_FROM . ' WHERE aux_rol.id_rol= ?');
        $stmt->execute([$id_rol]);
        return $stmt->fetchAll();
    }

    public function getDatosUsername(string $username): array {
        $stmt = $this->pdo->prepare(self::SELECT_FROM . ' WHERE username = ?');
        $stmt->execute([$username]);
        return $stmt->fetchAll();
    }

    public function getDatosSalario(int $salrioBajo, int $salarioAlto): array {
        $stmt = $this->pdo->prepare(self::SELECT_FROM . ' WHERE  salarioBruto BETWEEN ? AND ? ORDER BY salarioBruto DESC');
        $stmt->execute([$salrioBajo, $salarioAlto]);
        return $stmt->fetchAll();
    }

    public function getDatosRetenciones(int $retencion): array {
        $stmt = $this->pdo->prepare(self::SELECT_FROM . ' WHERE retencionIRPF = ?');
        $stmt->execute([$retencion]);
        return $stmt->fetchAll();
    }

    public function filtrarA(array $filtros, int $posicion = 1, int $pagina): array {
        $datosConsulta = $this->filtrar($filtros);
        $filtro = implode(' AND ', $datosConsulta[0]);
        if(empty($filtro)){
          $stmt = $this->pdo->query(self::SELECT_FROM . ' ORDER BY ' . self::POSICIONES[$posicion - 1].' LIMIT '.$this->calcularNumPag($pagina).',20');
        }else{
          $stmt = $this->pdo->prepare(self::SELECT_FROM . ' WHERE ' . $filtro . ' ORDER BY ' . self::POSICIONES[$posicion - 1].' LIMIT '.$this->calcularNumPag($pagina).',20');
        }
        $stmt->execute($datosConsulta[1]);
        return $stmt->fetchAll();
    }

    private function filtrar(array $filtros): array {
        $where = [];
        $var = [];
        if (isset($filtros['roles']) && (array) count($filtros['roles']) > 0 && filter_var_array($filtros['roles'], FILTER_VALIDATE_INT) !== false) {
            if (count($filtros['roles']) > 0) {
                $i = 0;
                foreach ($filtros['roles'] as $clave => $rol) {
                    $var[':id_rol' . $i] = $rol;
                    $i++;
                }
                $roles = implode(',', array_keys($var));
                $where[] = 'aux_rol.id_rol IN (' . $roles . ')';
            }
        }
        if (isset($filtros['username']) && strlen($filtros['username']) > 0) {
            $where[] = 'username LIKE :username';
            $searchString = "%$filtros[username]%";
            $var['username'] = $searchString;
        }
        if (isset($filtros['minimoSalario']) && is_numeric($filtros['minimoSalario']) && (float) $filtros['minimoSalario'] > 0) {
            $where[] = ' salarioBruto >= :min';
            $var['min'] = $filtros['minimoSalario'];
        }
        if (isset($filtros['maximoSalario']) && is_numeric($filtros['maximoSalario']) && (float) $filtros['maximoSalario'] > 0) {
            $where[] = ' salarioBruto <= :max';
            $var['max'] = $filtros['maximoSalario'];
        }
        if (isset($filtros['retenciones']) && filter_var($filtros['retenciones'], FILTER_VALIDATE_FLOAT) && $filtros['retenciones'] > 0) {
            $where[] = 'retencionIRPF = :retenciones';
            $var['retenciones'] = $filtros['retenciones'];
        }
       return [$where, $var]; 
    }
    
    private function calcularNumPag(int $pagina) : int{
        $inicio = ($pagina -1) * 20;
        return $inicio;
    }

}
