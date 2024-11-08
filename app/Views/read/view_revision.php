<?= $this->extend('layouts/misrecursos') ?>
<?= $this->section('content') ?>
<?php 
$session=session();
?>

<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
      <div class="row float-left" >
      <?php 
        echo form_open_multipart('pendientesindex');?>
          <button class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Volver a la lista de actividades" id="atras" style="background: #040300;">
            <i class="glyphicon glyphicon-arrow-left"></i>
      <?php echo form_close();?>
      </div>
        <h5>PAPELES DE TRABAJOS EN REVISIÓN</h5> 
    </div>
     <hr>
    <div class="x_content">
      <div class="row">
        <div class="col-sm-12">
    
            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th class="text-center">Nro.</th>
                  <th class="text-center">Auditor Responsable</th> 
                  <th class="text-center">Nro. de Informe</th>
                  <th class="text-center">Informe</th>
                  <th class="text-center">Fecha de Presentación</th>
                  <th class="text-center">Plazo WP</th>
                  <?php
                  if ($session->get('tipo')=='jefe') {
                  ?>
                  <th class="text-center">Tipo de Wp</th> 
                  <?php } ?>           
                  <th class="text-center">W.P</th>
                  <th class="text-center">Etapa</th>
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
              foreach ($wp->getResult() as  $row)
              {
             if (($session->get('idUsuario')==$row->idEmpleado || $session->get('tipo')=='jefe') AND $row->estado == 2) { ?>
                
                  <tr>
                    <td class="text-center" ><?php echo $indice;?></td>
                    <td class="text-center" ><?php echo $row->nombres.' '.$row->primerApellido.' '.$row->segundoApellido;?></td>
                    <td class="text-center" ><?php echo $row->nroInforme;?></td>
                    <td ><?php echo $row->informe;?></td>
                    <td class="text-center" ><?php echo formatearFecha($row->fechaPresentacion);?></td>
                    <?php 
                    $fechaPresentacion = new DateTime($row->fechaPresentacion);
                    $fechaFinal = clone $fechaPresentacion;
                    $fechaFinal->modify("+60 days");
                    $fechaActual = new DateTime();
                    $intervalo = $fechaActual->diff($fechaFinal);
                    $diasRestantes = $intervalo->days+1;
                    $diasRe=$fechaFinal;
                    ?>
                    <td class="text-center" ><?php 
                    if ($fechaActual > $fechaFinal) {?>
                      <p style="color:red; font-weight: bold;">Retrasado con <?php echo abs($diasRestantes)?> días</p>
                    <?php } else {?>
                      <p style="color: green; font-weight: bold;">Vence en <?php echo abs($diasRestantes)?> días 
                        <!-- Fecha: <?php echo $diasRe->format('d/m/Y');?>--> </p>
                      <?php
                    }
                    ;?></td>
                    <?php
                  if ($session->get('tipo')=='jefe') {
                  ?>
                    <td class="text-center">
                    <?php  echo form_open_multipart('pendientesdevolver');
                      ?>
                      <div class="btn-group">
                        <input type="hidden" name="idInforme" value="<?php echo $row->idInforme;?>">
                        <select name="tipoWp" class="col-sm-8 form-control" value="<?php echo set_value('tipoWp'); ?>">
                          <option value=" ">Seleccione...</option>
                          <option value="1">Devolver PT</option>
                          <option value="2">Cerrar PT</option>
                        </select>
                        <button type="submit" class="btn btn-warning" data-toggle="tooltip" id="parpadeo" data-placement="top" title="Enviar" ><i class="fa fa-sign-out"></i></button>
                      </div> 
                      <p style="color: red;"><?php echo isset($validation) && $validation->hasError('tipoWp') ? $validation->getError('tipoWp') : ''; ?></p>
                    </td>
                  <?php } ?>

                    <?php 
                      echo form_close();
                       ?>
                
                 <td class="text-center">
                  <?php
                  if ($row->wp !="") {
                      $papeles=$row->nroInforme;?>
                      <a href="<?php echo base_url();?>/carpeta_archivos/<?php echo $papeles.'.zip'?>" download><img src="<?php echo base_url().'/uploads/zip.png'?>" width="50" height="30">
                    </a> <?php
                  }
                  else
                  {?>
                  <p style=" padding: 3px; border-radius: 10px; background-color: green; color: white; text-align: center; " >Físico</p> <?php
                  }           
                  ?> 
                </td>
                <td>
                  <?php
                    if ($row->estado == 1) {?>
                      <p style=" padding: 3px; border-radius: 10px; background-color: red; color: white; text-align: center; ">Pendiente</p>
                  <?php } if ($row->estado == 2) {?>
                      <p style=" padding: 3px; border-radius: 10px; background-color: #640E05; color: white; text-align: center;  ">Revisión</p>
                  <?php } ?>
                </td>
                 <?php
                if($session->get('tipo')=='jefe' || $session->get('tipo')=='ejecutor')
                {
              ?> 
              <?php
                  if($session->get('tipo')=='jefe')
                  { ?>
                  <td class="text-center">
                    <div class="btn-group" role="group">
                      <button id="btnGroupDrop1" type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-list"></i></button>
                      <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                          <?php echo form_open_multipart('pendientesagregar');?>
                          <input type="hidden" name="nroInforme" value="<?php echo $row->nroInforme;?>" > 
                            <input type="hidden" name="idInforme" value="<?php echo $row->nroInforme;?>" >
                            <input type="hidden" name="estado" value="<?php echo $row->estado;?>" >
                            <?php if ($row->tipoWp == 1) {?>
                              <button type="submit" class="dropdown-item" ><i class="fa fa-database"></i>   Actualizar Wp</button>
                            <?php }
                          echo form_close(); ?>
                          
                      </div>
                    </div>
                  <?php
                    } 

                  ?>
                  </td>
                  <?php } ?>
                  </tr>
                
            <?php
              }
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

<script>
    function descargarInforme(idInforme) {
        // Construir la URL del controlador para la descarga
        var url = "<?php echo base_url('controller_pendientes/descargarInforme/'); ?>" + idInforme;

        // Abrir la URL en una nueva ventana para forzar la descarga
        window.open(url, '_blank');
    }
</script>

<style>

/* definimos el keyframes para el efecto*/
@keyframes boton {
    0% { color: #004A3D; }   /* Color inicial */
    50% { color: #900703; }  /* Color intermedio */
    100% { color: #004A3D; } /* Color final (igual al inicial para crear un bucle) */
}

/* Aplica la animación al elemento */
#parpadeo {
    animation: boton 1s infinite;
}

  
</style>

<?= $this->endSection() ?>