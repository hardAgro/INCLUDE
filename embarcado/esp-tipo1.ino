#include <DHT.h>
#include <DHT_U.h>

//Bibliotecas
#include <ESP8266WiFi.h> // Importa a Biblioteca ESP8266WiFi
#include <ESP8266HTTPClient.h>
//#include "DHT.h"        // including the library of DHT11 temperature and humidity sensor

#define DHTTYPE DHT11   // DHT 11

//Mapeamento de portas digitais
#define D0    16
#define D1    5
#define D2    4 //led
#define D3    0 //chuva
#define D4    2 //DHT11
#define D5    14
#define D6    12
#define D7    13
#define D8    15

//constantes do WIFI
const char* SSID = "inova.farm"; // SSID / nome da rede WI-FI que deseja se conectar
const char* PASSWORD = ""; // Senha da rede WI-FI que deseja se conectar

//Declara uma variável para utilizar o HttpClient
HTTPClient http; 

//DHT11
DHT dht(D4, DHTTYPE); 

//ID da minha conta na Plataforma
String idDaMinhaConta = "rafaellevissacomeDataUh%UDWt";

//ID do meu Componente na Plataforma
String segredoDoComponenteUmidade = "Hy-knUU10"; //umidade da gleba
String segredoDoComponenteTemperatura = "1-5JyrX10"; //temperatura da gleba
String segredoDoComponenteChuva = "Z-MP9Jm10"; //Umidade do solo da gleba
String segredoDoComponenteMorte = "ck1MeXp10";

//declarando funcoes
void initWiFi();
void reconectWiFi();
void empurraDado(String segredoDoComponente, String dado);

void setup() {
  // put your setup code here, to run once:
  Serial.begin(115200);
  initWiFi();
  pinMode(D2, OUTPUT);
  //pinMode(A0, INPUT);
  dht.begin();       
}

void loop() {
   
    // put your main code here, to run repeatedly:
    // Antes de juntar o seu valor na rota, transforme o em uma String
    //DHT11
    float Umidade = dht.readHumidity();
    float Temperatura = dht.readTemperature();
    
    String dadoUmidade = String(Umidade);
    Serial.print("Umidade (%)");
    Serial.print(dadoUmidade);
    empurraDado(segredoDoComponenteUmidade,dadoUmidade);
    // Delay para não enviar muitos dados de uma unica vez
    delay(100);
    
    String dadoTemperatura = String(Temperatura);
    Serial.print("Temperatura (ºC)");
    Serial.println(dadoTemperatura);
    empurraDado(segredoDoComponenteTemperatura,dadoTemperatura);
    // Delay para não enviar muitos dados de uma unica vez
    delay(100);
    
     
    //coletando dado do sensor de umidade solo
    int Chuva=digitalRead(D3);   // Le o input do A0;
    
    String dadoChuva = String(Chuva);
    Serial.print("Chuva: ");
    if(Chuva==1){
      Serial.println("Sem chuva");
    }else{
      Serial.println("Com chuva");
    }
    empurraDado(segredoDoComponenteChuva,dadoChuva);
    delay(100);
    //coletando dado do sensor de umidade solo
    int Morte=analogRead(A0);   // Le o input do A0;
    
    String dadoMorte = String(Morte);
    Serial.print("Morte: ");
    Serial.print(dadoMorte);
    empurraDado(segredoDoComponenteMorte,dadoMorte);
    
    // Delay para não enviar muitos dados de uma unica vez
    delay(100);
    digitalWrite(D2, HIGH);
    delay(1000);
    digitalWrite(D2, LOW);
}


//Funcao: Joga o dado do componente no comedataIoT
//Parametros: Segredo do componente, Dado do componente
//Retorno: nenhum
void empurraDado(String segredoDoComponente, String dado){
    String rota = "http://escoladoarduino.com.br/comedataiot/?api=putByGet&idConta="+
    idDaMinhaConta+"&segredo="+segredoDoComponente+"&valor="+dado;
    
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
}

//Função: inicializa e conecta-se na rede WI-FI desejada
//Parâmetros: nenhum
//Retorno: nenhum
void initWiFi() 
{
    delay(10);
    Serial.println("------Conexao WI-FI------");
    Serial.print("Conectando-se na rede: ");
    Serial.println(SSID);
    Serial.println("Aguarde");
     
    reconectWiFi();
}

//Função: reconecta-se ao WiFi
//Parâmetros: nenhum
//Retorno: nenhum
void reconectWiFi() 
{
    //se já está conectado a rede WI-FI, nada é feito. 
    //Caso contrário, são efetuadas tentativas de conexão
    if (WiFi.status() == WL_CONNECTED)
        return;
         
    WiFi.begin(SSID, PASSWORD); // Conecta na rede WI-FI
     
    while (WiFi.status() != WL_CONNECTED) 
    {
        delay(100);
        Serial.print(".");
    }
   
    Serial.println();
    Serial.print("Conectado com sucesso na rede ");
    Serial.print(SSID);
    Serial.println("IP obtido: ");
    Serial.println(WiFi.localIP());
}
