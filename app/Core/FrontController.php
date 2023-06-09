<?php

namespace Com\Daw2\Core;

use Steampixel\Route;

class FrontController {

    static function main() {
        session_start();
        if (!isset($_SESSION['usuario'])) {
            Route::add('/login',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\UsuarioSistemaController();
                        $controlador->login();
                    }
                    , 'get');
            Route::add('/login',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\UsuarioSistemaController();
                        $controlador->doLogin();
                    }
                    , 'post');

            Route::pathNotFound(
                    function () {
                        header('location: /login');
                    }
                    , 'get');

        } else {
            Route::add('/',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\InicioController();
                        $controlador->index();
                    }
                    , 'get');

            Route::add('/formulario',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\InicioController();
                        $controlador->formulario();
                    }
                    , 'get');

            Route::add('/factorial',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\EjerciciosController();
                        $controlador->factorial();
                    }
                    , 'get');

            Route::add('/factorial',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\EjerciciosController();
                        $controlador->doFactorial();
                    }
                    , 'post');

            Route::add('/multiplicar',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\EjerciciosController();
                        $controlador->multiplicar();
                    }
                    , 'get');

            Route::add('/multiplicar',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\EjerciciosController();
                        $controlador->doMultiplicar();
                    }
                    , 'post');

            Route::add('/primos',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\EjerciciosController();
                        $controlador->primos();
                    }
                    , 'get');

            Route::add('/primos',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\EjerciciosController();
                        $controlador->doPrimos();
                    }
                    , 'post');

            Route::add('/mayorMenor',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\EjerciciosController();
                        $controlador->mayorMenor();
                    }
                    , 'get');

            Route::add('/mayorMenor',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\EjerciciosController();
                        $controlador->domayorMenor();
                    }
                    , 'post');

            Route::add('/ordenar',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\EjerciciosController();
                        $controlador->ordenar();
                    }
                    , 'get');

            Route::add('/ordenar',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\EjerciciosController();
                        $controlador->doOrdenar();
                    }
                    , 'post');
            Route::add('/bd',
                    function () {
                        $controlador = new \Com\Daw2\Models\UsuariosModel();
                        $controlador->conectar();
                    }
                    , 'get');

            Route::add('/conectar',
                    function () {
                        $model = new \Com\Daw2\Models\UsuariosModel();
                        $model->conectar();
                    }
                    , 'get');

            Route::add('/usuarios',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\UsuarioController();
                        $controlador->getAll();
                    }
                    , 'get');
            Route::add('/salarios',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\UsuarioController();
                        $controlador->orderBy();
                    }
                    , 'get');
            Route::add('/usuariosSTD',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\UsuarioController();
                        $controlador->standart();
                    }
                    , 'get');
            Route::add('/carlos',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\UsuarioController();
                        $controlador->carlos();
                    }
                    , 'get');
            Route::add('/roles',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\UsuarioController();
                        $controlador->datosFiltros();
                    }
                    , 'get');
            Route::add('/roles',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\UsuarioController();
                        $controlador->datosFiltros();
                    }
                    , 'post');
            Route::add('/usuarios/delete/([a-zA-Z0-9\_]*)',
                    function ($nombre) {
                        $controlador = new \Com\Daw2\Controllers\UsuarioController();
                        $controlador->delete($nombre);
                    }
                    , 'get');
            Route::add('/usuarios/new',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\UsuarioController();
                        $controlador->agregar();
                    }
                    , 'post');

            Route::add('/usuarios/new',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\UsuarioController();
                        $controlador->formularioAlta();
                    }
                    , 'get');

            Route::add('/usuarios/edit/([a-zA-Z0-9\_]*)',
                    function ($nombre) {
                        $controlador = new \Com\Daw2\Controllers\UsuarioController();
                        $controlador->modificar($nombre);
                    }
                    , 'get');
            Route::add('/usuarios/edit/([a-zA-Z0-9\_]*)',
                    function ($nombre) {
                        $controlador = new \Com\Daw2\Controllers\UsuarioController();
                        $controlador->modificarA($nombre);
                    }
                    , 'post');
            Route::add('/pruebaCookies',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\EjerciciosController();
                        $controlador->cookies();
                    }
                    , 'get');
            Route::add('/pruebaCookies',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\EjerciciosController();
                        $controlador->doCookies();
                    }
                    , 'post');
            Route::add('/signUp',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\UsuarioSistemaController();
                        $controlador->signUp();
                    }
                    , 'get');
            Route::add('/signUp',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\UsuarioSistemaController();
                        $controlador->doSignUp();
                    }
                    , 'post');
            Route::pathNotFound(
                    function () {
                        $controller = new \Com\Daw2\Controllers\ErroresController();
                        $controller->error404();
                    }
            );

            Route::methodNotAllowed(
                    function () {
                        $controller = new \Com\Daw2\Controllers\ErroresController();
                        $controller->error405();
                    }
            );            
        }
        Route::run();
    }

}
