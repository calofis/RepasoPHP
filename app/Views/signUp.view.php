<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="card shadow mb-4">
                    <form method="post" action="/signUp">
                        <div
                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Sign Up</h6>                                    
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
                                        <label for="username">Nombre:</label>
                                        <input type="text" class="form-control" name="username" id="username" value="<?php echo isset($input['username']) ? $input['username'] : ''; ?>" placeholder="Username"/>
                                    </div>
                                    <p class="text-danger small"><?php echo isset($errores['username']) ?  $errores['username'] : '';?></p>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="mb-3">
                                        <label for="username">Email:</label>
                                        <input type="text" class="form-control" name="email" id="email" value="<?php echo isset($input['email']) ? $input['email'] : ''; ?>" placeholder="ejemplo@email.com"/>
                                    </div>
                                    <p class="text-danger small"><?php echo isset($errores['email']) ?  $errores['email'] : '';?></p>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="mb-3">
                                        <label for="password">Password:</label>
                                        <input type="password" class="form-control" name="password" id="password" value="<?php echo isset($input['password']) &&  !isset($errores['password']) ? $input['password'] : ''; ?>" placeholder="Contraseña"/>
                                    </div>
                                    <p class="text-danger small"><?php echo isset($errores['password']) ?  $errores['password'] : '';?></p>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="mb-3">
                                        <label for="idioma">Idioma:</label>
                                        <select name="idioma" id="idioma" class="form-control select" data-placeholder="Roles">
                                            <option value="0"></option>
                                            <option value="es" <?php echo isset($input['idioma']) && $input['idioma'] == 'es' ? 'selected="true"' : ''; ?>>Español</option>
                                            <option value="en" <?php echo isset($input['idioma']) && $input['idioma'] == 'en' ? 'selected="true"' : ''; ?>>Ingles</option>
                                        </select>
                                        <p class="text-danger small"><?php echo isset($errores['idioma']) ?  $errores['idioma'] : '';?></p>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="mb-3">
                                        <label for="roles">Rol:</label>
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
                                <a href="/signUp" value="" name="reiniciar" class="btn btn-danger">Reiniciar datos</a>
                                <input type="submit" value="Aplicar Cambio" name="enviar" class="btn btn-primary ml-2"/>
                            </div>
                        </div>
                    </form>
                </div>     
            </div>
        </div>
    </div> 
</div>
