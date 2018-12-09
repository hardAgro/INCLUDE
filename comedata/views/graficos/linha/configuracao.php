var options = {
  fontSize:'12',
  pointSize: 5,
  curveType: 'function',
  legend: { position: 'bottom' },

  hAxis: {
    title: "<?php echo $tituloX;?>",
  },
  vAxis: {
    title: "<?php echo $viewData["titulo_y"];?>",
    viewWindow: {
      min: -0
    }
  },
  backgroundColor: '#fefaee',
    series: {
      0: {
        color: "<?php echo isset($corFundo) ? $corFundo : '#a03861';?>",
        lineWidth: 2
      },
      1: {
        color: '#000000',
        lineWidth: 2
      }
  }
};