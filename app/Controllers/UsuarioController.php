<?php

namespace Com\Daw2\Controllers;

class UsuarioController extends \Com\Daw2\Core\BaseController {
    
    public function getAll(){
       $data = array(
            'titulo' => 'Usuarios',
            'breadcrumb' => ['Inicio', 'Usuarios'],
           'section' => 'todos_usuarios'
        );
       
       $model = new \Com\Daw2\Models\UsuariosModel();
       
       $usuarios = $model->obtenerTodos();
       $data['data'] = $usuarios;
       
       $this->view->showViews(array('templates/header.view.php', 'usuarios.view.php', 'templates/footer.view.php'), $data);
    }
    
    public function orderBy(){
       $data = array(
            'titulo' => 'Usuarios',
            'breadcrumb' => ['Inicio', 'Usuarios'],
           'section' => 'todos_usuarios_orderby'
        );
       
       $model = new \Com\Daw2\Models\UsuariosModel();
       
       $usuarios = $model->ordenarPorSalario();
       $data['data'] = $usuarios;
       
       $this->view->showViews(array('templates/header.view.php', 'usuarios.view.php', 'templates/footer.view.php'), $data);
    }
    
    public function standart(){
       $data = array(
            'titulo' => 'Usuarios',
            'breadcrumb' => ['Inicio', 'Usuarios'],
           'section' => 'todos_usuariosSTD'
        );
       
       $model = new \Com\Daw2\Models\UsuariosModel();
       
       $usuarios = $model->rolStandart();
       $data['data'] = $usuarios;
       
       $this->view->showViews(array('templates/header.view.php', 'usuarios.view.php', 'templates/footer.view.php'), $data);
    }
    public function carlos(){
       $data = array(
            'titulo' => 'Usuarios',
            'breadcrumb' => ['Inicio', 'Usuarios'],
           'section' => 'todos_carlos'
        );
       
       $model = new \Com\Daw2\Models\UsuariosModel();
       
       $usuarios = $model->nameCarlos();
       $data['data'] = $usuarios;
       
       $this->view->showViews(array('templates/header.view.php', 'usuarios.view.php', 'templates/footer.view.php'), $data);
    }
    
    public function roles(){
       $data = array(
            'titulo' => 'Roles',
            'breadcrumb' => ['Inicio', 'Roles'],
           'section' => 'filtro_roles'
        );
       
       $modelUsuario = new \Com\Daw2\Models\UsuariosModel();
       
       $usuarios = $modelUsuario->obtenerTodos();
       $data['data'] = $usuarios;
       
       $modelRol = new \Com\Daw2\Models\RolesModel();
       
       $roles = $modelRol->obtenerRoles();
       $data['roles'] = $roles;
       
       $this->view->showViews(array('templates/header.view.php', 'roles.view.php', 'templates/footer.view.php'), $data);
    }
    
    public function datosFiltros(){
       $data = array(
            'titulo' => 'Roles',
            'breadcrumb' => ['Inicio', 'Roles'],
           'section' => 'filtro_roles'
        );
       
       $data['input'] = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
       
       $modelRol = new \Com\Daw2\Models\RolesModel();
       
       $roles = $modelRol->obtenerRoles();
       $data['roles'] = $roles;
       
       $modelUser = new \Com\Daw2\Models\UsuariosModel();
       
       if(filter_var($_POST['filtros'], FILTER_VALIDATE_INT) && (int)$_POST['filtros'] > 0){
           $datos = $modelUser->getDatosRol((int)$_POST['filtros']);
           $data['data'] = $datos;
           $data['roless'] = $_POST['filtros'];
       }else{
           if(strlen($_POST['username']) > 0){
               $datos = $modelUser->getDatosUsername((string)$_POST['username']);
               $data['data'] = $datos;
           }else if((filter_var($_POST['minimoSalario'], FILTER_VALIDATE_INT) && (int)$_POST['minimoSalario'] > 0) && (filter_var($_POST['maximoSalario'], FILTER_VALIDATE_INT) && (int)$_POST['maximoSalario'] > 0)){
               $datos = $modelUser->getDatosSalario((int)$_POST['minimoSalario'], (int)$_POST['maximoSalario']);
               $data['data'] = $datos;
           }else{
               $model = new \Com\Daw2\Models\UsuariosModel();
       
               $usuarios = $model->obtenerTodos();
               $data['data'] = $usuarios;
           }
           
       }
       
       
       $this->view->showViews(array('templates/header.view.php', 'roles.view.php', 'templates/footer.view.php'), $data);
    }
}

