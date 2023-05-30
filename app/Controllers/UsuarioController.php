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
    
    public function formularioAlta(){
        $data = array(
            'titulo' => 'Roles',
            'breadcrumb' => ['Inicio', 'Roles'],
            'seccion' => 'roles'
        );
        
        $modelRol = new \Com\Daw2\Models\RolesModel();
        $roles = $modelRol->obtenerRoles();
        $data['roles'] = $roles;
        
        $modelUsuario = new \Com\Daw2\Models\UsuariosModel();
        $retenciones = $modelUsuario->obtenerRetenciones();
        $data['retenciones'] = $retenciones;
        
        $data['url'] = "/usuarios/new";
        $this->view->showViews(array('templates/header.view.php', 'userManagement.view.php', 'templates/footer.view.php'), $data);
    }
    public function agregar(){
         $data = array(
            'titulo' => 'Roles',
            'breadcrumb' => ['Inicio', 'Roles'],
            'seccion' => 'roles'
        );
        $data['input'] = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
        $modelRol = new \Com\Daw2\Models\RolesModel();
        $roles = $modelRol->obtenerRoles();
        $data['roles'] = $roles;
        
        
        $modelUsuario = new \Com\Daw2\Models\UsuariosModel();
        $retenciones = $modelUsuario->obtenerRetenciones();
        $data['retenciones'] = $retenciones;
        
        
        $copia = $_POST;
        unset($copia['enviar']);
        unset($copia['activo']);
        $copia['activo'] = isset($_POST['activo']) ? 1 : 0;
        if(!empty($copia)){
            $nuevo = true;
            $errores = $this->checkValoresCrear($copia, $nuevo);
            $data['errores'] = $errores;
        }
        if(empty($errores) && !empty($copia)){
            $modelUsuario->createUser($copia);
            header('Location: /roles');
        }
        $data['url'] = "/usuarios/new";
        $this->view->showViews(array('templates/header.view.php', 'userManagement.view.php', 'templates/footer.view.php'), $data);
    }
     public function modificar(string $nombre){
         $modelUsuario = new \Com\Daw2\Models\UsuariosModel();
         
         
         $modelRol = new \Com\Daw2\Models\RolesModel();
         $roles = $modelRol->obtenerRoles();
         $data['roles'] = $roles;
          
         
         
         $retenciones = $modelUsuario->obtenerRetenciones();
         $data['retenciones'] = $retenciones;
          
         
         $datos = $modelUsuario->obtenerDatosUsuario($nombre);
         $data['input'] = $datos;
         $data['url'] = "/usuarios/edit/".$datos['username'];
         $data['modificando'] = true;
         $this->view->showViews(array('templates/header.view.php', 'userManagement.view.php', 'templates/footer.view.php'), $data);
     }
     
     public function modificarA(string $nombre){
         $data = array(
            'titulo' => 'Roles',
            'breadcrumb' => ['Inicio', 'Roles'],
            'seccion' => 'roles'
        ); 
         
        $data['input'] = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
        
        $modelRol = new \Com\Daw2\Models\RolesModel();
        $roles = $modelRol->obtenerRoles();
        $data['roles'] = $roles;
        
        
        $modelUsuario = new \Com\Daw2\Models\UsuariosModel();
        $retenciones = $modelUsuario->obtenerRetenciones();
        $data['retenciones'] = $retenciones;
        
        $datos = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS); 
        $datos['username'] = $nombre;
        unset($datos['enviar']);
        unset($datos['activo']);     
        $datos['activo'] = isset($_POST['activo']) ? 1 : 0;
        if(!empty($datos)){
            $nuevo = false;
            $errores = $this->checkValoresCrear($datos, $nuevo);
            $data['errores'] = $errores;
        }
        
        if(empty($errores)){
             $modelUsuario->modificar($datos);
             header('Location: /roles');
        }
        $data['modificando'] = true;
        $data['url'] = "/usuarios/edit/".$datos['username'];
        $this->view->showViews(array('templates/header.view.php', 'userManagement.view.php', 'templates/footer.view.php'), $data); 
     }
    private function checkValoresCrear(array $valores, bool $nuevo) : array{
        $errores = [];
        $modelUsuario = new \Com\Daw2\Models\UsuariosModel();
        if(!isset($valores['username']) || $nuevo && $modelUsuario->existUsername($valores['username'])){
            $errores['username'] = 'El Nombre del usuario ya existe en la base de datos';
        }
        if(empty($valores['username'])){
            $errores['username'] = 'El nombre no puede estar en blanco';
        }
        if(!isset($valores['salario']) || (!is_numeric($valores['salario']) || $valores['salario'] < 0)){
            $errores['salario'] = 'El salario tiene que ser un numero y estar en 0 o mas';
        }
        if(!isset($valores['retenciones']) || (!is_numeric($valores['retenciones']) ||  !$modelUsuario->existRetencion($valores['retenciones']))){
            $errores['retenciones'] = 'La retencion introducida no coincide con las registradas en las bases de datos';
        }  
        if(!isset($valores['roles']) || (!is_numeric($valores['roles']) ||  !$modelUsuario->existRol($valores['roles']))){
            $errores['roles'] = 'El rol introducido no se encuntra en la base de datos';
        }
        
        return $errores;
    }
}
