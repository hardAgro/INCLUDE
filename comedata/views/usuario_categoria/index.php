
<style>
	.categoria_link {
		border:1px solid silver;
		display:block;
		padding:10px;
		text-align:center;
		border-radius:3px;
		background:#2c3e50;
		color:white!important;
		font-size:19px;
		font-weight:bold;
		text-transform:uppercase;
	}
</style>

<div class="row">

	<div class="col-ms-8 center-block">

		<div class="col-ms-8 center-block">
			<h6>Usuário <span style="color:#18bc9c;"><?php echo $usuario["nome"];?></span></h6>
		</div>

	</div>

</div>

<br>

<div class="row">

	<?php if (count($categorias) < 1):?>
		<div id="centered">
		    <h3 style="opacity:0.60">Nenhuma Categoria Cadastrada para este Usuário</h3>
	    </div>
	<?php endif;?>
	
    <?php foreach ($categorias as $categoria):?>
    	<?php $idUsuario = Input::inGet('idUsuario'); ?>
        <div class="col-md-4 col-lg-2 img-usuarios" style="margin-bottom:10px;">
        	<a class="categoria_link" 
        	<?php Helper::linkTo("subCategoria.subCategoriaDacategoria", 
        	"idUsuario={$idUsuario}|action=subCategoriasUsuario|idCategoria={$categoria->id_categoria}");?>
	            <i class="fa fa-check"></i> <?php echo $categoria->categoria_nome;?>
            </a>
        </div>
    <?php endforeach;?>
		
</div>


