<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg" style="background-color: #5E1A57;">
  <div class="container-fluid px-4">
    <a class="navbar-brand" href="inicio">
      <img src="./assets/img/logo.svg" alt="IDI" width="40px">
    </a>
    <button class="navbar-toggler" style="color: white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon white"></span>
    </button>
    <div class="collapse navbar-collapse nav-colors" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link nav-colors <?php if($resaltar==1){echo 'bg-danger';}; ?>" 
          aria-current="page" href="inicio">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link nav-colors <?php if($resaltar==2){echo 'bg-danger';}; ?>" 
            href="quienes_somos">Nosotros</a>
        </li>
        <li class="nav-item">
          <a class="nav-link nav-colors <?php if($resaltar==3){echo 'bg-danger';}; ?>" 
          aria-current="page" href="acerca_de">
            Acerca de
          </a>
        </li>
        

         <?php if (session()->id_usuario==null) {?>
                 <li class="nav-item">
              <a class="nav-link nav-colors <?php if($resaltar==4){echo 'bg-danger';}; ?> 
              " aria-current="page" href="login">Ingresar</a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-colors <?php if($resaltar==5){echo 'bg-danger';}; ?> 
              " href="registrarse">Registrarse</a>
            </li>
            <?php };?>

          <?php if (session()->id_usuario!=null) {?>
                 <li class="nav-item">
                <a type="button" class="nav-link nav-colors" data-bs-toggle="modal" data-bs-target="#cierre_sesion">Salir</a>
                </li>
           
            <?php };?>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search">
        <button class="btn btn-outline-light" type="submit">Buscar</button>
      </form>
    </div>
  </div>
</nav>