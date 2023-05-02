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

        $usuarios = $model->obtenerTodos();
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

        $usuarios = $modelUsuario->obtenerTodos();
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

        $data['input'] = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);

        $modelRol = new \Com\Daw2\Models\RolesModel();

        $roles = $modelRol->obtenerRoles();
        $data['roles'] = $roles;
        $data['roless'] = $_POST['roles'];
        
        $modelUsuario = new \Com\Daw2\Models\UsuariosModel();
        $retenciones = $modelUsuario->obtenerRetenciones();
        $data['retenciones'] = $retenciones;
        $data['retencioness'] = $_POST['retenciones'];
        
        $data['data'] = $modelUsuario->filtrar($_POST);

        $this->view->showViews(array('templates/header.view.php', 'roles.view.php', 'templates/footer.view.php'), $data);
    }

}
