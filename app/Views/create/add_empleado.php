<?= $this->extend('layouts/misrecursos') ?>
<?= $this->section('content') ?>

<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
      <h5 style="font-weight: bold;">DATOS DE FUNCIONARIO</h5>              
    </div>
    <hr>
    <?php
    echo form_open_multipart('empleadosagregarbdd');
    ?>
    <div class="row">
      <div class="col-md-4">
        <label class="float-left">NOMBRE(S):</label>
        <input type="text" name="nombres" class="col-md-12 form-control" placeholder="Ingrese el nombre completo" autocomplete="off" value="<?php echo set_value('nombres'); ?>" onfocus="showMessage(this)" onblur="hideMessage(this)">
        <p class="input-message" style="display: none; color: red;">(*) Campo obligatorio</p> <br>
        <p style="color: red;"><?php echo isset($validation) && $validation->hasError('nombres') ? $validation->getError('nombres') : ''; ?></p>
      </div>
      <div class="col-md-4">
        <label class="float-left">PRIMER APELLIDO:</label>
        <input type="text" name="primerApellido" class="col-md-12 form-control" placeholder="Ingrese el primer apellido" autocomplete="off" onfocus="showMessage(this)" onblur="hideMessage(this)">
        <p class="input-message" style="display: none; color: red;">(*) Campo obligatorio</p> <br>
        <p style="color: red;"><?php echo isset($validation) && $validation->hasError('primerApellido') ? $validation->getError('primerApellido') : ''; ?></p>
      </div>
      <div class="col-md-4">
        <label class="float-left">SEGUNDO APELLIDO:</label>
        <input type="text" name="segundoApellido" class="col-md-12 form-control" placeholder="Ingrese el segundo apellido" autocomplete="off" onfocus="showMessage(this)" onblur="hideMessage(this)">
        <p class="input-message" style="display: none; color: red;">(*) Campo opcional</p>
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-md-4">
        <label class="float-left">CÉDULA DE IDENTIDAD:</label>
        <input type="text" name="ci" class="col-md-12 form-control" placeholder="Ingrese el número de ci." autocomplete="off" value="<?php echo set_value('ci'); ?>" onfocus="showMessage(this)" onblur="hideMessage(this)">
        <p class="input-message" style="display: none; color: red;">(*) Campo obligatorio</p> <br>
        <p style="color: red;"><?php echo isset($validation) && $validation->hasError('ci') ? $validation->getError('ci') : ''; ?></p>
      </div>
      <div class="col-md-4">
        <label class="float-left">EXPEDICIÓN:</label>
        <select name="expedicion" class="col-md-12 form-control" autocomplete="off" value="<?php echo set_value('expedicion'); ?>" onfocus="showMessage(this)" onblur="hideMessage(this)">
          <option value="">Seleccione...</option>
          <option value="CH">CH</option>
          <option value="LP">LP</option>
          <option value="CB">CB</option>
          <option value="OR">OR</option>
          <option value="PT">PT</option>
          <option value="TJ">TJ</option>
          <option value="SC">SC</option>
          <option value="BE">BE</option>
          <option value="PD">PD</option>
        </select>
        <p class="input-message" style="display: none; color: red;">(*) Campo obligatorio</p> <br>
        <p style="color: red;"><?php echo isset($validation) && $validation->hasError('expedicion') ? $validation->getError('expedicion') : ''; ?></p>
      </div>
    </div>
    <br>
    <hr>
    <div class="x_title text-center">
      <h5 style="font-weight: bold;">DATOS DE USUARIO</h5>              
    </div>
    <div class="row">
      <div class="col-md-4">
        <label class="float-left">NOMBRE DE USUARIO:</label>
        <input type="text" name="usuario" class="col-md-12 form-control" placeholder="Ingrese el Usuario" autocomplete="off" value="<?php echo set_value('usuario'); ?>" onfocus="showMessage(this)" onblur="hideMessage(this)">
        <p class="input-message" style="display: none; color: red;">(*) Campo obligatorio</p> <br>
        <p style="color: red;"><?php echo isset($validation) && $validation->hasError('usuario') ? $validation->getError('usuario') : ''; ?></p>
        <?php if ($msg == '1') { ?>
          <p style="color: red;">(*) Agregue otro usuario</p>
        <?php } ?>
      </div>
      <div class="col-md-4">
        <label class="float-left">ROL:</label>
        <select name="tipo" class="col-md-12 form-control" autocomplete="off" value="<?php echo set_value('tipo'); ?>" onfocus="showMessage(this)" onblur="hideMessage(this)">
          <option value="">Seleccione...</option>
          <option value="jefe">Jefe</option>
          <option value="ejecutor">Ejecutor</option>
          <option value="inspector">Inspector</option>
        </select>
        <p class="input-message" style="display: none; color: red;">(*) Campo obligatorio</p> <br>
        <p style="color: red;"><?php echo isset($validation) && $validation->hasError('tipo') ? $validation->getError('tipo') : ''; ?></p>
      </div>
      <div class="col-md-4">
        <label class="float-left">CONTRASEÑA:</label>
        <input type="password" name="contrasena" class="form-control" placeholder="Ingrese la contraseña" autocomplete="off" id="password1" value="<?php echo set_value('contrasena'); ?>" onfocus="showMessage(this)" onblur="hideMessage(this)">
        <p class="input-message" style="display: none; color: red;">(*) Campo obligatorio</p>
        <span class="form-control-feedback right" style="cursor: pointer; margin: 35px 0px 0px 0px;" onclick="hideshow()">
          <i id="slash" class="fa fa-eye-slash"></i>
          <i id="eye" class="fa fa-eye"></i>
        </span>
        <p style="color: red;"><?php echo isset($validation) && $validation->hasError('contrasena') ? $validation->getError('contrasena') : ''; ?></p>
        <?php if ($msg == '2') { ?>
          <p>(*) Agregue otra contraseña</p>
        <?php } ?>
      </div>
    </div>
    <hr>
    <div class="row float-right">
      <button type="submit" class="btn-sm"><i class="fa fa-database"></i> Guardar</button>
      <?php
      echo form_close();
      echo form_open_multipart('empleadosindex');
      ?>
      <button type="submit" class="btn-sm" id="botright"><i class="fa fa-remove (alias)"></i> Cancelar</button>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>

<script>
  function hideshow() {
    var password = document.getElementById("password1");
    var slash = document.getElementById("slash");
    var eye = document.getElementById("eye");

    if (password.type === 'password') {
      password.type = "text";
      slash.style.display = "block";
      eye.style.display = "none";
    } else {
      password.type = "password";
      slash.style.display = "none";
      eye.style.display = "block";
    }
  }

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