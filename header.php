<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
  <title>Mi cuenta | Oferta Complementaria</title>
  <link rel="icon" href="./assets/logoSena.png">
  <meta property="og:title" content="Mi cuenta | Oferta Complementaria">
  <meta name="csrf-param" content="authenticity_token" />
  <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="http://cdn.tutorialzine.com/misc/enhance/v2.js" async></script>
  <script src="./assets/main.js"></script>

  <meta name="csrf-token" content="sD0hPoBuliGFd5InGhre2tEwqBOWq5IyYKAr5Wcj/6NdVI39jnyEqFx6JUMBQiSF2YRkJZbYZjp8VUo/qVtfog==" />
  <link rel="stylesheet" media="all" href="./assets/general.css" data-turbolinks-track="reload" />
  <link rel="stylesheet" media="screen" href="./assets/grupos.css" />
  <script src="./assets/general.js" data-turbolinks-track="reload"></script>
  <style type="text/css">
    .footer_new {
      display: flex;
      text-align: center;
      height: auto;
      bottom: 0;
      text-align: center;
      font-size: 15px;
      width: 100%;
      
      background-color: #00AF00;
      color: white;
    }
  </style>
</head>
<body>
<?php
if (isset($_SESSION['rol'])) {
  echo '<div class="navHeader">
  <div class = "container">
    <div class="row">
      <div class="col-md-12">        
        <div >
                      <a href="./index.php"><img width="215px" src="./assets/Logosimbolo.png" alt="Logosena" /></a>
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
                                      <a href="index.php"><img width="215px" src="./assets/Logosimbolo.png" alt="Logosena" /></a>
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
            <a href="cursosReg.php">
              <i class="fa fa-list-ul fa-fw hidden-md hidden-lg" aria-hidden="true"></i> CURSOS
            </a>
          </li>
          <li class="menu">
                          <a href="./noticias.php">
                <i class="fa fa-list-ul fa-fw hidden-md hidden-lg" aria-hidden="true"></i>NOTICIAS
              </a>
            
          </li>
          <li>
        
                        <a href="./perfil.php">
                <i class="fa fa-user fa-fw hidden-md hidden-lg" aria-hidden="true"></i> '.$_SESSION['nombre'].' '. $_SESSION['apellido'].'  </a>
                        <li class="hidden-xs hidden-sm">
                              <img  class="NavBar-Nav-icon btn-PopUpLogin" src="././assets/default-user-img.jpg" alt=""><!--</foto>-->
                          </li>
          </ul>
        </nav>
        <i class="fa fa-bars hidden-md hidden-lg btn-mobile-menu show-menu-mobile" aria-hidden="true"></i>
      </div>
    </div>
  </div>
</div>
</div>
    <div class="mt-4 PopUpContainer">
        <div class="contentContainer">
        </div>
        
 <section class="full-width PopUpLogin PopUpLogin-2">
  <div class="full-width">
    <a href="perfil.php"><i class="fa fa-user fa-fw" aria-hidden="true"></i> Tu perfil</a>
    <a href="./vivuWeb/Poa.php"><i class="fa fa-user fa-fw" aria-hidden="true"></i> Gestion Poa</a>'; 
    if ($_SESSION['rol']==1){echo '<a href="./vivuWeb/tablero.php"><i class="fa fa-user fa-fw" aria-hidden="true"></i>Configuracion</a>';} 
   echo ' <a href="./vivuWeb/planeacion.php"><i class="fa fa-user fa-fw" aria-hidden="true"></i> Planeacion</a>
     
    
    
<a href="./vivuWeb/Poa2.php"><i class="fa fa-user fa-fw" aria-hidden="true"></i>Otros Poa asignados</a>    
    
    <div role="separator" class="divider"></div>
    <a rel="nofollow" data-method="delete" href="logout.php">
      <i class="fa fa-sign-out fa-fw" aria-hidden="true"></i>Cerrar sesión
    </a>            
  </div>
</section>    </div>';
}else { echo '<div class="navHeader">
  <div class = "container">
    <div class="row">
      <div class="col-md-12">        
        <div >
                      <a href="./index.php"><img width="215px" src="./assets/Logosimbolo.png" alt="Logosena" /></a>
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
                                      <a href="index.php"><img width="215px" src="./assets/Logosimbolo.png" alt="Logosena" /></a>
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
            <a href="cursosReg.php">
              <i class="fa fa-list-ul fa-fw hidden-md hidden-lg" aria-hidden="true"></i> CURSOS
            </a>
          </li>
          <li class="menu">
                          <a href="./noticias.php">
                <i class="fa fa-list-ul fa-fw hidden-md hidden-lg" aria-hidden="true"></i>NOTICIAS
              </a>
            
          </li>
          <li>
        
                        <a href="./sign_in.php">
                <i class="fa fa-user fa-fw hidden-md hidden-lg" aria-hidden="true"></i> INICIAR SESION  </a>
                        <li class="hidden-xs hidden-sm">
                              <img  class="NavBar-Nav-icon btn-PopUpLogin" src="././assets/default-user-img.jpg" alt=""><!--</foto>-->
                          </li>
          </ul>
        </nav>
        <i class="fa fa-bars hidden-md hidden-lg btn-mobile-menu show-menu-mobile" aria-hidden="true"></i>
      </div>
    </div>
  </div>
</div>
</div>
    <div class="mt-4 PopUpContainer">
        <div class="contentContainer">
        </div>
        
 <section class="full-width PopUpLogin PopUpLogin-2">
  <div class="full-width">
    
    
    <a rel="nofollow" data-method="delete" href="sign_in.php">
      <i class="fa fa-sign-out fa-fw" aria-hidden="true"></i>Iniciar sesion
    </a>            
  </div>
</section>    </div>';}

?>








<br>
