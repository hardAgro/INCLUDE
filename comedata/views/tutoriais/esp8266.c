#include <ESP8266HTTPClient.h>

//Declara uma variável para utilizar o HttpClient
HTTPClient http; 

//ID da minha conta na Plataforma
String idDaMinhaConta = "minhaconta4comeDatagnD-!zG";

//ID do meu Componente na Plataforma
String segredoDoComponente = "h4g0pE*7";

void loop() {
    
    // Antes de juntar o seu valor na rota, transforme o em uma String
    int temperatura = 17;
    String trataTemperatura = String(temperatura);

	String rota = "http://escoladoarduino.com.br/comedataiot/?api=putByGet&idConta="+
	idDaMinhaConta+"&segredo="+segredoDoComponente+"&valor="+trataTemperatura;
    
    // Seta a rota para o HttpClient e efetua a requisição Http
	http.begin(rota);
    
    // Recupera o Retorno do Servidor
	int httpCode = 0;
	httpCode = http.GET(); 
    
    // Se o retorno for diferente de zero, ocorreu algum problema no envio. 
	if (httpCode > 0) {
		// Verific no Serial o que foi retornado do Servidor
		String payload = http.getString();
        Serial.println(payload);
	}

    // Fecha a conexão Http. Importante fechar sempre que realizar uma requisição Http
	http.end(); 

	// Delay para não enviar muitos dados de uma unica vez
	delay(500);

}