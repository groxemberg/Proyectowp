<?= $this->extend('layouts/misrecursos') ?>
<?= $this->section('content') ?>
<?php 
$session=session();
?>

<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
        <h5>PAPELES DE TRABAJO PROGRAMADOS</h5>
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
                  <th class="text-center">Nro de Informe</th> 
                  <th class="text-center">Informe</th>
                  <th class="text-center">W.P</th>
                <?php if ($session->get('tipo')=='jefe' || $session->get('tipo')=='ejecutor') {?>
                <th class="text-center">Cerrar Inspección</th>
                <?php }?>
                </tr>
                </tr>
              </thead>
              <tbody>
              <?php
              $indice=1;
              foreach ($inwp->getResult() as  $row)
              {
              ?>
                 <tr>
                  <td class="text-center"><?php echo $indice;?></td>
                  <td class="text-center"><?php echo $row->nroInforme;?></td>
                  <td ><?php echo $row->informe;?></td>
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
                <?php if ($session->get('tipo')=='jefe' || $session->get('tipo')=='ejecutor') {?>
                <td >
                <div style="text-align: center;">
                <button type="submit" name="botton" value="Eliminar" class="btn" onclick="return confirm_modalFotos(<?php echo $row->idInforme; ?>)" style=" background-color: #900703; color: white; ">
                <i class="fa fa-close (alias)"></i>
                </button>
                </div>
                </td>
                <?php } ?>
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
<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
        <h5>PAPELES DE TRABAJO NO PROGRAMADOS</h5>
    </div>
    <hr>
    <div class="x_content">
      
      <div class="row">
        <div class="col-sm-12">              
              
            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th class="text-center">Nro.</th>
                  <th class="text-center">Nro de Informe</th> 
                  <th class="text-center">Informe</th>
                <th class="text-center">W.P</th>
                <?php if ($session->get('tipo')=='jefe' || $session->get('tipo')=='ejecutor') {?>
                <th class="text-center">Cerrar Inspección</th>
                <?php }?>
                </tr>
              </thead>
              <tbody>
              <?php
              $indice=1;
              foreach ($inpwp->getResult() as  $row)
              {
              ?>
                 <tr>
                  <td class="text-center"><?php echo $indice;?></td>
                  <td class="text-center"><?php echo $row->nroInforme;?></td>
                  <td ><?php echo $row->informe;?></td>
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
                <?php if ($session->get('tipo')=='jefe' || $session->get('tipo')=='ejecutor') {?>
                <td >
                <div style="text-align: center;">
                <button type="submit" name="botton" value="Eliminar" class="btn" onclick="return confirm_modalFotos(<?php echo $row->idInforme; ?>)" style=" background-color: #900703; color: white; ">
                <i class="fa fa-close (alias)"></i>
                </button>
                </div>
                </td>
                <?php } ?>
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
<div class="modal fade" id="modalConfirmacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">MODIFICAR</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <p style="font-size: 20px;">Estás seguro de cerrar los papeles de trabajo auditados?</p>
      </div>
      <div class="modal-footer">
        <button type="button"  class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fa fa-remove (alias)"></i>  Cancelar</button>
        <a id="url-delete" type="submit" class="btn btn-primary btn-sm"><i class="fa fa-remove (alias)"></i>  Cerrar Inspección</a>
      </div>
    </div>
  </div>
</div>

<script>
     function confirm_modalFotos(id) {
            var url = '<?php echo base_url() . "cerrarins/"; ?>';
            $("#url-delete").attr('href', url + id);
            $('#modalConfirmacion').modal('show');
        } 
</script>

<?= $this->endSection() ?>