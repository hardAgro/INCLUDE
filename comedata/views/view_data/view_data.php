<!--<meta http-equiv='refresh' content='90'>-->
<div class="row">

	<div class="col-sm-12">
		<div class="menu-data">

			<!--<div class="pull-left">
				<div style="padding-left:5px;padding-top:5px">
					<img style="border-radius:3px" src="<?php //echo session::getSession('usuario_imagem');?>" width="40px">
				</div>
			</div>-->

			<div class="pull-right" style="padding:5px;">

				<?php if (isset($_GET["method_get"])):?>
					<a href="?viewData=viewData&segredo=<?php echo Input::inGet("segredo");?>"
					title="Voltar" class="btn btn-sm btn-secondary"><i class="fa fa-arrow-left"></i> Voltar</a>
				<?php endif;?>
				
				<button 
					<?php if (isset($_GET["method_get"])):?>
					    class="btn btn-sm btn-success" 
				    <?php else:?>
				    	class="btn"
				    <?php endif;?>
					title="Filtrar"
					data-toggle="modal" data-target="#exampleModal">
					<i class="fa fa-filter"></i>
			   </button>

			</div>
			
		</div>		
	</div>

	<?php require_once("views/view_data/view_data_desvio_media.php");?>

	<div class="col-sm-12">
		<div class="iot-container">

			<h2 class="iot-chart-title">
				<?php echo $viewData["nome_view_data"];?>
			</h2>

			<center class="sub-titulo">
				<?php echo $subTitulo;?>
			</center>

			<div id="curve_chart" style="width: 100%; height: 300px">
				<?php if (count($valores) == 0):?>
					<br>
				    <center>
				    	<h3 style="opacity:0.50;">
				    		Nenhum Dado foi encontrado.
				    	</h3>
				    </center>
				<?php endif;?>
			</div>
		</div>
	</div>
	
</div>

<!-- Modal Filtrar-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" 
		aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Filtro por Período</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        
		        <form method="post" action="?viewData=filtrar">
		        	<input type="hidden" name="segredo" value="<?php echo Input::inGet("segredo");?>">

			      	<div class="col-md-6 pull-left">
						<div class="form-group">
						    <label for="exampleInputEmail1">Início</label>
						    <input type="date" class="form-control" name="inicio" 
						    placeholder="" id="input_titulo" required
						    value="<?php echo (isset($_GET["inicio"]) ? $_GET["inicio"] : '') ?>">
						</div>
					</div>
			        
			        <div class="col-md-6 pull-left">
						<div class="form-group">
							<label for="exampleInputEmail1">Fim</label>
							<input type="date" class="form-control" name="fim" 
							 placeholder="" id="input_titulo" required
							 value="<?php echo (isset($_GET["fim"]) ? $_GET["fim"] : '') ?>">
					    </div>
			        </div>
			    
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
			        <button type="submit" class="btn btn-primary"><i class="fa fa-filter"></i> Buscar</button>
			      </div>
			    </form>
		    </div>
		  </div>
	</div>
</div>

<script type="text/javascript" src="public/js/google_chart.js"></script>
<script src="public/vendor/jquery/jquery.min.js"></script>
   
<?php if ($viewData["id_tipo_grafico"] == 2):?>
	<?php require_once("views/graficos/linha/grafico_linha.php");?>
<?php elseif ($viewData["id_tipo_grafico"] == 3):?>
    <?php require_once("views/graficos/coluna/grafico_coluna.php");?>
<?php endif;?>