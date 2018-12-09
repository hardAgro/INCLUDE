<?php 
$porMes = false;
$porHora = false;
$porDia = false;
$porMinuto = false;

if (isset($viewData["id_agrupador"]) && $viewData["id_agrupador"] == 3) {
	$porMes = "checked";

} elseif (isset($viewData["id_agrupador"]) && $viewData["id_agrupador"] == 1) {
	$porHora = "checked";

} elseif (isset($viewData["id_agrupador"]) && $viewData["id_agrupador"] == 2) {
	$porDia = "checked";

} elseif (isset($viewData["id_agrupador"]) && $viewData["id_agrupador"] == 4) {
	$porMinuto = "checked";
}
?>

<div class="row">

	<div class="col-md-12">
		<div class="iot-container">
			
			<?php require_once("views/flash_message/flash_message.php");?>

			<h2 class="iot-chart-title">
				<?php if (isset($viewData["id_view_data"])):?>
			       Editar Componente
			   <?php else:?>
			   	   Criar Componente
			   <?php endif;?>
		    </h2>
			<hr>

			<div class="col-md-12">
				<i class="fa fa-gear"></i> <small>Configurações</small>

				<?php if (isset($viewData["id_view_data"])):?>
	                <br>
	                <a href="#" data-toggle="modal" data-target="#myModalDeletar" 
	                	style="color:#cc0000" title="Quero deletar este Componente">
	                	<i class="fa fa-trash"></i> <small>Deletar Componente</small>
	                </a>
	                <br>
                <?php endif; ?>
                
                <br>
				<b>Segredo:</b> 
				<span style="color:#990000;">
					<?php echo isset($viewData["id_view_data"]) ? $viewData["segredo"] : '';?>	
				</span>

                <br>

				<b>ID da Conta:</b> 
				<span style="color:#990000;">
					<?php echo Session::getSession("id_conta");?>	
				</span>

				<br>
				<br>
			</div>

			<?php if (isset($viewData["id_view_data"])):?>
			    <form method="post" action="?viewData=alterar">
			    <input type="hidden" name="idViewData" value="<?php echo $viewData["id_view_data"];?>">
			<?php else:?>
				<form method="post" action="?viewData=cadastrar">
			<?php endif;?>
		
				<div class="col-md-4 pull-left">
					<div class="form-group">
					    <label for="exampleInputEmail1">Título do Componente *</label>
					    <input type="text" class="form-control" name="nome_view_data" 
					    placeholder="Dê um Título para o seu View Data" id="input_titulo" 
					    value="<?php echo isset($viewData['id_view_data']) ? $viewData['nome_view_data'] : '';?>">
					</div>
				</div>

				<!--<div class="col-md-4 pull-left">
					<div class="form-group">
					    <label for="exampleInputEmail1">Título Eixo X *</label>
					    <input type="text" class="form-control" name="titulo_x" placeholder="Digite um Título"
					    value="<?php //echo isset($viewData['id_view_data']) ? $viewData['titulo_x'] : '';?>">
					</div>
				</div>-->

				<div class="col-md-4 pull-left">
					<div class="form-group">
					    <label for="exampleFormControlSelect1">Tipo de Gráfico *</label>
					    <select class="form-control" id="input_tipo_grafico" name="id_tipo_grafico">
					      <option value="0">Selecione</option>

					      <?php if ($viewData["id_tipo_grafico"] == 2):?>
					      	<option value="2" selected='selected'>Linha</option>
					      <?php else:?>
					      	<option value="2">Linha</option>
					      <?php endif;?>

					      <?php if ($viewData["id_tipo_grafico"] == 3):?>
					      	<option value="3" selected='selected'>Coluna</option>
					      <?php else:?>
					      	<option value="3">Coluna</option>
					      <?php endif;?>

					      
					    </select>
					</div>
				</div>

				<div class="col-md-4 pull-left">
					<div class="form-group">
					    <label for="exampleInputEmail1">Título Eixo Y *</label>
					    <input type="text" class="form-control" name="titulo_y" placeholder="Digite um Título"
					    id="input_eixo_y"
					    value="<?php echo isset($viewData['id_view_data']) ? $viewData['titulo_y'] : '';?>">
					</div>
				</div>

				<div class="col-md-12 pull-left">
					<h5>Agrupadores:</h5>

					<div class="form-group">

						<label class="radio-inline">
							<input type="radio" name="id_agrupador" value="4" <?php echo $porMinuto;?> checked>
						    <span style="padding:5px;">Ultimos 60 Minutos</span>
					    </label>

					    <label class="radio-inline">
					    	<input type="radio" name="id_agrupador" value="1" <?php echo $porHora;?>>
					    	<span style="padding:5px;">Ultimas 24 horas</span>
					    </label>

						<label class="radio-inline">
							<input type="radio" name="id_agrupador" value="2" <?php echo $porDia;?>>
						    <span style="padding:5px;">Ultimos 30 dias</span>
					    </label>

					    <!--<label class="radio-inline">
							<input type="radio" name="id_agrupador" value="3" <?php echo $porMes;?>>
						    <span style="padding:5px;">Ultimos 12 meses</span>
					    </label>-->
                        
                        <?php if (isset($viewData["id_view_data"])):?>
					        <a href="?viewData=viewData&segredo=<?php echo $viewData["segredo"];?>" 
					        	title="Visualizar Grafico">
					        	<i class="fa fa-eye"></i> Visualizar
					        </a>
					    <?php endif;?>

					</div>

				</div>

				<div class="col-md-12">
					<div class="form-group pull-right">
					    <button type="submit" class="btn btn-primary" id="cadastrar">
					        <i class="fa fa-save"></i> Salvar
					    </button>
					</div>
				</div>
             
			</form>

            
			<div style="clear:both;"></div>
			<br>
		</div>
	</div>
	
</div>



<!-- Modal -->
<div id="myModalDeletar" class="modal fade" role="dialog" data-backdrop="static">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
      	<h4 class="modal-title">Deletar Componente</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div class="modal-body">
        <center><p style="font-size:50px"><i class="fa fa-surprise"></i></p></center>
        <center>
        	<p>
        	    É sério que você vai deleter este componente? <br>
        	    Saiba que dados são muito importantes. <br>Mas eu não posso te impedir! <br>
        	    Sendo assim, aperte em (Sim) e fique a vontade! <br><br>Essa tarefa pode demorar um pouco! 
           </p>
        </center>
      </div>
      <div class="modal-footer">
      	<?php $idComponente = Input::inGet("idViewData");?>
      	<a href="?viewData=deletarComponente&idComponente=<?php echo $idComponente;?>" 
      		class="btn btn-danger"><i class="fa fa-trash"></i> Sim</a>
      </div>
    </div>

  </div>
</div>

<script src="public/vendor/jquery/jquery.min.js"></script>
<script>
	$(function() {

		$("#cadastrar").click(function() {

			if ($("#input_titulo").val() == "") {
				$("#exampleModalLabel").html("Validação");
				$("#into-modal").html("<center><h4>O campo Título é obrigatório</h4></center>");
				$("#exampleModal").modal();
				return false;
			}

			else if ($("#input_tipo_grafico").val() == 0) {
				$("#exampleModalLabel").html("Validação");
				$("#into-modal").html("<center><h4>O campo Tipo de Gráfico é obrigatório</h4></center>");
				$("#exampleModal").modal();
				return false;
			}

			else if ($("#input_eixo_y").val() == "") {
				$("#exampleModalLabel").html("Validação");
				$("#into-modal").html("<center><h4>O campo Eixo y é obrigatório</h4></center>");
				$("#exampleModal").modal();
				return false;
			}
		});

	});
</script>
