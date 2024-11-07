
  <?php
    switch ($msg) {
      case '1':
        $mensaje="Gracias por usar el sistema";
        break;

      case '2':
        $mensaje="* Error de usuario o contraseña";
        break;
      case '3':
        $mensaje="Acceso no válido favor inicie sesión";
        break;
      case '4':
        $mensaje="Ingrese su usuario y su nueva contraseña";
       break;
      
      default:
        $mensaje="Ingrese el usuario y contraseña";
        break;
    }
  ?>

  <div  class="login_wrapper">
  <div class="animate form login_form  ">
    <section class="login_content">
      <?php
          echo form_open_multipart('Usuarios/validar',array('id'=>'form1'));
        ?>
      <div id="aw" class="container md-3">
        <div id="identified1" class="card-body ">
          <h1>INICIAR SESIÓN</h1>
          <br>
          <p class="text-center" id="mensaje"><?php echo $mensaje; ?></p>
          <div class="col-md-12 form-group has-feedback">
            <input type="text" class="form-control has-feedback-left" name="usuario" placeholder="Usuario" autocomplete="off" required >
            <span class="fa fa-user form-control-feedback left" aria-hidden="true">
            </span>
          </div>
          <div class="col-md-12 form-group has-feedback">
            <span class="fa fa-key form-control-feedback left" aria-hidden="true">
            </span>
            <input type="password" class="form-control has-feedback-left" name="contrasena" placeholder="Contraseña" autocomplete="off" id="password1">
            <span class=" form-control-feedback right" style="cursor: pointer;"  onclick="hideshow()" >
              <i id="slash" class="fa fa-eye-slash"></i>
              <i id="eye" class="fa fa-eye"></i>
          </span>
          </div>
            
          <div>
            <button class="col-md-12 form-group btn btn-dark" type="submit">
              <i class="fa fa-sign-in"></i> Ingresar
            </button>
          </div>
          
          <div class="clearfix"></div>
          <div class="separator">
            <div class="clearfix"></div>
            <div>
              <h2> Sistema de Papeles de Trabajo</h2>
            </div>
          </div>
            </div>
      </div>
          <?php
          echo form_close();
          ?>         
      
    </section>
    
  </div>

</div>
<h1 id="proyecto">W.P.S.</h1>

<script>
    function hideshow(){
      var password = document.getElementById("password1");
      var slash = document.getElementById("slash");
      var eye = document.getElementById("eye");
      
      if(password.type === 'password'){
        password.type = "text";
        slash.style.display = "block";
        eye.style.display = "none";
      }
      else{
        password.type = "password";
        slash.style.display = "none";
        eye.style.display = "block";
      }

    }
  </script>


       
   



