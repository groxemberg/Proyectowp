<?= $this->extend('layouts/misrecursos') ?>
<?= $this->section('content') ?>
<?php 
$session=session();
?>

<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
        <h5>LISTA DE USUARIOS</h5> 
    </div>
    <div class="x_content">
      <div class="row">
        <div class="col-sm-12">
    
            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th class="text-center">Nro.</th>
                   <th class="text-center">Nombre (s) y Apellido(s)</th> 
                    <th class="text-center">Nombre de Usuario</th> 
                    <th class="text-center">Tipo de Usuario</th>
                <?php
                  if($session->get('tipo')=='jefe')
                  {
                ?> 
                    <th th class="text-center">Acciones</th> 
                <?php
                  }
                ?>
                
                </tr>
              </thead>
              <tbody>
              <?php
              $indice=1;
              foreach ($usuario->getResult() as  $row)
              {
              ?>
                  <tr>
                    <td class="text-center" ><?php echo $indice;?></td>
                    <td ><?php echo $row->nombres.' '.$row->primerApellido.' '.$row->segundoApellido;?></td>
                    <td class="text-center" ><?php echo $row->usuario;?></td>
                    <?php 
                    $rol=$row->tipo;
                    ?>
                    <td class="text-center">
                    <?php if ($rol=='jefe')
                    {?>
                    <p>Administrador</p>
                    <?php
                    } if ($rol=='inspector')
                    {?>
                    <p>Usuario Externo</p>
                    <?php
                     } if ($rol=='ejecutor')
                     {?>
                     <p>Ejecutor</p>
                     <?php } ?>
                    </td>
              <?php
                if($session->get('tipo')=='jefe')
                {
              ?> 
                  <td class="text-center">
                    <div class="btn-group" role="group">
                      <button id="btnGroupDrop1" type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-list"></i></button>
                      <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                          <?php echo form_open_multipart('usuarioscontrasena');?>        
                            <input type="hidden" name="idUsuario" value="<?php echo $row->idEmpleado;?>" >
                            <button type="submit" class="dropdown-item" ><i class="fa fa-edit (alias)"></i>  Modificar Contraseña</button>
                          <?php echo form_close(); ?>
                          <?php echo form_open_multipart('usuariosrol');?>        
                            <input type="hidden" name="idUsuario" value="<?php echo $row->idEmpleado;?>" >
                            <button type="submit" class="dropdown-item" ><i class="fa fa-edit (alias)"></i>  Modificar Rol</button>
                          <?php echo form_close(); ?>
                      </div>
                    </div>
                  <?php
                    } 
                  ?>
                  </td>
                  </tr>
            <?php
              $indice++;
              }
            ?>
              </tbody>
            </table>

        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
<?= $this->endSection() ?>