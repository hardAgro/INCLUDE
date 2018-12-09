<div class="row">

	<div class="col-md-6" id="centered">
		<div class="iot-container">

			<?php require_once("views/flash_message/flash_message.php");?>

			<h2 class="iot-chart-title">Fazer Login</h2>
			<hr>
			
			<form method="post" action="?login=logar">
				
                <div class="col-md-12 pull-left">
					<div class="form-group">
					    <label for="exampleInputEmail1">E-mail *</label>
					    <input type="email" class="form-control" name="login" placeholder="E-mail de Acesso">
					</div>
				</div>

				<div class="col-md-12 pull-left">
					<div class="form-group">
					    <label for="exampleInputEmail1">Senha *</label>
					    <input type="password" class="form-control" name="password" placeholder="Senha de Acesso">
					</div>
				</div>

				<div class="col-md-12">
					<div class="form-group pull-right">
					    <button type="submit" class="btn btn-primary">
					        <i class="fa fa-meh-o"></i> Entrar
					    </button>
					</div>
				</div>
             
			</form>
            
			<div style="clear:both;"></div>
			<br>
		</div>
	</div>
	
</div>
