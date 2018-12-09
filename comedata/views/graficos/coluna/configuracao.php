var options = {
  bar: {groupWidth: "20%"},
  fontSize:'12',
  colors: [
    "<?php echo isset($corFundo) ? $corFundo : '#a03861';?>", 
    "<?php echo isset($corFundo) ? $corFundo : '#a03861';?>"
  ],
  
  legend: { position: 'bottom' },
  backgroundColor: '#fefaee',
  hAxis: {
    title: "<?php echo $tituloX;?>",
    format: 'h:mm a',
    viewWindow: {
      min: [7, 30, 0],
      max: [17, 30, 0]
    }
  },
  vAxis: {
    title: "<?php echo $viewData["titulo_y"];?>"
  }
};