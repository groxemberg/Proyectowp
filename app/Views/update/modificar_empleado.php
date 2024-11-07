<?= $this->extend('layouts/misrecursos') ?>
<?= $this->section('content') ?>
<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
      <h5 >MODIFICAR EMPLEADO</h5>              
    </div> <br>
    <?php 
        foreach ($infoempleado->getResult() as $row) {
        echo form_open_multipart('modificarbd');
        ?>
        <input type="hidden" name="idEmpleado" value="<?php echo $row->idEmpleado; ?>">
        <div class="row">
          <div class="col-md-4">
            <label class="float-left">NOMBRE(S):</label>
            <input type="text" name="nombres" class="col-md-12 form-control" placeholder="Ingrese el nombre completo" autocomplete="off" value="<?php echo $row->nombres; ?>"> <br>
            <p style="color: red;"><?php echo isset($validation) && $validation->hasError('nombres') ? $validation->getError('nombres') : ''; ?></p>
          </div>
          <div class="col-md-4">
           <label class="float-left">PRIMER APELLIDO:</label>
            <input type="text" name="primerApellido" class="col-md-12 form-control" placeholder="Ingrese el primer apellido" autocomplete="off" value="<?php echo $row->primerApellido; ?>"> <br>
            <p style="color: red;"><?php echo isset($validation) && $validation->hasError('primerApellido') ? $validation->getError('primerApellido') : ''; ?></p>
          </div>
          <div class="col-md-4">
            <label class="float-left">SEGUNDO APELLIDO:</label>
            <input type="text" name="segundoApellido" class="col-md-12 form-control" placeholder="Ingrese el segundo apellido" autocomplete="off" value="<?php echo $row->segundoApellido; ?>"> <br>
          </div>
        </div> <br>
        <div class="row">
          <div class="col-md-4">
            <label class="float-left">CÉDULA DE IDENTIDAD:</label>
            <input type="text" name="ci" class="col-md-12 form-control" placeholder="Ingrese el número de ci." autocomplete="off" value="<?php echo $row->ci; ?>"> <br>
            <p style="color: red;"><?php echo isset($validation) && $validation->hasError('ci') ? $validation->getError('ci') : ''; ?></p>
          </div>
          <div class="col-md-4">
            <label class="float-left">EXPEDICIÓN:</label>
            <select name="expedicion" class="col-md-12 form-control" autocomplete="off" value="<?php echo set_value('expedicion'); ?>">
              <option> <?php echo $row->expedicion; ?></option>
              <option value="CH">CH</option>
              <option value="LP">LP</option>
              <option value="CB">CB</option>
              <option value="OR">OR</option>
              <option value="PT">PT</option>
              <option value="TJ">TJ</option>
              <option value="SC">SC</option>
              <option value="BE">BE</option>
              <option value="PD">PD</option>
            </select><br>
            <p style="color: red;"><?php echo isset($validation) && $validation->hasError('expedicion') ? $validation->getError('expedicion') : ''; ?></p>
          </div>
        
        </div> <br>
      <hr>
      <div class="row float-right">
      <button type="button" class="btn-sm" data-toggle="modal" data-target="#modalConfirmacion"><i class="fa fa-edit (alias)"></i>  Modificar</button>
      
        <!-- ALERTA PARA ACCIONES-->
          <div class="modal fade" id="modalConfirmacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title text-right" id="exampleModalLongTitle">MODIFICAR</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                   <p style="font-size: 20px;">Estás seguro de modificar los datos?</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fa fa-remove (alias)"></i>  Cancelar</button>
                  <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-edit (alias)"></i>  Modificar</button>
                </div>
              </div>
            </div>
          </div>
      <?php 
      echo form_close();
      }
      echo form_open_multipart('empleadosindex');
        ?>
        <button type="submit" class="btn-sm" id="botright"><i class="fa fa-remove (alias)"></i>  Cancelar</button>
      <?php echo form_close();?>
    </div>
    </div>
    </div>
</div>
</div>
</div>
<?= $this->endSection() ?>