<?= $this->extend('layouts/misrecursos') ?>
<?= $this->section('content') ?>

<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
        <h5>MODIFICAR ACTIVIDAD</h5> 
    </div>
      <?php 
        foreach ($infoactividad->getResult() as $row) {
        echo form_open_multipart('actividadesmod');
        ?>
        <input type="hidden" name="idInforme" value="<?php echo $row->idInforme; ?>">
      <div class="row">
        <div class="col-md-2">
          <label >TIPO INFORME:</label>
          <select name="tipoInforme" id="tipoInforme" class="col-md-12 form-control" autocomplete="off" onfocus="showMessage(this)" onblur="hideMessage(this)">
              <option> <?php echo $row->tipoInforme; ?></option>
              <option value="P" >P</option>
              <option value="NP">NP</option>
          </select> <br>
          <span class="input-message" style="display: none; color: red;">(*) Campo obligatorio</span>
        </div>
        <div class="col-md-2">
          <label>NRO. INFORME:</label>
          <input type="text" name="nroInforme" id="nroInforme" placeholder="" class="col-md-12 form-control" value="<?php echo $row->nroInforme; ?>" autocomplete="off" onfocus="showMessage(this)" onblur="hideMessage(this)">
          <span class="input-message" style="display: none; color: red;">(*) Campo obligatorio</span>
          <p style="color: red;"><?php echo isset($validation) && $validation->hasError('nroInforme') ? $validation->getError('nroInforme') : ''; ?></p>
        </div>
        <div class="col-md-8">
          <label >INFORME:</label>
          <input type="text" name="informe" class="col-md-12 form-control" placeholder="Ingrese el informe a realizar" autocomplete="off" value="<?php echo $row->informe; ?>" onfocus="showMessage(this)" onblur="hideMessage(this)">
          <span class="input-message" style="display: none; color: red;">(*) Campo obligatorio</span>
          <p style="color: red;"><?php echo isset($validation) && $validation->hasError('informe') ? $validation->getError('informe') : ''; ?></p>
        </div>
      </div> <br>
      <div class="row">
        <div class="col-md-4">
          <label >FECHA DE INICIO:</label>
          <input type="date" name="fechaInicio" class="col-md-12 form-control" value="<?php echo $row->fechaInicio;?>" onfocus="showMessage(this)" onblur="hideMessage(this)">
          <span class="input-message" style="display: none; color: red;">(*) Campo obligatorio</span>
          <p style="color: red;"><?php echo isset($validation) && $validation->hasError('fechaInicio') ? $validation->getError('fechaInicio') : ''; ?></p>
        </div>
        <div class="col-md-4">
          <label >FECHA DE CONCLUSIÓN:</label>
          <input type="date" name="fechaConclusion" class="col-md-12 form-control" value="<?php echo $row->fechaInicio;?>" onfocus="showMessage(this)" onblur="hideMessage(this)">
          <span class="input-message" style="display: none; color: red;">(*) Campo obligatorio</span>
          <p style="color: red;"><?php echo isset($validation) && $validation->hasError('fechaConclusion') ? $validation->getError('fechaConclusion') : ''; ?></p>
        </div>
        <div class="col-md-4">
          <label >FECHA DE PRESENTACIÓN:</label>
          <input type="date" name="fechaPresentacion" class="col-md-12 form-control" value="<?php echo $row->fechaPresentacion;?>" onfocus="showMessage(this)" onblur="hideMessage(this)" >
          <span class="input-message" style="display: none; color: red;">(*) Campo opcional</span>
        </div>
      </div> <br>
      <div class="row">
              
            <div class="col-md-4">
              <label>RESPONSABLE DE EJECUCIÓN:</label>
                <select name="idEmpleado" class="col-md-12 form-control" autocomplete="off" onfocus="showMessage(this)" onblur="hideMessage(this)">
                <option value="<?php echo $row->idEmpleado;?>"><?php echo $row->nombres.' '.$row->primerApellido.' '.$row->segundoApellido;?></option>
                    <?php
                     foreach ($seleccion->getResult() as  $rowa)
                  {?> <option value="<?php echo $rowa->idEmpleado;?>">
                    <?php echo $rowa->nombres.' '.$rowa->primerApellido.' '.$rowa->segundoApellido;?>
                    </option><?php
                    }?>
              </select>
              <span class="input-message" style="display: none; color: red;">(*) Campo obligatorio</span>
            </div>
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
                  <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fa fa-remove (alias)"></i>  Cancelar</button>
                  <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-edit (alias)"></i>  Modificar</button>
                </div>
              </div>
            </div>
          </div>
      <?php echo form_close();
      }     
    echo form_open_multipart('pendientesindex');?>
       <button type="submit" class="btn-sm" id="botright"><i class="fa fa-remove (alias)"></i>  Cancelar</button>
    <?php echo form_close();?>
      </div>
      </div>
      </div>
</div>
</div>
</div>

<script>
  
  function showMessage(input) {
    var message = input.nextElementSibling;
    if (message && message.classList.contains('input-message')) {
      message.style.display = 'block';
    }
  }

  function hideMessage(input) {
    var message = input.nextElementSibling;
    if (message && message.classList.contains('input-message')) {
      message.style.display = 'none';
    }
  }
</script>

<?= $this->endSection() ?>
