
<?php if (count($valores) > 0):?>

  <script type="text/javascript">
    google.charts.load('current', {packages: ['corechart', 'bar']});
    google.charts.setOnLoadCallback(drawColColors);

    function drawColColors() {
          var data = new google.visualization.DataTable();
          data.addColumn('string', "<?php echo $tituloX;?>");
          data.addColumn('number', 'Média');
          //data.addColumn('number', 'Máximo');

          data.addRows([
            <?php foreach ($valores as $valor):?>
              [
              "<?php echo Helper::tipoEixoX($tipoDataEixoX, $valor->DATA);?>", 
               <?php echo $valor->VALOR;?>,
              ],
            <?php endforeach;?>
          ]);

          <?php include("views/graficos/coluna/configuracao.php");?>
          
          <?php if (isset($curveChartNomeDinamico)):?>
            <?php $nomeIdChart = "curve_chart_".$viewData['id_view_data'];?>
            var chart = new google.visualization.ColumnChart(document.getElementById("<?php echo $nomeIdChart;?>"));
          <?php else:?>
            var chart = new google.visualization.ColumnChart(document.getElementById("curve_chart"));
          <?php endif;?>
          chart.draw(data, options);
        }
    </script>

    

<?php else: ?>
  <!--<center>
    <h3 style="opacity:0.50;">Dados não encontrado</h3>
    <small>O componente pode está esperando atualização</small>
  </center>-->
<?php endif;?>