<div class="row">

	<div class="col-md-12">
		<div class="iot-container">
			<h2 class="iot-chart-title">Cadastro</h2>
			<hr>
			
			<form method="post" enctype="multipart/form-data" action="?usuario=cadastrar">
				<div class="col-md-4 pull-left">
					<div class="form-group">
					    <label for="exampleInputEmail1">Nome *</label>
					    <input type="text" class="form-control" name="nome_usuario" placeholder="Digite o seu Nome"
					    id="nome_usuario">
					</div>
				</div>
                
                <div class="col-md-4 pull-left">
					<div class="form-group">
					    <label for="exampleInputEmail1">E-mail *</label>
					    <input type="email" class="form-control" name="login" placeholder="Digite o seu E-mail"
					    id="login">
					</div>
				</div>

				<div class="col-md-4 pull-left">
					<div class="form-group">
					    <label for="exampleInputEmail1">Gênero *</label>
					    <select class="custom-select" name="genero" id="genero">
						  <option value="" selected>Selecione</option>
						  <option value="1">Masculino</option>
						  <option value="2">Feminino</option>
						</select>
					</div>
				</div>

				<div class="col-md-4 pull-left">
					<div class="form-group">
					    <label for="exampleInputEmail1">Senha *</label>
					    <input type="password" class="form-control" name="password" placeholder="Digite uma Senha"
					    id="password">
					</div>
				</div>

				<div class="col-md-4 pull-left">
					<div class="form-group">
					    <label for="exampleInputEmail1">Imagem de Perfil</label>
					    <input type="file" class="form-control" name="imagem" id="imagem" placeholder="Digite o seu E-mail">
					</div>
				</div>

				<div class="col-md-12">
					<div class="form-group pull-right">
					    <button type="submit" class="btn btn-primary" id="cadastrar">
					        <i class="fa fa-save"></i> Salvar
					    </button>
					</div>
				</div>
             
			</form>
            
			<div style="clear:both;"></div>
			<br>
		</div>
	</div>
	
</div>

<script src="public/vendor/jquery/jquery.min.js"></script>
<script>
	$(function() {

		$("#cadastrar").click(function() {

			if ($("#nome_usuario").val() == "") {
				$("#exampleModalLabel").html("Validação");
				$("#into-modal").html("<center><h4>O campo Nome é obrigatório</h4></center>");
				$("#exampleModal").modal();
				return false;
			}

			else if ($("#login").val() == "") {
				$("#exampleModalLabel").html("Validação");
				$("#into-modal").html("<center><h4>O campo E-mail é obrigatório</h4></center>");
				$("#exampleModal").modal();
				return false;
			}

			else if ($("#genero").val() == "") {
				$("#exampleModalLabel").html("Validação");
				$("#into-modal").html("<center><h4>O campo Gênero é obrigatório</h4></center>");
				$("#exampleModal").modal();
				return false;
			}

			else if ($("#password").val() == "") {
				$("#exampleModalLabel").html("Validação");
				$("#into-modal").html("<center><h4>O campo Senha é obrigatório</h4></center>");
				$("#exampleModal").modal();
				return false;
			}
		});

	});
</script>
