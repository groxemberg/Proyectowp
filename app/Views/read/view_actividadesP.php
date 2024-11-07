<?= $this->extend('layouts/misrecursos') ?>
<?= $this->section('content') ?>
<?php 
$session=session();
?>

<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
        <h5>PAPELES DE TRABAJO CONCLUIDOS</h5>
    </div>
    <div class="row">
    <?php if ($session->get('tipo') == 'jefe' || $session->get('tipo') == 'ejecutor') : ?>
        <div class="col-6 d-flex">
            <?php echo form_open_multipart('actividadesprogramadas'); ?>
                <button type="submit" class="btn btn-sm mr-2" style="background-color: #004A3D; color: white;">
                    <i class="fa fa-list"></i> Programados
                </button>
            <?php echo form_close(); ?>

            <?php echo form_open_multipart('actividadesnoprogramadas'); ?>
                <button type="submit" class="btn btn-sm" style="background-color: #004A3D; color: white;">
                    <i class="fa fa-list"></i> No Programados
                </button>
            <?php echo form_close(); ?>
        </div>

        <div class="col-6 d-flex justify-content-end">
            <?php echo form_open_multipart('actividadesins'); ?>
                <button type="submit" class="btn btn-sm mr-2" style="background-color: #004A3D; color: white;">
                    <i class="fa fa-list"></i> En Auditoría
                </button>
            <?php echo form_close(); ?>

            <?php echo form_open_multipart('actividadesauditados'); ?>
                <button type="submit" class="btn btn-sm" style="background-color: #004A3D; color: white;">
                    <i class="fa fa-list"></i> Auditados
                </button>
            <?php echo form_close(); ?>
        </div>
    <?php endif; ?>
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
                  <th class="text-center">Nro de Informe</th> 
                  <th class="text-center">Informe</th>
                  <th class="text-center">Fecha de Inicio</th>
                  <th class="text-center">Fecha de Conclusión</th>
                  <th class="text-center">Fecha Presentación</th>
                <th class="text-center">WP</th>
                <?php if ($session->get('tipo')=='jefe' || $session->get('tipo')=='ejecutor') {?>
                <th class="text-center">Enviar Inspección</th>
                <?php }?>
                </tr>
              </thead>
              <tbody>
              <?php
              $indice=1;
              foreach ($pwp->getResult() as  $row)
              {
              ?>
                 <tr>
                  <td class="text-center"><?php echo $indice;?></td>
                  <td class="text-center" ><?php echo $row->nombres.' '.$row->primerApellido.' '.$row->segundoApellido;?></td>
                  <td class="text-center"><?php echo $row->nroInforme;?></td>
                  <td ><?php echo $row->informe;?></td>
                  <td class="text-center"><?php echo formatearFecha($row->fechaInicio);?></td>
                  <td class="text-center"><?php echo formatearFecha($row->fechaConclusion);?></td>
                  <td class="text-center"><?php echo formatearFecha($row->fechaPresentacion);?></td>
                  <td class="text-center">
                  <?php
                  if ($row->wp != "" ) {
                      $papeles=$row->nroInforme;?>
                      <a href="<?php echo base_url();?>/carpeta_archivos/<?php echo $papeles.'.zip'?>" download><img src="<?php echo base_url().'/uploads/zip.png'?>" width="50" height="30">
                    </a> <?php
                  }
                  else
                  {?>
                  <p style=" padding: 3px; border-radius: 10px; background-color: #004A3D; color: white; text-align: center; " >Físico</p> <?php
                  }           
                  ?> 
                    
                </td>
                <td >
                <div style="text-align: center;">
                <button type="submit" name="botton" value="Eliminar" class="btn" onclick="return confirm_modalFotos(<?php echo $row->idInforme; ?>)" style=" background-color: #900703; color: white; ">
                <i class="fa fa-share"></i>
                </button>
                </div>
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

<!-- ALERTAS PARA ELIMINAR -->
<div class="modal fade" id="modalConfirmacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5>MODIFICAR</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <p style="font-size: 20px;">¿Estás seguro de enviar los papeles de trabajo a revisión?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fa fa-remove"></i> Cancelar</button>
        <a id="url-delete" class="btn btn-primary btn-sm"><i class="fa fa-remove"></i> Enviar Inspección</a>
      </div>
    </div>
  </div>
</div>

<script>
    function confirm_modalFotos(id) {
        var url = '<?php echo base_url() . "enviarins/"; ?>';
        $("#url-delete").attr('href', url + id);
        $('#modalConfirmacion').modal('show');
    }
</script>

<?= $this->endSection() ?>