<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div
                class="card-header">
                <a href="./categoria/new" class="btn btn-outline-primary float-right">Nueva categoría</a>                              
            </div>
            <div class="card-body">
                <div class="card shadow mb-4">
                    <form method="post" action="/roles">
                        <input type="hidden" name="order" value="1"/>
                        <div
                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Filtros</h6>                                    
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <!--<form action="./?sec=formulario" method="post">                   -->
                            <div class="row">                                                                  
                                <div class="col-12 col-lg-4">
                                    <div class="mb-3">
                                        <label for="filtros">Roles:</label>
                                        <select name="filtros" id="filtros" class="form-control" data-placeholder="Roles">
                                            <option value="0"></option>
                                            <?php foreach ($roles as $rol) {
                                                ?>
                                                <?php if (isset($roless) && $rol['id_rol'] == $roless) { ?>
                                                    <option value="<?php echo $rol['id_rol']; ?>" selected="true"><?php echo $rol['nombre_rol']; ?></option>
                                                <?php } else { ?>
                                                    <option value="<?php echo $rol['id_rol']; ?>"><?php echo $rol['nombre_rol']; ?></option>
                                                <?php } ?>
                                                <?php
                                            }
                                            ?>                                                                         
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="mb-3">
                                        <label for="username">Nombre completo:</label>
                                        <input type="text" class="form-control" name="username" id="username" value="<?php echo isset($input['username']) ? $input['username'] : ''; ?>" placeholder="Username"/>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="anho_fundacion">Rango de salarios:</label>
                                <div class="row">
                                    <div class="col-6">
                                        <input type="text" class="form-control" name="minimoSalario" id="minimoSalario" value="<?php echo isset($input['minimoSalario']) ? $input['minimoSalario'] : ''; ?>" placeholder="Mí­nimo" />
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control" name="maximoSalario" id="maximoSalario" value="<?php echo isset($input['maximoSalario']) ? $input['maximoSalario'] : ''; ?>" placeholder="Máximo" />
                                    </div>
                                </div>
                            </div>
                        </div>   
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="col-12 text-right">                     
                                <a href="/roles" value="" name="reiniciar" class="btn btn-danger">Reiniciar filtros</a>
                                <input type="submit" value="Aplicar filtros" name="enviar" class="btn btn-primary ml-2"/>
                            </div>
                        </div>
                    </form>
                </div>
                <?php
                if (count($data) > 0) {
                    ?>
                    <table id="categoriaTable" class="table table-bordered table-striped  dataTable">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Salario Bruto</th>
                                <th>IRPF</th>
                                <th>Rol</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($data as $user) {
                                ?>
                                <tr id="usuario-<?php echo $user['username']; ?>" <?php if ($user['activo'] == 0) {
                            echo 'class="table-danger"';
                        } ?>>
                                    <td><?php echo $user['username']; ?></td>
                                    <td><?php echo $user['salarioBruto']; ?></td>
                                    <td><?php echo $user['retencionIRPF']; ?></td>
                                    <td><?php echo $user['nombre_rol']; ?></td>
                                    <td align="center"><a class="btn btn-clock btn-outline-primary" href="/usuarios/edit/<?php echo $user['username']; ?>"><i class="fas fa-edit"></i></a> <a class="btn btn-clock btn-outline-danger" href="/usuarios/delete/<?php echo $user['username']; ?>"><i class="fas fa-trash"></i></a></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <?php
                } else {
                    ?>
                    <div class="callout callout-info">
                        <h5>Sin categorías</h5>

                        <p>No existen usuarios dadas de alta que cumplan los requisitos. Pulse aquí para <a href="/usuarios/new">crear un nuevo usuario.</a></p>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div> 
</div>