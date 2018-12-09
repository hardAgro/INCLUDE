<div class="row">

	<div class="col-ms-8 center-block">

		<div class="col-ms-8 center-block">
			<h6>Sub Imagens <span style="color:#18bc9c;"><?php echo $categoria["nome"];?></span></h6>
		</div>

		<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>Nome</th>

					<th>Data Criação</th>
					<th>
					   <button class="btn btn-sm pull-right"
		                    data-toggle="modal" data-target="#modal_cadastrar_sub_categorias" data-backdrop="static">
		                    Nova sub Imagem <i class="fa fa-plus-square"></i>
		               </button>
				    </th>
				</tr>
			</thead>

			<tbody>
				<?php foreach ($subCategorias as $subCategoria):?>
					<tr>
						<td>
							<img src="<?php echo $subCategoria->imagem;?>" width="50" style="border-radius:5px">	
						</td>
						<td><?php echo ucfirst($subCategoria->sub_nome);?></td>
						<td><?php echo Date::dateFormat(date("Y-m-d", strtotime($subCategoria->sub_data_cadastro)));?></td>

						<td>
							<div class="pull-right">
			                    <button class="btn btn-sm btn-primary" 
			                        data-toggle="modal" 
			                        data-target="#modal_editar<?php echo $subCategoria->id_sub_categoria;?>" 
			                        data-backdrop="static">
			                        Editar <i class="fa fa-check"></i>
			                    </button>
			                </div>
						</td>
					</tr>

					<?php include("views/sub_categoria/modal_editar.php");?>

			    <?php endforeach;?>
			</tbody>
			
		</table>
		
	</div>

</div>

<?php require_once("views/sub_categoria/modal_cadastrar.php");?>