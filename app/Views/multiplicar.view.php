<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Formulario ejemplo</h1>

</div>

<!-- Content Row -->

<div class="row">    
    <?php
    if(isset($resultado)){ ?>
     <div class="col-12">
        <div class="alert alert-success">
            El resultado de la multiplicación es: <?php echo $resultado;?>
        </div>
    </div>
    <?php
    }
    ?>
    <div class="col-12">       
        <div class="card shadow mb-4">
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Factorial</h6>                                    
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <!--<form action="./?sec=formulario" method="post">                   -->
                <form method="post" action="">                    
                    <div class="mb-3">
                        <label for="numero1">Primer número</label>
                        <input class="form-control" id="numero1" type="text" name="numero1" placeholder="0" value="<?php echo isset($input['numero1']) ? $input['numero1'] : ''; ?>"> 
                        <p class="text-danger small"><?php echo isset($errores['numero1']) ? $errores['numero1'] : '';?></p>
                    </div>
                    <div class="mb-3">
                        <label for="numero2">Segundo número</label>
                        <input class="form-control" id="numero2" type="text" name="numero2" placeholder="0" value="<?php echo isset($input['numero2']) ? $input['numero2'] : ''; ?>"> 
                        <p class="text-danger small"><?php echo isset($errores['numero2']) ? $errores['numero2'] : '';?></p>
                    </div>
                    <div class="mb-3">
                        <input type="submit" value="Enviar" name="enviar" class="btn btn-primary"/>
                    </div>
                </form>
            </div>
        </div>
    </div>                        
</div>