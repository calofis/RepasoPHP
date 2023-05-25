<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div
                class="card-header">
                <a href="/roles" class="btn btn-outline-primary float-right">Volver al formulario</a>                              
            </div>
            <div class="card-body">
                <div class="card shadow mb-4">
                    <form method="get" action="/usuarios/new">
                        <div
                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Filtros</h6>                                    
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <!--<form action="./?sec=formulario" method="post">                   -->
                            <div class="row">
                                <?php if(isset($respuesta)){ ?>
                                 <div class="col-12">
                                    <div class="alert alert-success">
                                        <p>El usuario <?php echo $input['username'] ?>  ha sido creado con exito</p>
                                    </div>
                                </div>
                                <?php } ?>
                                <div class="col-12 col-lg-4">
                                    <div class="mb-3">
                                        <label for="username">Nombre completo:</label>
                                        <input type="text" class="form-control" name="username" id="username" value="<?php echo isset($input['username']) ? $input['username'] : ''; ?>" placeholder="Username"/>
                                    </div>
                                    <p class="text-danger small"><?php echo isset($errores['username']) ?  $errores['username'] : '';?></p>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="mb-3">
                                        <label for="salario">Salario Bruto:</label>
                                        <div class="row">
                                            <div class="col-12">
                                                <input type="text" class="form-control" name="salario" id="salario" value="<?php echo isset($input['salario']) ? $input['salario'] : ''; ?>" placeholder="Salario" />
                                            </div>
                                        </div>
                                        <p class="text-danger small"><?php echo isset($errores['salario']) ?  $errores['salario'] : '';?></p>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="mb-3">
                                        <label for="retenciones">Retenciones:</label>
                                        <select name="retenciones" id="retenciones" class="form-control" data-placeholder="Roles">
                                            <option value="0"></option>
                                            <?php foreach ($retenciones as $retencion) {
                                                ?>
                                                <?php if (isset($input['retenciones']) && $retencion['retencionIRPF'] == $input['retenciones']) { ?>
                                                    <option value="<?php echo $retencion['retencionIRPF']; ?>" selected="true"><?php echo $retencion['retencionIRPF']; ?></option>
                                                <?php } else { ?>
                                                    <option value="<?php echo $retencion['retencionIRPF']; ?>"><?php echo $retencion['retencionIRPF']; ?></option>
                                                <?php } ?>
                                                <?php
                                            }
                                            ?>                                                                         
                                        </select>
                                        <p class="text-danger small"><?php echo isset($errores['retenciones']) ?  $errores['retenciones'] : '';?></p>
                                    </div>
                                </div>
                                <label for="ejemplo_select">Activo</label> 
                                <div class="col-sm-12">
                                    <div class="form-check">
                                        <input class="form-check-input" id="activo" type="checkbox" value="1" name="activo" <?php echo isset($input['activo']) ? 'checked' : '';?>>
                                        <label class="form-check-label" for="activo">Activo</label>
                                    </div>
                                    <p class="text-danger small"><?php echo isset($errores['activo']) ?  $errores['activo'] : '';?></p>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="mb-3">
                                        <label for="roles">Roles:</label>
                                        <select name="roles" id="roles" class="form-control select" data-placeholder="Roles">
                                            <option value="0"></option>
                                            <?php foreach ($roles as $rol) {
                                                ?>
                                                <?php if (isset($input['roles']) &&  $rol['id_rol'] == $input['roles'] ) { ?>
                                                    <option value="<?php echo $rol['id_rol']; ?>" selected="true"><?php echo $rol['nombre_rol']; ?></option>
                                                <?php } else { ?>
                                                    <option value="<?php echo $rol['id_rol']; ?>"><?php echo $rol['nombre_rol']; ?></option>
                                                <?php } ?>
                                                <?php
                                            }
                                            ?>                                                                         
                                        </select>
                                        <p class="text-danger small"><?php echo isset($errores['roles']) ?  $errores['roles'] : '';?></p>
                                    </div>
                                </div>    
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="col-12 text-right">                     
                                <a href="/usuarios/new" value="" name="reiniciar" class="btn btn-danger">Reiniciar datos</a>
                                <input type="submit" value="Crear Usuario" name="enviar" class="btn btn-primary ml-2"/>
                            </div>
                        </div>
                    </form>
                </div>     
            </div>
        </div>
    </div> 
</div>
