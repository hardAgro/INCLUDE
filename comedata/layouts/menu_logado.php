<!-- Navigation -->
<nav class="navbar navbar-expand-lg bg-secondary fixed-top text-uppercase" id="mainNav">
  <div class="container">
    
    <img src="public/img/logo.jpg" width="150">
    
    <button id="menu" class="navbar-toggler navbar-toggler-right text-uppercase bg-primary text-white rounded" type="button"  data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      Menu
      <i class="fa fa-bars"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        
        <li class="nav-item mx-0 mx-lg-1">
          <a href="?index=index" class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" 
          title="Inicio">
            Inicio
          </a>
        </li>

        <li class="nav-item mx-0 mx-lg-1">
          <a href="?dashboard=index" class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" 
          title="Dashboard">
            Dashboard
          </a>
        </li>
        
        <?php $idUsuario = Session::getSession("id_usuario");?>
        <li class="nav-item mx-0 mx-lg-1">
          <a href="?viewData=viewDatas&idUsuario=<?php echo $idUsuario;?>" 
            class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" 
          title="Meus componentes">
            Meus Componentes
          </a>
        </li>

        <li class="nav-item mx-0 mx-lg-1">
          <a href="?viewData=index" class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" 
          title="Cariar uma Visualização de Dados">
            Criar Componente
          </a>
        </li>

        <li class="nav-item mx-0 mx-lg-1">
          <a href="?tutorial=index" class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" 
          title="Dicas de Uso">
            Tutoriais
          </a>
        </li>

        <li class="nav-item mx-0 mx-lg-1">
          <a href="?login=logout" class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" 
          title="Sair do Sistema">
            Sair
          </a>
        </li>
        
      </ul>
    </div>
  </div>
</nav>
