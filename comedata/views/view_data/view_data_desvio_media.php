<div class="col-sm-12" style="margin-bottom:10px">

	<div class="col-sm-4 bg-maior-encontrado pull-left">
		<div style="padding:10px">
		   <span class="numero-destaque"><?php echo $mediaEdesvioPadrao["media"];?></span>
			<br>
			<span style="opacity:0.80"><i class="fa fa-check-circle"></i> Média</span>
		</div>
	</div>
   
	<div class="col-sm-4 bg-desvio-padrao pull-left">
	   <div style="padding:10px">
			<span class="numero-destaque"><?php echo $mediaEdesvioPadrao["desvioPadrao"];?></span>
			<br>
			<span style="opacity:0.80"><i class="fa fa-check-circle"></i> Desvio Padrão</span>
		</div>
	</div>

	<div class="col-sm-2 bg-maximo pull-left">
	   <div style="padding:10px">
			<span class="numero-destaque">
				<?php echo $minimoEmaximo["max"];?>
			</span>
			<br>
			<span style="opacity:0.80"><i class="fa fa-check-circle"></i> Máximo</span>
		</div>
	</div>

	<div class="col-sm-2 bg-minimo pull-left">
	   <div style="padding:10px">
			<span class="numero-destaque">
				<?php echo $minimoEmaximo["min"];?>
			</span>
			<br>
			<span style="opacity:0.80"><i class="fa fa-check-circle"></i> Mínimo</span>
		</div>
	</div>
	
</div>