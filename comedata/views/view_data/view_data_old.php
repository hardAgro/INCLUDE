<?php if ( ! isset($_GET["method_get"])):?>
    <meta http-equiv='refresh' content='90'>
<?php endif;?>

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


	<div class="col-sm-12" style="margin-bottom:10px">

		<div class="col-sm-6 bg-maior-encontrado pull-left">
			<div style="padding:10px">
			   <span class="numero-destaque"><?php echo $mediaEdesvioPadrao["media"];?></span>
				<br>
				<span style="opacity:0.80"><i class="fa fa-check-circle"></i> Média</span>
			</div>
		</div>
       
		

		<div class="col-sm-6 bg-desvio-padrao pull-left">
		   <div style="padding:10px">
				<span class="numero-destaque"><?php echo $mediaEdesvioPadrao["desvioPadrao"];?></span>
				<br>
				<span style="opacity:0.80"><i class="fa fa-check-circle"></i> Desvio Padrão</span>
			</div>
		</div>
	</div>

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

<?php if (count($valores) > 0):?>
    
    <?php if (isset($_GET["method_get"])):?>

    	<script type="text/javascript" src="public/js/google_chart.js"></script>
        <script src="public/vendor/jquery/jquery.min.js"></script>

    	<?php require_once("views/{$paginaDoGrafico}.php");?>

    <?php endif;?>

<?php endif;?>

<?php $segredo = Input::inGet("segredo");?>

<?php if ( ! isset($_GET["method_get"])):?>
<script type="text/javascript" src="public/js/google_chart.js"></script>
<script src="public/vendor/jquery/jquery.min.js"></script>
<script>
	$(function() {
		callAjax();
		function callAjax() {
			<?php if (Helper::host() == "http://escoladoarduino.com.br"):?>
			    $("#curve_chart").load(
			    	"<?php echo Helper::host();?>/comedataiot/?viewData=apiInternaViewData&segredo=<?php echo $segredo;?>"
			    );
			<?php else:?>
			    $("#curve_chart").load(
			    	"<?php echo Helper::host();?>/?viewData=apiInternaViewData&segredo=<?php echo $segredo;?>"
			    );
			<?php endif;?>
		}

		/*var time = setInterval(function() {
			callAjax();
		}, 9000);*/
	});
</script>
<?php endif;?>