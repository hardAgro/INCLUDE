<style>
	p {
		display:block;
		margin-top:20px;
		padding:50px;
		font-size:20px;
		color:#666666;
		text-align:center;
	}
	#img_dashboard {
		display:block;
		margin:0 auto;
		width:300px;
	}
	#mg_temporario {
		display:block;
		margin:0 auto!important;
	}
	.area-chart {
		float:left!important;
		margin-top:10px;
	}
	.botao-editar-componente:hover {
		opacity:0.60;
	}
	.dado-nao-encontrado {
		padding:20px;
		font-size: 20px;
	}
</style>

<script type="text/javascript" src="public/js/google_chart.js"></script>
<script src="public/vendor/jquery/jquery.min.js"></script>

<div class="row">
    
	<div class="col-sm-12">
		<div class="iot-container">
			<h2 class="iot-chart-title"><i class="fas fa-tachometer-alt"></i> Dashboard</h2>
			<div style="height:auto">
				<?php 
				    $cont = 0;
				    $corFundo = "";
				?>
				<?php foreach($viewDatas as $viewData):?>
					<?php 
					    $cont++;
					    $corFundo = Helper::cores()[$cont];

					    $valores = [];
					    $curveChartNomeDinamico = true;
					    $tipoDataEixoX = false;

                       # Agrupa por Mês
                        if ($viewData["id_agrupador"] == 3) {
	                       	$valores = $modelViewData->groupByMes($viewData["segredo"]);
	                       	$tituloX = "Meses";
                        
                        # Agrupa por Hora
                        } elseif ($viewData["id_agrupador"] == 1) {
                        	$valores = $modelViewData->groupByHora($viewData["segredo"]);
                        	$subTitulo = "Dados das ultimas 24 horas";
				            $tipoDataEixoX = "hora";
				            $tituloX = "Horas";

                        }
                        # Agrupa por Dia 
                        elseif ($viewData["id_agrupador"] == 2) {
				            $valores = $modelViewData->groupByDia($viewData["segredo"]);
				            $subTitulo = "Dados dos ultimos 30 dias";
				            $tituloX = "Dias";

				        # Agrupa por Minuto
				        } elseif ($viewData["id_agrupador"] == 4) {
				            $valores = $modelViewData->groupByMinuto($viewData["segredo"]);
				            $subTitulo = "Dados dos ultimos 60 minutos";
				            $tituloX = "Minutos";
				        }
					?>
                        
					<?php if ($viewData["id_tipo_grafico"] == 2):?>
						<?php include("views/graficos/linha/grafico_linha.php");?>
					<?php elseif ($viewData["id_tipo_grafico"] == 3):?>
						<?php include("views/graficos/coluna/grafico_coluna.php");?>
					<?php endif;?>

					<div class="col-md-4 area-chart" style="padding:0!important;">
						<h2 class="iot-chart-title" style="border-radius:0!important;background:<?php echo $corFundo;?>!important;">
			                <?php echo $viewData["nome_view_data"];?>
			                <span class="pull-right botao-editar-componente" style="padding-right:5px;">
			                	<a title="Editar Componente!" href="?viewData=editar&idViewData=<?php echo $viewData['id_view_data'];?>" 
			                	style="color:white!important;"><i class="fas fa-edit"></i></a>
			                </span>
			            </h2>

						<center class="sub-titulo">
							<?php echo $subTitulo;?>
						</center>

						<div id="curve_chart_<?php echo $viewData['id_view_data'];?>" style="height: 300px;background:#ede7d6!important">
							<?php if (count($valores) == 0):?>
								<br>
							    <center>
							    	<h3 style="opacity:0.50;" class="dado-nao-encontrado">
							    		
							    		<i style="font-size:50px;margin-top:50px;" class="far fa-sad-tear"></i> <br> <br>
							    		Nenhum Dado foi encontrado.
							    	</h3>
							    </center>
							<?php endif;?>
						</div>
					</div>

                <?php endforeach;?>
                
                <?php if (Session::getSession("email") == "abitat.live@gmail.com"):?>
	                <div class="col-md-12 area-chart" style="padding:0!important;margin-top:20px">
					    <h2 class="iot-chart-title" style="border-radius:0!important;">Hub Salvador</h2>
	                        <iframe src="https://mpembed.com/show/?m=pbqi1VafnP4&filter=saturate" 
	                        width="100%" height="500px"></iframe>
	                </div>
                <?php endif; ?>

                
                <?php if (Session::getSession("email") == "abitat.live@gmail.com"):?>
                    <img id="img_temporario" class="img-responsive img-thumbnail" src="public/img/planta.jpg">
				<?php endif;?>
               
               <div style="clear:both;"></div>
               <br>
               

			</div>
		</div>
	</div>
	
</div>