
<?php if (count($valores) > 0):?>
  
  <script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['Data', 'Média'],
        <?php foreach ($valores as $valor):?>
          [
          "<?php echo Helper::tipoEixoX($tipoDataEixoX, $valor->DATA);?>", 
           <?php echo $valor->VALOR;?>
          ],
        <?php endforeach;?>
      ]);

      <?php include("views/graficos/linha/configuracao.php");?>

      <?php if (isset($curveChartNomeDinamico)):?>
        <?php $nomeIdChart = "curve_chart_".$viewData['id_view_data'];?>
        var chart = new google.visualization.LineChart(document.getElementById("<?php echo $nomeIdChart;?>"));
      <?php else:?>
        var chart = new google.visualization.LineChart(document.getElementById("curve_chart"));
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