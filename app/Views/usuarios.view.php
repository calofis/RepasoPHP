
<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div
                class="card-header">
                <a href="./categoria/new" class="btn btn-outline-primary float-right">Nueva categoría</a>                              
            </div>
            <div class="card-body"> 
                <?php if(count($data) > 0) { ?>
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
                    foreach($data as $user){
                        ?>
                        <tr id="usuario-<?php echo $user['username']; ?>" <?php if($user['activo'] == 0) {echo 'class="table-danger"';}?>>
                            <td><?php echo $user['username']; ?></td>
                            <td><?php echo $user['salarioBruto']; ?></td>
                            <td><?php echo $user['retencionIRPF']; ?></td>
                            <td><?php echo $user['nombre_rol'];?></td>
                            <td align="center"><a class="btn btn-clock btn-outline-primary" href="/usuarios/edit/<?php echo $user['username']; ?>"><i class="fas fa-edit"></i></a> <a class="btn btn-clock btn-outline-danger" href="/usuarios/delete/<?php echo $user['username']; ?>"><i class="fas fa-trash"></i></a></td>
                        </tr>
                            <?php
                        }                    
                    ?>
                    </tbody>
                </table>
                <?php
                }
                else{
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
