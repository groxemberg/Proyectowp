<?= $this->extend('layouts/misrecursos') ?>
<?= $this->section('content') ?>
<?php 
$session = session();
?>

<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
      <h5>INGRESE LAS ACTIVIDADES A REALIZAR</h5>
      <?php
      echo form_open_multipart('actividadesagregarbdd');
      ?>
    </div>
    <div class="row">
      <div class="col-md-2">
        <label>TIPO INFORME:</label>
        <select name="tipoInforme" id="tipoInforme" class="col-md-12 form-control" value="<?php echo set_value('tipoInforme'); ?>" autocomplete="off" onfocus="showMessage(this)" onblur="hideMessage(this)">
          <option value="">Seleccione... </option>
          <option value="p">P</option>
          <option value="np">NP</option>
        </select> 
        <span class="input-message" style="display: none; color: red;">(*) Campo obligatorio</span>
        <p style="color: red;"><?php echo isset($validation) && $validation->hasError('tipoInforme') ? $validation->getError('tipoInforme') : ''; ?></p>
      </div>
      <div class="col-md-2">
        <label>NRO. INFORME:</label>
        <input type="text" name="nroInforme" id="nroInforme" placeholder="" class="col-md-12 form-control" autocomplete="off" onfocus="showMessage(this)" onblur="hideMessage(this)">
        <span class="input-message" style="display: none; color: red;">(*) Campo obligatorio</span>
        <p style="color: red;"><?php echo isset($validation) && $validation->hasError('nroInforme') ? $validation->getError('nroInforme') : ''; ?></p>
      </div>
      <div class="col-md-8">
        <label>INFORME:</label>
        <input type="text" name="informe" class="col-md-12 form-control" placeholder="Ingrese el informe a realizar" autocomplete="off" value="<?php echo set_value('informe'); ?>" onfocus="showMessage(this)" onblur="hideMessage(this)">
        <span class="input-message" style="display: none; color: red;">(*) Campo obligatorio</span>
        <p style="color: red;"><?php echo isset($validation) && $validation->hasError('informe') ? $validation->getError('informe') : ''; ?></p>
      </div>
    </div> <br>
    <div class="row">
      <div class="col-md-4">
        <label>FECHA DE INICIO:</label>
        <input type="date" name="fechaInicio" placeholder="Ingrese la fecha de inicio" class="col-md-12 form-control" autocomplete="off" value="<?php echo set_value('fechaInicio'); ?>" onfocus="showMessage(this)" onblur="hideMessage(this)">
        <span class="input-message" style="display: none; color: red;">(*) Campo obligatorio</span>
        <p style="color: red;"><?php echo isset($validation) && $validation->hasError('fechaInicio') ? $validation->getError('fechaInicio') : ''; ?></p>
      </div>
      <div class="col-md-4">
        <label>FECHA DE CONCLUSIÓN:</label>
        <input type="date" name="fechaConclusion" class="col-md-12 form-control" placeholder="Ingrese la fecha de conclusión" autocomplete="off" value="<?php echo set_value('fechaConclusion'); ?>" onfocus="showMessage(this)" onblur="hideMessage(this)">
        <span class="input-message" style="display: none; color: red;">(*) Campo obligatorio</span>
        <p style="color: red;"><?php echo isset($validation) && $validation->hasError('fechaConclusion') ? $validation->getError('fechaConclusion') : ''; ?></p>
      </div>
      <div class="col-md-4">
        <label>FECHA DE PRESENTACIÓN:</label>
        <input type="date" name="fechaPresentacion" class="col-md-12 form-control" placeholder="Ingrese la fecha de presentación" autocomplete="off" onfocus="showMessage(this)" onblur="hideMessage(this)">
        <span class="input-message" style="display: none; color: red;">(*) Campo opcional</span>
      </div>
    </div> <br>
    <div class="row">
      <label class="float-right">RESPONSABLE DE EJECUCIÓN:</label>
    </div>
    <div class="col-md-8">
      <select name="idEmpleado" class="col-md-12 form-control" value="<?php echo set_value('idEmpleado'); ?>" autocomplete="off" onfocus="showMessage(this)" onblur="hideMessage(this)">
        <option value="">Seleccione un responsable</option>
        <?php
        foreach ($seleccion->getResult() as $row) {
        ?> <option value="<?php echo $row->idEmpleado; ?>">
          <?php echo $row->nombres . ' ' . $row->primerApellido . ' ' . $row->segundoApellido; ?>
        </option><?php
        }
        ?>
      </select>
      <span class="input-message" style="display: none; color: red;">(*) Campo obligatorio</span>
      <p style="color: red;"><?php echo isset($validation) && $validation->hasError('idEmpleado') ? $validation->getError('idEmpleado') : ''; ?></p>
    </div>
  </div> <br>
  <hr>
  <div class="row float-right">
    <button type="submit" class="btn-sm"><i class="fa fa-database"></i> Guardar</button>
    <?php
    echo form_close();
    echo form_open_multipart('pendientesindex');
    ?>
    <button type="submit" class="btn-sm" id="botright"><i class="fa fa-remove (alias)"></i> Cancelar</button>
    <?php echo form_close(); ?>
  </div>
</div>
</div>
</div>
</div>

<script>
  document.getElementById('tipoInforme').addEventListener('change', function() {
    var tipoInforme = this.value;
    var nroInformeInput = document.getElementById('nroInforme');
    if (tipoInforme === 'p') {
      nroInformeInput.value = 'UAI-P00024';
    } else if (tipoInforme === 'np') {
      nroInformeInput.value = 'UAI-NP00024';
    } else {
      nroInformeInput.value = '';
    }
  });

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

