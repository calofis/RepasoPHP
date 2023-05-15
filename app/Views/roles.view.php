<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div
                class="card-header">
                <a href="./categoria/new" class="btn btn-outline-primary float-right">Nueva categoría</a>                              
            </div>
            <div class="card-body">
                <div class="card shadow mb-4">
                    <form method="get" action="/roles">
                        <input type="hidden" name="order" value="<?php echo $order ?>"/>
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
                                        <label for="roles">Roles:</label>
                                        <select name="roles[]" id="roles" class="form-control select2" data-placeholder="Roles" multiple>
                                            <option value="0"></option>
                                            <?php foreach ($roles as $rol) {
                                                ?>
                                                <?php if (in_array($rol['id_rol'], $_GET['roles'])) { ?>
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
                                <div class="col-12 col-lg-4">
                                    <div class="mb-3">
                                        <label for="retenciones">Retenciones:</label>
                                        <select name="retenciones" id="retenciones" class="form-control" data-placeholder="Roles">
                                            <option value="0"></option>
                                            <?php foreach ($retenciones as $retencion) {
                                                ?>
                                                <?php if (isset($retencioness) && $retencion['retencionIRPF'] == $retencioness) { ?>
                                                    <option value="<?php echo $retencion['retencionIRPF']; ?>" selected="true"><?php echo $retencion['retencionIRPF']; ?></option>
                                                <?php } else { ?>
                                                    <option value="<?php echo $retencion['retencionIRPF']; ?>"><?php echo $retencion['retencionIRPF']; ?></option>
                                                <?php } ?>
                                                <?php
                                            }
                                            ?>                                                                         
                                        </select>
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
                                <th><a href="/roles?order=1<?php echo $filtro; ?>">Username</a></th>
                                <th><a href="/roles?order=2<?php echo $filtro; ?>">Salario Bruto</a></th>
                                <th><a href="/roles?order=3<?php echo $filtro; ?>">IRPF</a></th>
                                <th><a href="/roles?order=4<?php echo $filtro; ?>">Rol</a></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($data as $user) {
                                ?>
                                <tr id="usuario-<?php echo $user['username']; ?>" <?php
                                if ($user['activo'] == 0) {
                                    echo 'class="table-danger"';
                                }
                                ?>>
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
            <div class="card-footer">
                <nav aria-label="Navegacion por paginas">
                    <?php if ($pagina > 1) { ?>
                        <ul class="pagination justify-content-center">
                            <li class="page-item">
                                <a class="page-link" href="/proveedores?page=1&order=1" aria-label="First">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">First</span>
                                </a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="/roles?order=1&page=<?php echo $pagina - 1; echo $filtro; ?>" aria-label="Previous">
                                    <span aria-hidden="true">&lt;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>
                            <li class="page-item active"><a class="page-link" href=""><?php echo $pagina ?></a></li>   
                            <li class="page-item">
                                <a class="page-link" href="/roles?order=1&page=<?php echo $pagina + 1; echo $filtro; ?>" aria-label="Next">
                                    <span aria-hidden="true">&gt;</span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="" aria-label="Last">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Last</span>
                                </a>
                            </li>
                        </ul>
                    <?php } else{ ?>
                        <ul class="pagination justify-content-center">
                            <li class="page-item active"><a class="page-link" href="#"><?php echo $pagina ?></a></li>   
                            <li class="page-item">
                                <a class="page-link" href="/roles?order=1&page=<?php echo $pagina + 1; echo $filtro; ?>" aria-label="Next">
                                    <span aria-hidden="true">&gt;</span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="" aria-label="Last">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Last</span>
                                </a>
                            </li>
                        </ul>
                    <?php } ?>
                </nav>
            </div>
        </div>
    </div> 
</div>