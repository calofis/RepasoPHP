<?php

namespace Com\Daw2\Controllers;

class InicioController extends \Com\Daw2\Core\BaseController {

    public function index() {
        $data = array(
            'titulo' => 'Página de inicio test',
            'breadcrumb' => ['Inicio']
        );   
        $data['myVar'] = 'Hola';
        $this->view->showViews(array('templates/header.view.php', 'inicio.view.php', 'templates/footer.view.php'), $data);
    }
    
    public function formulario() {
        $data = array(
            'titulo' => 'Formulario',
            'breadcrumb' => ['Inicio', 'Formulario']
        );   
        $data['myVar'] = 'Hola';
        $this->view->showViews(array('templates/header.view.php', 'formulario.view.php', 'templates/footer.view.php'), $data);
    }

}
