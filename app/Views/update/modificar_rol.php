<?= $this->extend('layouts/misrecursos') ?>
<?= $this->section('content') ?>
<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
      <h5>MODIFICAR USUARIO</h5>              
    </div> 
    <hr>
    <?php 
        foreach ($infousuario->getResult() as $row) {
        echo form_open_multipart('usuariosmodificarrolbd');
        ?>
        <input type="hidden" name="idUsuario" value="<?php echo $row->idEmpleado; ?>"required>
      <div class="row">
        <div class="col-md-6">
         <label class="float-left">NOMBRE(S) Y APELLIDO(S):</label>
          <input type="text" name="nombreCompleto" class="col-md-12 form-control" value="<?php echo $row->nombres.' '.$row->primerApellido.' '.$row->segundoApellido;?>" disabled="true">
        </div>
        <div class="col-md-6">
         <label > NOMBRE DE USUARIO:</label>
          <input type="text" name="usuario" class="col-md-12 form-control" autocomplete="off" value="<?php echo $row->usuario; ?>" disabled="true" ><br>
        </div>
      </div><br>
      <div class="row">
        <div class="col-md-6">
         <label >ROL:</label>
          <select name="tipo" class="col-md-12 form-control" autocomplete="off">
            <option><?php echo $row->tipo; ?></option>
            <option value="jefe">Administrador</option>
            <option value="ejecutor">Ejecutor</option>
            <option value="inspector">Usuario Externo</option>
          </select>
        </div>
        <p style="color: red;"><?php echo isset($validation) && $validation->hasError('tipo') ? $validation->getError('tipo') : ''; ?></p>
      </div>
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
                  <button type="button" class="btn-sm" data-dismiss="modal"><i class="fa fa-remove (alias)"></i>  Cancelar</button>
                  <button type="submit" class="btn-sm"><i class="fa fa-edit (alias)"></i>  Modificar</button>
                </div>
              </div>
            </div>
          </div>

      <?php 
      echo form_close();
      }
      echo form_open_multipart('usuariosindex');
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