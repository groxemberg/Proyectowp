<?= $this->extend('layouts/misrecursos') ?>
<?= $this->section('content') ?>
<?php 
$session=session();
use App\Models\Wp_Model;
$wppendientes= new Wp_Model();
$contrevision=$wppendientes->countEnRevision();
?>

<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
        <h5>PAPELES DE TRABAJOS PENDIENTES</h5> 
    </div>
    <div class="row ">
      <?php
       if ($session->get('tipo')=='jefe') {
        echo form_open_multipart('actividadesagregar');?>
        <button type="submit" class="btn btn-sm" id="botleft" style="background-color: #004A3D; color: white;"><i class="fa fa-database" ></i> Agregar</button>
      <?php echo form_close();}?>
      <?php echo form_open_multipart('pendientesrevision');?>
      <div style="position: relative; display: inline-block;">
        <button  type="submit" class="btn btn-sm" id="botleft" style=" background-color: #900703; color: white; "><i class="fa fa-check-square"></i> Revisión</button>
        <?php if($contrevision>0 && $session->get('tipo')=='jefe'){?>
          <span class="parpadeo" style="position: absolute; top: -22px; left: 15px; right: 10px; margin: auto; background-color: #FAFA69; padding: 10x 10px 10px 10px; text-align: center; border-radius: 5px; font-size:11.5px; color:black; font-weight:bold;">
            <?php echo $contrevision; ?> pendientes
            <span style="content:''; position: absolute; bottom: -5px; left: 50%; transform: translateX(-50%); width: 0; height: 0; border-left: 5px solid transparent; border-right: 5px solid transparent; border-top: 6px solid #FAFA69;"></span>
            </span> <?php }?>
          </div>
      <?php echo form_close();
     if ($session->get('tipo')=='jefe') {
       ?>
      <?php echo form_open_multipart('actividadeseliminadas');?>
        <button  type="submit" class="btn btn-sm" id="botleft" style="background-color: #FC3825; color: white;"><i class="fa fa-trash"></i> Eliminados</button>
      <?php echo form_close();
    }?>
    </div>  <hr>
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
                  <th class="text-center">Tipo de Wp</th>            
                  <th class="text-center">W.P</th>
                  <th class="text-center">Etapa</th>
                  <?php
                  if($session->get('tipo')=='jefe' || $session->get('tipo')=='ejecutor')
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
             if (($session->get('idUsuario')==$row->idEmpleado || $session->get('tipo')=='jefe') AND $row->estado == 1) { ?>
                
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
                    <td class="text-center">
                    <?php  echo form_open_multipart('pendientesrevisionin');
                      ?>
                      <div class="btn-group">
                        <input type="hidden" name="idInforme" value="<?php echo $row->idInforme;?>">
                        <select name="tipoWp" class="col-sm-8 form-control" value="<?php echo set_value('tipoWp'); ?>">
                          <option value=" ">Seleccione...</option>
                          <option value="1">Enviar Digital</option>
                          <option value="2">Enviar Físico</option>
                        </select>
                        
                        <button type="submit" class="btn btn-warning" id="parpadeo" data-toggle="tooltip" data-placement="top" title="Enviar" ><i class="fa fa-sign-out"></i></button>
                        
                      </div> 
                      <p style="color: red;"><?php echo isset($validation) && $validation->hasError('tipoWp') ? $validation->getError('tipoWp') : ''; ?></p>
                      
                    </td>

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
                  <p style="color: #640E05; font-weight: bold; " >Sin Archivo</p> <?php
                  }           
                  ?> 
                </td>
                <td>
                  <?php
                    if ($row->estado == 1) {?>
                      <p style=" padding: 3px; border-radius: 10px; background-color: #FC3825; color: white; ">Pendiente</p>
                  <?php } if ($row->estado == 2) {?>
                      <p style=" padding: 3px; border-radius: 10px; background-color: #FC3825; color: white; ">Revisión</p>
                  <?php } ?>
                </td>
                 <?php
                if($session->get('tipo')=='jefe' || $session->get('tipo')=='ejecutor')
                {
              ?> 
                  <td class="text-center">
                    <div class="btn-group" role="group">
                      <button id="btnGroupDrop1" type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-list"></i></button>
                      <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                          <?php echo form_open_multipart('pendientesagregar');?>
                          <input type="hidden" name="nroInforme" value="<?php echo $row->nroInforme;?>" > 
                            <input type="hidden" name="idInforme" value="<?php echo $row->nroInforme;?>" >
                            <input type="hidden" name="estado" value="<?php echo $row->estado;?>" >
                            <button type="submit" class="dropdown-item" ><i class="fa fa-database"></i>   Agregar o Modificar PT</button>
                          <?php echo form_close();
                          if ($session->get('tipo')=='jefe') {
                           ?>
                          <?php echo form_open_multipart('actividadesmodificar');?>        
                            <input type="hidden" name="idInforme" value="<?php echo $row->idInforme;?>" >
                            <input type="hidden" name="idEmpleado" value="<?php echo $row->idEmpleado;?>" >
                            <button type="submit" class="dropdown-item" ><i class="fa fa-edit (alias)"></i>  Modificar Actividad</button>
                          <?php echo form_close(); ?>
                          <input type="hidden" name="idInforme" value="<?php echo $row->idInforme;?>">
                            <button type="submit" name="botton" value="Eliminar" class="dropdown-item" onclick="return confirm_modalFotos(<?php echo $row->idInforme; ?>)" ><i class="fa fa-trash"></i>  Eliminar</button> 
                       <?php }?>
                      </div>
                    </div>
                  <?php
                    } 
                  ?>
                  </td>
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


<!-- ALERTAS PARA ELIMINAR -->
<div class="modal fade" id="modalConfirmacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">ELIMNAR</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <p style="font-size: 20px;">Estás seguro de eliminar los datos?</p>
      </div>
      <div class="modal-footer">
        <button type="button"  class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fa fa-remove (alias)"></i>  Cancelar</button>
        <a id="url-delete" type="submit" class="btn btn-primary btn-sm"><i class="fa fa-trash"></i>  Eliminar</a>
      </div>
    </div>
  </div>
</div>

<script>
     function confirm_modalFotos(id) {
            var url = '<?php echo base_url() . "actividadeseliminarbd/"; ?>';
            $("#url-delete").attr('href', url + id);
            $('#modalConfirmacion').modal('show');
        } 
</script>

<script>
    function descargarInforme(idInforme) {
        // Construir la URL del controlador para la descarga
        var url = "<?php echo base_url('controller_pendientes/descargarInforme/'); ?>" + idInforme;

        // Abrir la URL en una nueva ventana para forzar la descarga
        window.open(url, '_blank');
    }
</script>
<style>

    /* definimos el keyframes para el efecto del mensaje de revisión*/
  @keyframes blinkingText {
    0% { opacity: 1; }
    50% { opacity: 0; }
    100% { opacity: 1; }
  }

 .parpadeo {
    animation: blinkingText 1.8s infinite;
  }

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

