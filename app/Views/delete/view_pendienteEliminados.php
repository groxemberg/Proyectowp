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
          <button class="btn btn-primary float-center" data-toggle="tooltip" data-placement="top" title="Volver a la lista de actividades" id="atras" style="background: black;">
            <i class="glyphicon glyphicon-arrow-left"></i>
      <?php echo form_close();?>
      </div>
        <h5>ACTIVIDADES ASIGNADAS ELIMINADAS</h5> 
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
                  <th class="text-center">Fecha de Inicio</th>
                  <th class="text-center">Fecha de Conclusión</th>        
                  <th th class="text-center">Acciones</th> 
                </tr>
              </thead>
              <tbody>
              <?php
              $indice=1;
              foreach ($wpeliminados->getResult() as  $row)
              {
             if ($session->get('tipo')=='jefe') { ?>
                
                  <tr>
                    <td class="text-center" ><?php echo $indice;?></td>
                    <td class="text-center" ><?php echo $row->nombres.' '.$row->primerApellido.' '.$row->segundoApellido;?></td>
                    <td class="text-center" ><?php echo $row->nroInforme;?></td>
                    <td ><?php echo $row->informe;?></td>
                    <td class="text-center" ><?php echo formatearFecha($row->fechaInicio);?></td>
                    <td class="text-center" ><?php echo formatearFecha($row->fechaConclusion);?></td>
                     <td class="text-center">
                        <?php echo form_open_multipart('actividadesrecuperarbd');?>
                            <input type="hidden" name="idInforme" value="<?php echo $row->idInforme;?>" >
                            <button type="submit" class="btn btn-warning" ><i class="fa fa-database"></i>   Recuperar</button>
                        <?php echo form_close();?>
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

<?= $this->endSection() ?>