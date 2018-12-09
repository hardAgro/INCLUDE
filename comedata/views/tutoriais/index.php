<div class="row">

	<div class="col-md-12">
		<div class="iot-container">
			<h2 class="iot-chart-title">Tutoriais de Uso da Api</h2>
			<hr>
            
            <div class="col-md-8" id="centered">
            	<h3>Nossa API</h3>
				<p>
					A utilização do ComeData –IoT é bastante simples e você pode enviar  dados de sensores por via de uma API que responde a verbos HTTP ! Isso significa que você pode enviar os dados direto de um Arduino, Esp8266, Raspberry py ou qualquer outro embarcado capaz de se conectar com a internet e efetuar requisições HTTP como GET ou POST. Aqui você encontra alguns exemplos de utilização da nossa API por via de alguns embarcados.  
				</p>
			
                <h3>Enviando dados via ESP8266</h3>
				<p>
					Você vai precisar baixar a biblioteca HttpClient para efetuar as requisições a nossa API e passando para ela as informações necessárias para realizar o cadastro em seu componente.
				</p>
				<b>Passo (A):</b>
				<p>
					Com a sua IDE do Arduino aberta, vá até gerenciar bibliotecas, pesquise por HttpClient e instale na sua IDE. Em seguida Inclua a biblioteca ao seu projeto!
				</p>

				<b>Passo (B):</b>
				<p>
					Você precisa criar um Componente no ComeData. Ao criar um componente a plataforma gera um (segredo) que na verdade é um identificador do componente. Isso te permite enviar dados para um ou mais componentes tendo como referencia o seu identificador único.  
				</p>
				<p>
					Você também vai precisar do ID da sua conta. Esse ID é gerado no momento em que você se cadastra na plataforma e é uma forma de identificar a quem pertence um ou mais componentes no momento do envio dos dados para a nossa API.
				</p>

				<b>Exemplo de Utilização:</b> 
				<p>
				    Obs: Este é apenas um exemplo de uso do HttpClient. Não esqueça de utilizar a biblioteca de conexão a rede Wifi!
			    </p>

				<script src="https://gist.github.com/valdiney/9518124b888af9548ef6df6de1630bc5.js"></script>


			</div>
		
			
			
            
			<div style="clear:both;"></div>
			<br>
		</div>
	</div>
	
</div>

<script src="public/vendor/jquery/jquery.min.js"></script>
