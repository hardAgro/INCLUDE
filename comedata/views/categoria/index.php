<div class="row">

	<div class="col-ms-8 center-block">

		<div class="col-ms-8 center-block">
			<h6>Imagens</h6>
		</div>

		<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th>Nome</th>
					<th>Geral</th>
					<th>Data Criação</th>
					<th>
					   <button class="btn btn-sm pull-right"
		                    data-toggle="modal" data-target="#modal_cadastrar_categorias" data-backdrop="static">
		                    Nova Imagem <i class="fa fa-plus-square"></i>
		               </button>
				    </th>
				</tr>
			</thead>

			<tbody>
				<?php foreach ($categorias as $categoria):?>
					<tr>
						<td><?php echo ucfirst($categoria->nome);?></td>
						<td><?php echo ($categoria->categoria_geral == 1) ? "Sim" : "Não";?></td>
						<td><?php echo Date::dateFormat(date("Y-m-d", strtotime($categoria->data_cadastro)));?></td>

						<td>
							<div class="pull-right">
			                    <a class="btn btn-sm btn-outline-secondary" 
			                    <?php Helper::linkTo("subCategoria.index", 
			                    "idCategoria={$categoria->id_categoria}|action=subCategoria") ?>
			                        Sub Imagens <i class="fa fa-eye"></i>
			                    </a>

			                    <button class="btn btn-sm btn-primary" 
			                        data-toggle="modal" 
			                        data-target="#modal_editar_categorias<?php echo $categoria->id_categoria;?>" 
			                        data-backdrop="static">
			                        Editar <i class="fa fa-check"></i>
			                    </button>
			                </div>
						</td>
					</tr>

					<?php include("views/categoria/modal_editar_categorias.php");?>

			    <?php endforeach;?>
			</tbody>
			
		</table>
		
	</div>

</div>

<?php require_once("views/categoria/modal_cadastrar_categorias.php");?>