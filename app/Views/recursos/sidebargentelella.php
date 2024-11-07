<?php $session=session();?>
<div class="container body" id="menu1" >
    <div class="main_container"  >
      <div class="col-md-3 left_col" id="menu1" >
        <div class="left_col scroll-view" id="menu1" >
          <div class="navbar nav_title" style="border: 0;" id="menu1" >
            <a href="<?php echo base_url()."panelprincipal";?>" class="site_title"><i class="fa fa-folder"></i>   <span style=" font-weight: bold; " >      W.P.S</span></a>
          </div>

          <div class="clearfix" id="menu1"></div>

          <!-- menu profile quick info -->
          
          <!-- /menu profile quick info -->

          <br />

          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
              <h3 style="font-size: 18px; font-weight: bold;">MÓDULOS</h3>
              <ul class="nav side-menu">
              <?php
              if ($session->get('tipo')=='jefe') {?>
                <li><a style="color: white; font-weight: bold;"><i class="fa fa-male" style="color: white;"></i>Funcionarios<span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li>
                      <?php echo form_open_multipart('empleadosindex');?>
                        <button type="submit" class="btn btn-dark btn-sm text-left w-100" style="background-color: transparent; border: none;" >Funcionarios</button>
                      <?php echo form_close();?>
                    </li>
                    <li>
                      <?php echo form_open_multipart('usuariosindex');?>
                        <button type="submit" class="btn btn-dark btn-sm text-left w-100" style="background-color: transparent; border: none;" >Usuarios</button>
                      <?php echo form_close();?>
                    </li>
                  </ul>
                </li>
              <?php }
              if ($session->get('tipo')=='jefe' || $session->get('tipo')=='ejecutor') {?>
                <li><a style="color: white; font-weight: bold;"><i class="fa fa-folder-open" style="color: white;"></i>Papeles de Trabajo<span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li>
                      <?php echo form_open_multipart('actividadesindex');?>
                        <button type="submit" class="btn btn-dark btn-sm text-left w-100" style="background-color: transparent; border: none;" >Mis Actividades</button>
                      <?php echo form_close();?>
                    </li>
                    <li>
                      <?php echo form_open_multipart('pendientesindex');?>
                        <button type="submit" class="btn btn-dark btn-sm text-left w-100" style="background-color: transparent; border: none;" >Papeles de Trabajo</button>
                      <?php echo form_close();?>
                    </li>
                  </ul>
                </li>
                <?php } if ($session->get('tipo')=='inspector') { ?>
                  <li><a style="color: white; font-weight: bold;"><i class="fa fa-folder-open" style="color: white;"></i>Papeles de Trabajo<span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li>
                      <?php echo form_open_multipart('actividadesins');?>
                        <button type="submit" class="btn btn-dark btn-sm text-left w-100" style="background-color: transparent; border: none;" >Mis Actividades</button>
                      <?php echo form_close();?>
                    </li>
                  </ul>
                </li>
              <?php }?>
            </div>
        </div>
          <!-- /sidebar menu -->

          <!-- /menu footer buttons -->
          <div class="sidebar-footer hidden-small" id="menu1">