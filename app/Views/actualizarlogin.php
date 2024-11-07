<?php $session = session(); ?>
<div class="container">
  <div class="login_wrapper">
    <div class="animate form login_form">
      <section class="login_content">
        <div id="aw" class="container md-3">
          <div id="identified1" class="card-body">
            <h1 style="margin:5px;">CAMBIO DE CLAVE</h1>
            <br>
            <?php
              echo form_open_multipart('actualizarcontrasena', array('id' => 'form1', 'onsubmit' => 'return validarContrasena()'));
            ?>
            <input type="hidden" name="idUsuario" value="<?php echo $session->get('idUsuario'); ?>">
            <?php if ($msg == '1') { ?>
              <p id="validar">(*) Error de contraseña</p>
            <?php } ?>
            <!-- Contraseña actual -->
            <div class="col-md-12 form-group has-feedback">
              <span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
              <input type="password" class="form-control has-feedback-left" name="contrasena" placeholder="Contraseña actual" autocomplete="off" id="password1">
              <span class="form-control-feedback right" style="cursor: pointer;" onclick="mostrar('password1', 'slash', 'eye')">
                <i id="slash" class="fa fa-eye-slash"></i>
                <i id="eye" class="fa fa-eye"></i>
              </span>
            </div>

            <!-- Nueva contraseña -->
            <div class="col-md-12 form-group has-feedback">
              <span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
              <input type="password" class="form-control has-feedback-left" name="nuevacontrasena" placeholder="Nueva contraseña" autocomplete="off" id="password2">
              <span class="form-control-feedback right" style="cursor: pointer;" onclick="mostrar('password2', 'vi', 'novi')">
                <i id="vi" class="fa fa-eye-slash"></i>
                <i id="novi" class="fa fa-eye"></i>
              </span>
            </div>

            <!-- Confirmación de la nueva contraseña -->
            <div class="col-md-12 form-group has-feedback">
              <span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
              <input type="password" class="form-control has-feedback-left" name="repitacontrasena" placeholder="Repita contraseña" autocomplete="off" id="password3">
              <p style="color: red;"><?php echo isset($validation) && $validation->hasError('nuevacontrasena') ? $validation->getError('nuevacontrasena') : ''; ?></p>
              <span class="form-control-feedback right" style="cursor: pointer;" onclick="mostrar('password3', 'vi2', 'novi2')">
                <i id="vi2" class="fa fa-eye-slash"></i>
                <i id="novi2" class="fa fa-eye"></i>
              </span>
              <?php if ($msg == '2') { ?>
                <p style="margin:0px;">(*) Contraseñas nuevas no coinciden</p>
              <?php } ?>
            </div>

            <!-- Botón de actualización -->
            <div class="col-md-12">
              <button type="submit" class="col-md-12 form-group btn btn-dark">
                <i class="fa fa-sign-in"></i> Actualizar
              </button>
            </div>
            <?php echo form_close(); ?>
            
            <!-- Botón de cancelar -->
            <?php echo form_open_multipart('usuariosindex2/0'); ?>
            <div class="col-md-12 form-group has-feedback float-right">
              <button class="col-md-12 form-group btn btn-dark" type="submit">
                <i class="fa fa-remove (alias)"></i> Cancelar
              </button>
            </div> 
            <?php echo form_close(); ?>
          </div>
        </div>
      </section>
    </div>
  </div>
  <h1 id="proyecto">W.P.S.</h1>

  <script>
    function validarContrasena() {
      var nuevaContrasena = document.getElementById("password2").value;
      var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{4,8}$/;
      
      if (!regex.test(nuevaContrasena)) {
        alert("La nueva contraseña debe contener al menos una letra mayúscula, una letra minúscula, un número y un carácter especial, con una longitud mínima de 4 y máxima de 8 caracteres.");
        return false;
      }
      return true;
    }

    function mostrar(inputId, slashId, eyeId) {
      var passwordField = document.getElementById(inputId);
      var slashIcon = document.getElementById(slashId);
      var eyeIcon = document.getElementById(eyeId);
      
      if (passwordField.type === 'password') {
        passwordField.type = "text";
        slashIcon.style.display = "block";
        eyeIcon.style.display = "none";
      } else {
        passwordField.type = "password";
        slashIcon.style.display = "none";
        eyeIcon.style.display = "block";
      }
    }
  </script>
</div>
