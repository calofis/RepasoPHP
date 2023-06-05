<?php

namespace Com\Daw2\Controllers;

class UsuarioSistemaController extends \Com\Daw2\Core\BaseController {
    
    public function signUp() {
        $data = array(
            'titulo' => 'Sign UP',
            'breadcrumb' => ['Inicio', 'signUp'],
            'seccion' => 'sign-up'
        );

        $modelRol = new \Com\Daw2\Models\RolesSistemaModel();
        $roles = $modelRol->obtenerRoles();
        $data['roles'] = $roles;
        $this->view->showViews(array('templates/header.view.php', 'signUp.view.php', 'templates/footer.view.php'), $data);
    }
    
    public function doSignUp() {
        $data = array(
            'titulo' => 'Sign UP',
            'breadcrumb' => ['Inicio', 'signUp'],
            'seccion' => 'sign-up'
        );
        $data['input'] = filter_var_array($_POST,FILTER_SANITIZE_SPECIAL_CHARS);
        
        $modelRol = new \Com\Daw2\Models\RolesSistemaModel();
        $roles = $modelRol->obtenerRoles();
        $data['roles'] = $roles;
        
        $valores = filter_var_array($_POST,FILTER_SANITIZE_SPECIAL_CHARS);
        unset($valores['enviar']);
        $errores = $this->checkValores($valores);
        if(empty($errores)){
            $modelUserSis = new \Com\Daw2\Models\UsuarioSisModel();
            unset($valores['password']);
            $valores['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $data['respuesta'] = $modelUserSis->createUser($valores);
        }
        $data['errores'] = $errores;
        $this->view->showViews(array('templates/header.view.php', 'signUp.view.php', 'templates/footer.view.php'), $data);
    }
    
    private function checkValores(array $valores){
        $modelUserSis = new \Com\Daw2\Models\UsuarioSisModel();
        $modelUsuario = new \Com\Daw2\Models\UsuariosModel();
        $errores = [];
        if(!preg_match('/^[a-zA-Z0-9]+[@][a-zA-Z0-9]+[.][a-zA-Z0-9]{3}$/',$valores['email'])){
            $errores['email'] = 'Este email no cumple la forma correcta.';
        }
        if($modelUserSis->existEmail($valores['email'])){
            $errores['email'] = 'Este email ya esta registrado en la web';
        }
        //if(!preg_match('/^([A-Z]+[a-z]+[0-9]+)\w+$/',$valores['password'])){
          //  $errores['password'] = 'La contraseña tiene que estar formada por la menos por una mayuscula, una minuscula y un numero';
        //}
        if(!preg_match('/^[a-zA-Z0-9]+$/',$valores['username'])){
            $errores['username'] = 'El nombre solo acepta letras y numeros y tiene que tener por lo menos un caracter';
        }
        if (!isset($valores['roles']) || (!is_numeric($valores['roles']) || !$modelUsuario->existRol($valores['roles']))) {
            $errores['roles'] = 'El rol introducido no se encuentra en la base de datos';
        }
        if($valores['idioma'] != 'es' && $valores['idioma'] != 'en'){
            $errores['idioma'] = 'El idioma introducido no es valido solo puedes introducir Español o Ingles';
        }
        
        return $errores;
    }
    
    public function login(){
        $this->view->showViews(array('login.view.php'));
    }
    
    public function doLogin(){
        $errores = $this->erroresLogin(filter_var_array($_POST,FILTER_SANITIZE_SPECIAL_CHARS));
        $data['loginError'] = $errores;
        
        if(empty($errores)){
            $modelUser = new \Com\Daw2\Models\UsuarioSisModel();
            $datosUser = $modelUser->login($_POST['email']);
            unset($datosUser['pass']);
            $_SESSION['usuario'] = $datosUser;
            $_SESSION['permisos'] = $this->permisos($datosUser['id_rol']);
            header('location: /');
        }
    }
    
    private function erroresLogin(array $login) : array{
        $modelUser = new \Com\Daw2\Models\UsuarioSisModel();
        $errores = [];
        $contra = $modelUser->obtenerContra($login['email']);
        if(!$modelUser->existEmail($login['email']) || !password_verify($login['pass'], $contra['pass'])){
            $errores = 'El email o la contraseña son incorrectos';
        }
        return $errores;
    }
    
    private function permisos(int $idrol) : string{
        $modelRol = new \Com\Daw2\Models\RolesSistemaModel();
        $rol = $modelRol->obtenerNombreRol($idrol);
        $permisos = '';
        if($rol == 'Administrador'){
            $permisos = 'rwd';
        }
        if($rol == 'Encargado'){
            $permisos = 'rw';
        }
        if($rol == 'Staff'){
            $permisos = 'r';
        }
        
        return $permisos;
    }
}