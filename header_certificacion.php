<!-- ====== Barra de navegacion ======-->
<div class="navHeader">
  <div class = "container">
    <div class="row">
      <div class="col-md-12">        
        <div>
          <a href="micuenta.php"><img width="215px" src="assets/Logosimbolo.png" alt="Logosena" /></a>
        </div>
        <nav class=" full-width NavBar-Nav">
          <div class="full-width NavBar-Nav-bg hidden-md hidden-lg show-menu-mobile"></div>
          <ul class="list-unstyled menu-mobile-c mr-1">
            <div class="full-width hidden-md hidden-lg header-menu-mobile">
              <i class="fa fa-times header-menu-mobile-close-btn show-menu-mobile" aria-hidden="true"></i>
              <div class="row">
                <div class="col-md-12">
                 <center>
                  <div>
                    <a href="micuenta.php"><img width="215px" src="assets/Logosimbolo.png" alt="Logosena"  /></a>
                  </div>
                </center>
              </div>
            </div>
            <div class="divider"></div>
          </div>
          <li class="menu">
            <a href="http://oferta.senasofiaplus.edu.co/sofia-oferta/" target="_blank">
              <i class="fa fa-list-ul fa-fw hidden-md hidden-lg" aria-hidden="true"></i> SOFIAPLUS
            </a>
          </li> 
          <li class="menu">
            <a href="https://agenciapublicadeempleo.sena.edu.co/Paginas/inicio.aspx" target="_blank">
              <i class="fa fa-list-ul fa-fw hidden-md hidden-lg" aria-hidden="true"></i> APE
            </a>
          </li> 
          <li class="menu">
            <a href="consultar_certificaciones.php">
              <i class="fa fa-list-ul fa-fw hidden-md hidden-lg" aria-hidden="true"></i> CERTIFICACION
            </a>
          </li>
          <li class="menu">
            <a href="mis-cursos.php">
              <i class="fa fa-list-ul fa-fw hidden-md hidden-lg" aria-hidden="true"></i> CURSOS OFERTADOS
            </a>
          </li>
          <li>
            <a href="perfil.php">
              <i class="fa fa-user fa-fw hidden-md hidden-lg" aria-hidden="true"></i><?php echo $user['nombres']." ".$user['apellidos']; ?></a>
            </li>
           <li class="hidden-xs hidden-sm">
              <!--Verifica si el usuario actual tiene <foto--><img  class="NavBar-Nav-icon btn-PopUpLogin" src="assets/<?php echo $user['img'];?>" alt=""><!--</foto>-->
             
            </li>
          </ul>
        </nav>
        <i class="fa fa-bars hidden-md hidden-lg btn-mobile-menu show-menu-mobile" aria-hidden="true"></i>
      </div>
    </div>
  </div>
</div>
</div>
