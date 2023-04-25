<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Formulario ejemplo</h1>

</div>

<!-- Content Row -->

<div class="row">    
    <?php
    if(isset($resultado)){ 
    ?>
     <div class="col-12">
        <div class="alert alert-success">
            El numero mayor es: <?php echo $resultado['mayor'];?>
            <br>
            El numero menor es: <?php echo $resultado['menor'];?>
        </div>
    </div>
    <?php
    }
    ?>
    <div class="col-12">       
        <div class="card shadow mb-4">
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Primos</h6>                                    
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <!--<form action="./?sec=formulario" method="post">                   -->
                <form method="post" action="">                    
                    <div class="mb-3">
                        <label for="numero">Número</label>
                        <input class="form-control" id="numero" type="text" name="numero" placeholder="0, 1, 2, 3, ..." value="<?php echo isset($input['numero']) ? $input['numero'] : ''; ?>"> 
                        <p class="text-danger small"><?php echo isset($errores['numero']) ? $errores['numero'] : '';?></p>
                    </div>                    
                    <div class="mb-3">
                        <input type="submit" value="Enviar" name="enviar" class="btn btn-primary"/>
                    </div>
                </form>
            </div>
        </div>
    </div>                        
</div>