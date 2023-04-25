<?php

namespace Com\Daw2\Controllers;

class EjerciciosController extends \Com\Daw2\Core\BaseController {

    public function factorial() {
        $data = array(
            'titulo' => 'Factorial',
            'breadcrumb' => ['Inicio', 'Factorial']
        );           
        $this->view->showViews(array('templates/header.view.php', 'factorial.view.php', 'templates/footer.view.php'), $data);
    }    
    
    public function doFactorial() {
        $data = array(
            'titulo' => 'Factorial',
            'breadcrumb' => ['Inicio', 'Factorial']
        ); 
        
        $errores = $this->checkFormFactorial($_POST);
        $data['errores'] = $errores;
        
        $data['input'] = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
        
        if(count($errores) == 0){
            $resultado = $this->calcularFactorial($_POST['numero']);
            $data['resultado'] = $resultado;
        }
        
        $this->view->showViews(array('templates/header.view.php', 'factorial.view.php', 'templates/footer.view.php'), $data);
    }  
    
    private function calcularFactorial(int $num) : int{
        $resultado = 1;
        for($i = $num; $i > 0; $i--){
            $resultado *= $i;
        }
        return $resultado;
    }
    
    private function checkFormFactorial(array $data) : array{
        $errores = [];
        if(filter_var($data['numero'], FILTER_VALIDATE_INT)){
            if($data['numero'] < 1 || $data['numero'] > 20){
                $errores['numero'] = 'El numero debe estar comprendido entre 1 y 20.';
            }
        }
        else{
            $errores['numero'] = 'No es un número';
        }
        return $errores;
    }
    //_--------------------------------Multiplicar--------------------------------------//
    public function multiplicar() {
        $data = array(
            'titulo' => 'Multiplicar',
            'breadcrumb' => ['Inicio', 'Multiplicar']
        );           
        $this->view->showViews(array('templates/header.view.php', 'multiplicar.view.php', 'templates/footer.view.php'), $data);
    }    
    
    public function doMultiplicar() {
        $data = array(
            'titulo' => 'Multiplicar',
            'breadcrumb' => ['Inicio', 'Multiplicar']
        ); 
        
        $errores = $this->checkFormMultiplicar($_POST);
        $data['errores'] = $errores;
        
        $data['input'] = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
        
        if(count($errores) == 0){
            $resultado = $this->multiplicacion($_POST['numero1'], $_POST['numero2']);
            $data['resultado'] = $resultado;
        }
        
        $this->view->showViews(array('templates/header.view.php', 'multiplicar.view.php', 'templates/footer.view.php'), $data);
    }
    
    private function checkFormMultiplicar(array $data) : array{
        $errores = [];
        if(!filter_var($data['numero1'], FILTER_VALIDATE_INT)){
            $errores['numero1'] = 'No es un número';
        }
        if(!filter_var($data['numero2'], FILTER_VALIDATE_INT)){
            $errores['numero2'] = 'No es un número';
        }
        return $errores;
    }
    
    private function multiplicacion(int $numero1, int $numero2) : int{
        return $numero1 * $numero2;
    }
    
    //_--------------------------------Primos--------------------------------------//
    public function primos() {
        $data = array(
            'titulo' => 'Primos',
            'breadcrumb' => ['Inicio', 'Primos']
        );           
        $this->view->showViews(array('templates/header.view.php', 'primos.view.php', 'templates/footer.view.php'), $data);
    }    
    
    public function doPrimos() {
        $data = array(
            'titulo' => 'Primos',
            'breadcrumb' => ['Inicio', 'Primos']
        ); 
        
        $errores = $this->checkFormPrimos($_POST);
        $data['errores'] = $errores;
        
        $data['input'] = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
        
        if(count($errores) == 0){
            $resultado = $this->esPrimo($_POST['numero']);
            $data['resultado'] = $resultado;
        }
        
        $this->view->showViews(array('templates/header.view.php', 'primos.view.php', 'templates/footer.view.php'), $data);
    }
    
    private function checkFormPrimos(array $data) : array{
        $errores = [];
        if(!filter_var($data['numero'], FILTER_VALIDATE_INT)){
            $errores['numero'] = 'No es un número';
        }else if($data['numero'] <= 0){
            $errores['numero'] = 'El numero tiene que ser mayor que cero';
        }
        return $errores;
    }
    
    private function esPrimo(int $numero) : bool{
        for($i = 2; $i < $numero; $i++){
            if($numero % $i == 0){
                return false;
            }
        } 
        return true;
    }
    //_--------------------------------Ejercicios estructuras iterativas--------------------------------------//
    //_------Ejercicio 1-------//
    
    public function mayorMenor() {
        $data = array(
            'titulo' => 'Mayor-Menor',
            'breadcrumb' => ['Inicio', 'Mayor-Menor']
        );           
        $this->view->showViews(array('templates/header.view.php', 'mayorMenor.view.php', 'templates/footer.view.php'), $data);
    }    
    
    public function domayorMenor() {
        $data = array(
            'titulo' => 'Mayor-Menor',
            'breadcrumb' => ['Inicio', 'Mayor-Menor']
        ); 
        
        $errores = $this->checkFormMayoMenor($_POST);
        $data['errores'] = $errores;
        
        $data['input'] = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
        
        if(count($errores) == 0){
            $resultado = $this->comprobacion($_POST['numero']);
            $data['resultado'] = $resultado;
        }
        
        $this->view->showViews(array('templates/header.view.php', 'mayorMenor.view.php', 'templates/footer.view.php'), $data);
    }
    
    private function checkFormMayoMenor(array $data) : array{
        $errores = [];
        
        $numeros = explode(",", $data['numero']);
        $filtrado = filter_var_array($numeros, FILTER_VALIDATE_INT);
        
        foreach ($filtrado as $numero){
            if($numero == false){
                $errores['numero'] = 'La cadena introducida tiene caracteres no numericos';
            }
        } 
        return $errores;
    }
    
    private function comprobacion(string $numerosNa) : array{
        $resultado = [];
        
        $numeros = explode(",", $numerosNa);
        
        foreach ($numeros as $numero){
            if(!isset($resultado['mayor'])){
                $resultado['mayor'] = $numero;
            }else if($resultado['mayor'] < $numero){
                 $resultado['mayor'] = $numero;
            }
            
            if(!isset($resultado['menor'])){
                $resultado['menor'] = $numero;
            }else if($resultado['menor'] > $numero){
                 $resultado['menor'] = $numero;
            }
        }
        return $resultado;
    }

    //_------Ejercicio 2-------//
    
    public function ordenar() {
        $data = array(
            'titulo' => 'Ordenar',
            'breadcrumb' => ['Inicio', 'Ordenar']
        );           
        $this->view->showViews(array('templates/header.view.php', 'ordenar.view.php', 'templates/footer.view.php'), $data);
    }    
    
    public function doOrdenar() {
        $data = array(
            'titulo' => 'Ordenar',
            'breadcrumb' => ['Inicio', 'Ordenar']
        ); 
        
        $errores = $this->checkOrdenar($_POST);
        $data['errores'] = $errores;
        
        $data['input'] = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
        
        if(count($errores) == 0){
            $resultado = $this->ordenacion($_POST['numero']);
            $data['resultado'] = $resultado;
        }
        
        $this->view->showViews(array('templates/header.view.php', 'ordenar.view.php', 'templates/footer.view.php'), $data);
    }
    
    private function checkOrdenar(array $data) : array{
        $errores = [];
        
        $numeros = explode(",", $data['numero']);
        $filtrado = filter_var_array($numeros, FILTER_VALIDATE_INT);
        
        foreach ($filtrado as $numero){
            if($numero == false){
                $errores['numero'] = 'La cadena introducida tiene caracteres no numericos';
            }
        } 
        return $errores;
    }
    
    private function ordenacion(string $numerosNa) : string{
        $numeros = explode(",", $numerosNa);
        
        for($i = 0; $i <= count($numeros); $i++){
            for($j = $i+1; $j < count($numeros); $j++){
                $aux = $numeros[$i];
                if($numeros[$j] < $numeros[$i]){
                    $numeros[$i] = $numeros[$j];
                    $numeros[$j] = $aux;
                }
            }
        }
        $resultado = implode(",", $numeros);
        return $resultado;
    }
    
    //---------Base de datos---------//
    
    
}




