<style>
  .titulo_componente {
    display:block;
    text-align:center;
    color:#2c3e50;
  }
  .descricao_componente {
    text-align:center;
    background:#2c3e50;
    color:white;
  }
  .iot-container {
    height:auto!important;
    padding-bottom:30px!important;
  }
  .card {
    border:0!important;
  }
</style>

<div class="row">

	<div class="col-sm-12">
		<div class="iot-container">
      <?php require_once("views/flash_message/flash_message.php");?>

			<h2 class="iot-chart-title">Meus Componentes</h2>
      <br>
			<div>

        <?php if (count($viewDatas) == 0):?>
           <center><h3>Você ainda não tem Componentes cadastrados!</h3></center>
           <center><a href="?viewData=index" title="Criar Componente!">Cadastrar Componente</a></center>
        <?php endif;?>
        
        <?php $cont = 0; ?>
        <?php foreach ($viewDatas as $data):?>
            
            <div class="card pull-left col-sm-4" style="margin-bottom:10px;margin-bottom:35px!important;height:500px!important">
              <div class="descricao_componente">
                <?php if ($dataDados->getQuantidadeDataByIdComponente($data->id_view_data)):?>
                  <small><i class="fa fa-circle" style="color:green"></i> Componente já recebeu dados</small>
                <?php else:?>
                  <small><i class="fa fa-circle" style="color:gray"></i> Componente nunca recebeu dados</small>
                <?php endif;?>
              </div>

              <?php 
               $background = false;
               $cont++;
               if ($cont % 2 == 0) {
                $background = "background:#abfbab";
               } else {
                $background = "background:#b9e2f4";
               }
              ?>
              <img class="card-img-top" src="public/img/panel_view_data.png" alt="Card image cap"
              style="<?php echo $background;?>">

              <div class="card-body" style="background:#f5f5f5;">
                  <b class="titulo_componente"><?php echo $data->nome_view_data;?></b>  
              
                  <hr>
                  <center>
                    <a class="btn btn-success btn-sm" href="?viewData=viewData&segredo=<?php echo $data->segredo;?>" 
                      title="Visualizar"><i class="fa fa-bar-chart-o"></i> Visualizar
                    </a>
                 
                    <a href="?viewData=editar&idViewData=<?php echo $data->id_view_data;?>" 
                      class="btn btn-secondary btn-sm" title="Editar Componente"><i class="fa fa-edit"></i> Editar
                    </a>

                    <hr>

                    <label for="<?php echo $data->id_view_data;?>" style="color:#2c3e50">
                      Fixar no Dashboard
                      <input type="checkbox" class="mostrarNoDashboard" id="<?php echo $data->id_view_data;?>" 
                      name="mostrar_no_dashboard_<?php echo $data->id_view_data;?>" <?php echo ($data->mostrar_no_dashboard == 1) ? "checked" : "";?>>
                    </label>
                 </center>
              </div>
            </div>
        <?php endforeach;?>
        
        <div style="clear:both;"></div>
        
      </div>
		</div>
	</div>
	
</div>


<!-- Modal -->
<div id="modal_carregando" class="modal fade" role="dialog" data-backdrop="static">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
        <center><img src="public/img/loader.gif"><h4>Aplicando...</h4></center>
      </div>
    </div>

  </div>
</div>

<script src="public/js/jquery.js"></script>
<script>
  $(function() {

    function sleep(ms) {
      return new Promise(resolve => setTimeout(resolve, ms));
    }

    async function demo() {
      await sleep(4000);
      $("#modal_carregando").modal("hide");
    }

    $(".mostrarNoDashboard").each(function() {
      var checkbox = $(this);
        
        checkbox.on("click", function(e) {
          $("#modal_carregando").modal("show");

          var rota = "<?php echo Helper::host();?>/comedataiot/?viewData=marcarMostrarNoDashboard&idViewData="+$(this).attr("id");
          $.get(rota, function(data, item) {
            var objeto = JSON.parse(data);

              if (objeto.status == true) {
                console.log(objeto.status);
                demo();
              }
          });

          e.stopPropagation();
        });

    });
  });
</script>