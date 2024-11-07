<?= $this->extend('layouts/misrecursos') ?>
<?= $this->section('content') ?>

<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
      <h5 style="font-weight: bold; color: white; " >SUBIR PAPELES DE TRABAJO</h5>              
    </div> <hr>
   
    <?php
      echo form_open_multipart('pendientesagregarbdd');
      ?>
    
      <div class="row">
        <div class="col-md-12">
          <input type="hidden" name="idInforme" value="<?php echo $_POST['idInforme'];?>">
          <input type="hidden" name="nroInforme" value="<?php echo $_POST['nroInforme'];?>">
          <input type="hidden" name="estado" value="<?php echo $_POST['estado'];?>">
       
          <div class="drag-drop">
            <input type="file" name="archivos[]" multiple required id="photo"><br>
            <span class="fa-stack fa-2x">
              <i class="fa fa-cloud fa-stack-2x bottom pulsating"></i>
              <i class="fa fa-circle fa-stack-1x top medium"></i>
              <i class="fa fa-arrow-circle-up fa-stack-1x top"></i>
            </span>
            <span class="desc">Pulse aquí para añadir archivos</span>
            <span id="fileLabel"></span> <!-- Este elemento mostrará la cantidad de archivos seleccionados -->
          </div>
        </div>
      </div>
        <hr>
      <div class="row float-right">
        <button type="submit" class="btn-sm"><i class="fa fa-database" value="Agregar"></i>  Guardar</button>
         <?php 
        echo form_close();
        echo form_open_multipart('controller_pendientes/index');
          ?>
          <button type="submit" class="btn-sm" id="botright"><i class="fa fa-remove (alias)"></i>  Cancelar</button>
        <?php echo form_close();?>
      </div>
 </div>
  </div>
</div>
</div>

 <style type="text/css">
    
/* Estilo del área del input[file] */
.drag-drop {
height: 20em;
width: 20em;
background-color: white;
border-radius: 10em;
text-align: center;
color: black;
position: relative;
margin: 0 auto 1em;
}
 
.drag-drop span.desc {
display: block;
font-size: .9em;
padding: 0 .5em;
color: black;
text-align: center;
}
 
input[type="file"] {
height: 10em;
opacity: 0;
position: absolute;
top: 0;
left: 0;
width: 100%; 
z-index: 5;
}
 
/* Estilo del área del input[file] con :hover */
 
.drag-drop:hover, input[type="file"]:hover {
background-color: #900703;
cursor: pointer;
}
 
.drag-drop:hover span.desc {
color: #fff;
} 
 
/* Composición del icono de Upload con FontAwesome */
.fa-stack { padding: 50px;}
 
.fa-stack .top { color: white; }
 
.fa-stack .medium { 
color: black;
text-shadow: 0 0 .25em #666;
}
 
.fa-stack .bottom { color: rgba(225, 225, 225, .75); }
 </style>

 <script>
    document.getElementById('photo').addEventListener('change', function (e) {
        var label = document.getElementById('fileLabel');
        if (e.target.files.length === 1) {
            label.innerHTML = e.target.files.length + ' archivo seleccionado';
        } else {
            label.innerHTML = e.target.files.length + ' archivos seleccionados';
        }
    });
</script>


<?= $this->endSection() ?>