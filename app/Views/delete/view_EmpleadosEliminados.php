<?= $this->extend('layouts/misrecursos') ?>
<?= $this->section('content') ?>
<?php  $session=session(); ?>

<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
      <div class="row float-left" >
      <?php 
        echo form_open_multipart('empleadosindex');?>
          <button class="btn btn-primary float-center" data-toggle="tooltip" data-placement="top" title="Volver a la lista de empleados activos" id="atras" style="background: black;">
            <i class="glyphicon glyphicon-arrow-left"></i>
      <?php echo form_close();?>
      </div>
        <h5 >FUNCIONARIOS DADO DE BAJA</h5> 
    </div>
    <div class="x_content">
      <div class="row">
        <div class="col-sm-12">
    
            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                    <th class="text-center">Nro.</th>
                    <th class="text-center">C.I.</th>
                    <th class="text-center">Expedido</th>
                    <th class="text-center">Nombres y Apellidos</th> 
                <?php
                  if($session->get('tipo')=='jefe')
                  {
                ?> 
                    <th class="text-center">Acciones</th> 
                <?php
                  }
                ?>
                
                </tr>
              </thead>
              <tbody>
              <?php
              $indice=1;
              foreach ($empleados->getResult() as  $row)
              {
              ?>
                  <tr>
                    <td class="text-center" ><?php echo $indice;?></td>
                    <td class="text-center"><?php echo $row->ci;?></td>
                    <td class="text-center"><?php echo $row->expedicion;?></td>
                    <td ><?php echo $row->nombres.' '.$row->primerApellido.' '.$row->segundoApellido;?></td>

              <?php
                if($session->get('tipo')=='jefe')
                {
              ?> 
                    <td class="text-center">
                      <?php echo form_open_multipart('recuperarbd');?>
                        <input type="hidden" name="idEmpleado" value="<?php echo $row->idEmpleado;?>" >
                        <button type="submit" name="botton" value="recuperar" class="btn btn-warning"><i class="fa fa-database"></i> Recuperar</button>
                      <?php echo form_close(); ?>
                    </td>
                 <?php
              }
            ?>  
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