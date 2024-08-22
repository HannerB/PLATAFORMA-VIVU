<!-- ====== Barra de navegacion ======-->
<div class="navHeader">
  <div class = "container">
    <div class="row">
      <div class="col-md-12">        
        <div >
          <?php 
          
          $nombre_carpeta = "";
          
          
          if ($nombre_carpeta == "cursos"): ?>
            <a href="../index.php"><img width="215px" src="../assets/Logosimbolo.png" alt="Logosena" /></a>
          <?php else: ?>
            <a href="index.php"><img width="215px" src="assets/Logosimbolo.png" alt="Logosena" /></a>
          <?php endif; ?>
        </div>
        <nav class=" full-width NavBar-Nav">
          <div class="full-width NavBar-Nav-bg hidden-md hidden-lg show-menu-mobile"></div>
          <ul class="list-unstyled menu-mobile-c mr-1">
            <div class="full-width hidden-md hidden-lg header-menu-mobile">
              <i class="fa fa-times header-menu-mobile-close-btn show-menu-mobile" aria-hidden="true"></i>
              <div class="row">
                <div class="col-md-12">
                 <center>
                  <div >
                  <?php if ($nombre_carpeta == "cursos"): ?>
                    <a href="index.php"><img width="215px" src="../assets/Logosimbolo.png" alt="Logosena" /></a>
                  <?php else: ?>
                    <a href="index.php"><img width="215px" src="./assets/Logosimbolo.png" alt="Logosena" /></a>
                  <?php endif; ?>
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
              <i class="fa fa-list-ul fa-fw hidden-md hidden-lg" aria-hidden="true"></i>APE
            </a>
          </li> 
          <li class="menu">
          
              <a href="cursosReg.php">
                <i class="fa fa-list-ul fa-fw hidden-md hidden-lg" aria-hidden="true"></i>CURSOS
              </a>
            
              
            
          </li> 
          <li class="menu">
            
              <a href="./noticias.php">
                <i class="fa fa-list-ul fa-fw hidden-md hidden-lg" aria-hidden="true"></i>NOTICIAS
              </a>
            
             
            

          </li>
          <li>
            <?php if ($nombre_carpeta == "cursos"): ?>
              <a href="../vivu/perfil.php">
                <i class="fa fa-user fa-fw hidden-md hidden-lg" aria-hidden="true"></i><?php echo strtoupper($user[1]." ".$user[2]); ?>
              </a>
            <?php else: ?>
              <a href="./perfil.php">
                <i class="fa fa-user fa-fw hidden-md hidden-lg" aria-hidden="true"></i><?php echo strtoupper($user[1]." ".$user[2]); ?>
              </a>
            <?php endif; ?>
            
          </li>
          <li class="hidden-xs hidden-sm">
              <!--Verifica si el usuario actual tiene <foto-->
            <?php if ($nombre_carpeta == "cursos"): ?>
              <img  class="NavBar-Nav-icon btn-PopUpLogin" src="../assets/<?php echo $user[15];?>" alt="">
            <?php else: ?>
              <img  class="NavBar-Nav-icon btn-PopUpLogin" src="assets/<?php echo $user[15];?>" alt="">
            <?php endif; ?>
                <!--</foto>-->
          </li>
          </ul>
        </nav>
        <i class="fa fa-bars hidden-md hidden-lg btn-mobile-menu show-menu-mobile" aria-hidden="true"></i>
      </div>
    </div>
  </div>
</div>
</div>
