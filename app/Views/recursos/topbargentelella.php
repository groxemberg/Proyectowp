                       
          <?php $session=session(); ?>
          </div>
          <!-- /menu footer buttons -->
        </div>
      </div>

      <!-- top navigation -->
      <div class="top_nav" data-placement="top">
        <div class="nav_menu" data-placement="top" id="nav1">
          <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars" style="color: white;"></i> </a>
          </div>

          <nav class="nav navbar-nav">
            <ul class=" navbar-right" >
              <li class="nav-item dropdown open" style="padding-left: 15px; background-color: white;">
                <a href="<?php echo base_url(); ?>gentelella/javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                  <font style="font-weight: bold; color: #636364; font-size: 17px">
                  <?php
                  echo $session->get('usuario');?></font>
                </a>
                <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="<?php echo base_url()."panelprincipal";?>" > Inicio</a>
                  <?php echo form_open_multipart('usuarios/logout');//CONTROL PARA CERRAR SESIÓN ?> 
                        <button type="submit" class="dropdown-item"  ><i class="fa fa-sign-out pull-right"></i>Cerrar Sesión</button>
                    <?php echo form_close();?>
                </div>
              </li>

              <li role="presentation" class="nav-item dropdown open">
                
                <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">
                  <li class="nav-item">
                    <a class="dropdown-item">
                      <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                      <span>
                        <span>John Smith</span>
                        <span class="time">3 mins ago</span>
                      </span>
                      <span class="message">
                        Film festivals used to be do-or-die moments for movie makers. They were where...
                      </span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <div class="text-center">
                      <a class="dropdown-item">
                        <strong>See All Alerts</strong>
                        <i class="fa fa-angle-right"></i>
                      </a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </nav>
        </div>
      </div>
<div class="right_col" role="main">
 <div class="">

