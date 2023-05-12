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
        $data['data'] = $modelUsuario->filtrar($_GET, $order, $pagina);

        $copia = $_GET;
        unset($copia['order']);
        unset($copia['page']);
        $data['filtro'] = count($copia) > 0 ? '&'.http_build_query($copia) : '';
    
        $this->view->showViews(array('templates/header.view.php', 'roles.view.php', 'templates/footer.view.php'), $data);
    }

}
