<?php

namespace Com\Daw2\Controllers;

class UsuarioController extends \Com\Daw2\Core\BaseController {

    public function getAll() {
        $data = array(
            'titulo' => 'Usuarios',
            'breadcrumb' => ['Inicio', 'Usuarios'],
            'seccion' => 'todos_usuarios'
        );

        $model = new \Com\Daw2\Models\UsuariosModel();

        $usuarios = $model->obtenerTodos(0);
        $data['data'] = $usuarios;

        $this->view->showViews(array('templates/header.view.php', 'usuarios.view.php', 'templates/footer.view.php'), $data);
    }

    public function orderBy() {
        $data = array(
            'titulo' => 'Usuarios',
            'breadcrumb' => ['Inicio', 'Usuarios'],
            'seccion' => 'todos_usuarios_orderby'
        );

        $model = new \Com\Daw2\Models\UsuariosModel();

        $usuarios = $model->ordenarPorSalario();
        $data['data'] = $usuarios;

        $this->view->showViews(array('templates/header.view.php', 'usuarios.view.php', 'templates/footer.view.php'), $data);
    }

    public function standart() {
        $data = array(
            'titulo' => 'Usuarios',
            'breadcrumb' => ['Inicio', 'Usuarios'],
            'seccion' => 'todos_usuariosSTD'
        );

        $model = new \Com\Daw2\Models\UsuariosModel();

        $usuarios = $model->rolStandart();
        $data['data'] = $usuarios;

        $this->view->showViews(array('templates/header.view.php', 'usuarios.view.php', 'templates/footer.view.php'), $data);
    }

    public function carlos() {
        $data = array(
            'titulo' => 'Usuarios',
            'breadcrumb' => ['Inicio', 'Usuarios'],
            'seccion' => 'todos_carlos'
        );

        $model = new \Com\Daw2\Models\UsuariosModel();

        $usuarios = $model->nameCarlos();
        $data['data'] = $usuarios;

        $this->view->showViews(array('templates/header.view.php', 'usuarios.view.php', 'templates/footer.view.php'), $data);
    }

    public function roles() {
        $data = array(
            'titulo' => 'Roles',
            'breadcrumb' => ['Inicio', 'Roles'],
            'seccion' => 'roles'
        );

        $modelUsuario = new \Com\Daw2\Models\UsuariosModel();

        $usuarios = $modelUsuario->obtenerTodos(0);
        $retenciones = $modelUsuario->obtenerRetenciones();
        $data['data'] = $usuarios;
        $data['retenciones'] = $retenciones;

        $modelRol = new \Com\Daw2\Models\RolesModel();

        $roles = $modelRol->obtenerRoles();
        $data['roles'] = $roles;

        $this->view->showViews(array('templates/header.view.php', 'roles.view.php', 'templates/footer.view.php'), $data);
    }

    public function datosFiltros() {
        $data = array(
            'titulo' => 'Roles',
            'breadcrumb' => ['Inicio', 'Roles'],
            'seccion' => 'roles'
        );

        $data['input'] = filter_var_array($_GET, FILTER_SANITIZE_SPECIAL_CHARS);

        $modelRol = new \Com\Daw2\Models\RolesModel();

        $roles = $modelRol->obtenerRoles();
        $data['roles'] = $roles;
        if (isset($_GET['roles'])) {
            foreach ($_GET['roles'] as $clave => $valor){
                $data['roless'] = $valor;
            }
        }
        $modelUsuario = new \Com\Daw2\Models\UsuariosModel();
        $retenciones = $modelUsuario->obtenerRetenciones();
        $data['retenciones'] = $retenciones;
        if (isset($_GET['retenciones'])) {
            $data['retencioness'] = $_GET['retenciones'];
        }

        if ((isset($_GET['order']) && filter_var($_GET['order'], FILTER_VALIDATE_INT)) && ($_GET['order'] >= 1 && $_GET['order'] <= 4)) {
            $order = $_GET['order'];
        } else {
            $order = 1;
        }
        $data['order'] = $order;
        
        $pagina = 1;
        if(isset($_GET['page']) && filter_var($_GET['page'], FILTER_VALIDATE_INT) && $_GET['page'] > 1){
           $pagina = $_GET['page'];
        }
        
        $data['pagina'] = $pagina;
        $data['data'] = $modelUsuario->filtrarA($_GET, $order, $pagina);
        $data['final'] = $modelUsuario->obtenerCount($_GET, $order, $pagina);

        $copia = $_GET;
        unset($copia['page']);
        $data['filtroPaginado'] = count($copia) > 0 ? '&'.http_build_query($copia) : '';
        unset($copia['order']);
        $data['filtro'] = count($copia) > 0 ? '&'.http_build_query($copia) : '';

        $this->view->showViews(array('templates/header.view.php', 'roles.view.php', 'templates/footer.view.php'), $data);
    }
    
    public function delete(string $nombre){
        $modelUser = new \Com\Daw2\Models\UsuariosModel();
        $comprobacion = $modelUser->deleteUser($nombre);
        $copia = $_GET;
        unset($copia['order']);
        $order = $_GET['order'];
        if($comprobacion){
            header('Location: /roles?order='.$order.'&'.http_build_query($copia));
        }
    }
    
    public function agregar(){
         $data = array(
            'titulo' => 'Roles',
            'breadcrumb' => ['Inicio', 'Roles'],
            'seccion' => 'roles'
        );
        $data['input'] = filter_var_array($_GET, FILTER_SANITIZE_SPECIAL_CHARS);
        
        $modelRol = new \Com\Daw2\Models\RolesModel();
        $roles = $modelRol->obtenerRoles();
        $rolesAux = [];
        foreach ($roles as $rol){
            $rolesAux[$rol['id_rol']] = '';
        }
        $data['roles'] = $roles;
        
        
        $modelUsuario = new \Com\Daw2\Models\UsuariosModel();
        $retenciones = $modelUsuario->obtenerRetenciones();
        $retencionesAux = [];
        foreach ($retenciones as $retencion){
            $retencionesAux[$retencion['retencionIRPF']] = '';
        }
        $data['retenciones'] = $retenciones;
        
        
        $usernamesAux = $modelUsuario->getAllUsername();
        $usernames = [];
        foreach ($usernamesAux as $username => $name){
            $usernames[$name['username']] = '';
        }
        var_dump($_GET);
        if(!empty($_GET)){
            $errores = $this->checkValores($_GET, $usernames, $retencionesAux, $rolesAux);
            $data['errores'] = $errores;
        }
        $copia = $_GET;
        unset($copia['enviar']);
        unset($copia['activo']);
        if(empty($errores) && !empty($copia)){
            $data['respuesta'] = $modelUsuario->createUser($copia);
        }
        
        $this->view->showViews(array('templates/header.view.php', 'createUsuario.view.php', 'templates/footer.view.php'), $data);
    }
    
    private function checkValores(array $valores, array $nombres, array $retenciones, array $roles) : array{
        $errores = [];
        if(!isset($valores['username']) || isset($nombres[$valores['username']])){
            $errores['username'] = 'El Nombre del usuario ya existe en la base de datos';
        }
        if(empty($valores['username'])){
            $errores['username'] = 'El nombre no puede estar en blanco';
        }
        if(!isset($valores['salario']) || (!is_numeric($valores['salario']) || $valores['salario'] < 0)){
            $errores['salario'] = 'El salario tiene que ser un numero y estar en 0 o mas';
        }
        if(!isset($valores['retenciones']) || (!is_numeric($valores['retenciones']) ||  !isset($retenciones[$valores['retenciones']]))){
            $errores['retenciones'] = 'La retencion introducida no coincide con las registradas en las bases de datos';
        }
        //if(!isset($valores['activo']) || (!is_int($valores['activo']) || $valores['activo'] !== 1 || $valores['activo'] !== 0)){
            //$errores['activo'] = 'El valor de activo recibido no corresponde';
        //}
        if(!isset($valores['roles']) || (!is_numeric($valores['roles']) ||  !isset($roles[$valores['roles']]))){
            $errores['roles'] = 'El rol introducido no se encuntra en la base de datos';
        }
        
        return $errores;
    }

}
