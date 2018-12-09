<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <link rel="shortcut icon" href="public/img/favicon.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ComeData IoT</title>

    <!-- Bootstrap core CSS -->
    <link href="public/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="public/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Plugin CSS -->
    <link href="public/vendor/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="public/css/freelancer.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <style>
      body {
        background:#f5f5f5;
        font-family:arial!important;
        background-image:url("public/img/fundo.jpg");
        background-size:100%;
        background-repeat:no-repeat;
        background-attachment:fixed;
      }
      h1, h2, h3, h4 {
        font-family:arial!important;
      }
      #centered {
        margin:0 auto;
      }
      .center-block {
        display: block;
        margin-right: auto;
        margin-left: auto;
      }
      .iot-container {
        background:white;
        border-radius:5px;
        border:1px solid #dcdfe9;
        padding:10px;
      }
      .iot-chart-title {
        color:#f0eded;
        font-family:arial;
        text-align:center;
        display:block;
        font-size:20px;
        margin:0px;
        background:#2c3e50;
        border-radius:3px;
      }
      .alert {
        text-align:center;
      }
      h1, h2, h3, h4, h5 , h6 {
        font-family:candara!important;
      }
      .navbar-nav li a {
        color:white;
        font-family:arial;
        cursor:pointer;
        font-size:12px!important;
      }
      .sub-titulo {
        position:relative;
        z-index:100;
        display:block;
        text-align:center;
        background:#fefaee!important;
        width:100%;
        padding-top:10px;
      }
      #exampleModalLabel {
        opacity:0.80;
      }
      .color-sistema {
        background:#2c3e50;
        border:transparent;
      }
      .color-sistema:hover {
        background:#3d5062;
      }
      .color-sistema:active {
        background:#3d5062!important;
        border:transparent!important;
        color:white!important;
      }

      .menu-data {
        background:white;
        height:50px;
        border-radius:5px;
        margin-bottom:10px;
      }

      .div-media {
        width:100%;
        border:1px solid red;
      }

      .span_media {
        background:silver;
        padding:3px;
        color:white;
        border-radius:3px;
        margin-right:5px;
        display:block;
        width:60px;
        margin:0 auto;
        float:left;
      }
      .media_maxima {
        background:#333366;
      }
      .media_minima {
        background:#990000;
      }

      .ul-chart-info {
        margin:0;
        padding:0;
      }
      .ul-chart-info {
        list-style:none;
        display:block;
        margin:0 auto;
        width:200px;
        /*border:1px solid black;*/
        margin-top:5px;
      }
      .ul-chart-info li {
        color:white;float:left;
        padding:3px;
        width:60px;
        border:1px solid transparent;
      }
      .li-dica {
        background:#f4f1f1;
        color:#666666!important;
        border:1px solid #666666!important;
      }

      .numero-destaque {
        font-size:30px;
        color:white;
        font-weight:bold;
      }
      .bg-maior-encontrado {
        background:#333366!important;
        color:white;
      }
      .bg-menor-encontrado {
        background:#990000!important;
        color:white;
      }
      .bg-desvio-padrao {
        background:#e40f0f!important;
        color:white;
      }
      .bg-variancia {
        background:#36ac34!important;
        color:white;
      }
      .bg-minimo {
        background:#b25519!important;
        color:white;
      }
      .bg-maximo {
        background:#2aad29!important;
        color:white;
      }

      .card {
        max-height:350px!important;
      }
    </style>

  </head>

  <body id="page-top">
   
   <?php if (Session::hasSession("id_usuario")):?>
      <?php require_once("layouts/menu_logado.php");?>
   <?php else:?>
      <?php require_once("layouts/top_menu.php");?>
   <?php endif;?>
  
   <br>

    <!-- Portfolio Grid Section -->
    <section class="portfolio" id="portfolio">
      <div class="container">
        <div id="app">
          <!--Include the content into the layout-->
          <?php require_once($this->content);?>
        </div>
      </div>
    </section>
  

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
    data-backdrop="static">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div id="into-modal">
              
            </div>
          </div>
          <div class="modal-footer">
            
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="public/vendor/jquery/jquery.min.js"></script>
    <script src="public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script>
      $(function() {

        $("#menu").click(function() {
          $(".collapse").toggle();
        })

      });
    </script>

  </body>

</html>