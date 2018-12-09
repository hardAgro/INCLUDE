<?php 
$texto = str_replace(" ", "%20", ucfirst($categoria["nome"]));
?>
<script src="public/vendor/jquery/jquery.min.js"></script>
<script>
	
		function executarAudio(text) {
			
	        //var titulo = $("#titulo").text(text);
	        var url = "http://translate.google.com/translate_tts?tl=pt&q=comer&client=tw-ob";
	        console.log(url);
	        $("#speech").attr("src", url).get(0).play();
		}

</script>

<input type="text" id="text" hidden>

<audio id="speech"></audio>


<style>
	.img-usuarios {
		border:1px solid gray;
		background:white;
		display:block;
		margin-left:10px;
		padding:10px;
		text-align:center;
	}

	.nome-usuario {
		margin-top:5px;
		display:block;
	}
</style>

<div class="col-ms-8 center-block">
	<center><h6><span style="color:#18bc9c;"><?php echo $categoria["nome"];?></span></h6></center>
</div>
<br>
<!--<hr class="star-dark mb-5">-->

<div>
	<?php //require_once("views/flash_message/flash_message.php");?>
</div>

<div class="row">

	<?php if (count($subCategorias) < 1):?>
		<div id="centered">
		    <h3 style="opacity:0.60">Nenhuma Sub Categoria Cadastrado no momento</h3>
	    </div>
	<?php endif;?>
	
    <?php foreach ($subCategorias as $subCategoria):?>
        <div class="col-md-4 col-lg-2 img-usuarios" style="margin-bottom:10px;">
	            <img 
	             onclick="return executarAudio('<?php echo $subCategoria->nome; ?>')" 
	             class="rounded img-thumbnail" src="<?php echo $subCategoria->imagem;?>" width="100%">
	            <b class="nome-usuario"><?php echo $subCategoria->nome; ?></b>
            
        </div>
    <?php endforeach;?>
		
</div>
