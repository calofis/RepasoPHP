<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div
                class="card-header">
                <a href="/roles" class="btn btn-outline-primary float-right">Volver al formulario</a>                              
            </div>
            <div class="card-body">
                <div class="card shadow mb-4">
                    <form method="post" action="/pruebaCookies">
                        <div
                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Filtros</h6>                                    
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <!--<form action="./?sec=formulario" method="post">                   -->
                            <div class="row">
                                <?php if(isset($usernameC)){ ?>
                                 <div class="col-12">
                                    <div class="alert alert-success">
                                        <p>El usuario <?php echo $usernameC ?>  ha sido creado con exito</p>
                                    </div>
                                </div>
                                <?php } ?> 
                                <div class="col-12 col-lg-12">
                                    <div class="mb-3">
                                        <label for="username">Username:</label>
                                        <input type="text" class="form-control" name="username" id="username" value="<?php echo isset($input['username']) ? $input['username'] : ''; ?>" placeholder="Username"/>
                                    </div>
                                    <p class="text-danger small"><?php echo isset($errores['username']) ?  $errores['username'] : '';?></p>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="col-12 text-right">                    
                                <input type="submit" value="Aplicar Cambio" name="enviar" class="btn btn-primary ml-2"/>
                            </div>
                        </div>
                    </form>
                </div>     
            </div>
        </div>
    </div> 
</div>
