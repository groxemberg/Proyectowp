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
                </tr>
              </thead>
              <tbody>
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