#include <dht.h>
#include <SPI.h>
#include <Ethernet.h>

#define chuvaPin A0
#define dht_dpin A1 //Pino DATA do Sensor ligado na porta Analogica A1
#define mortePin A2

int led = 8;
dht DHT; //Inicializa o sensor
float valChuva=0;
float parametroMorte=100;
byte mac[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };
char server[] = "10.0.0.2";    // name address for Google (using DNS)

IPAddress ip(10, 0, 0, 3);
EthernetClient client;
//declaracao das funcoes
void piscarLed();
void dht11Sensor();
void sensorChuva();
void envioMorteApi();
void webApi();
void morteSensor();

void setup()
{
  pinMode(led, OUTPUT);
  pinMode(chuvaPin, INPUT);
  pinMode(mortePin, INPUT);
  digitalWrite(led, LOW);
  Serial.begin(9600);
  if (Ethernet.begin(mac) == 0) {
    Serial.println("Failed to configure Ethernet using DHCP");
    // try to congifure using IP address instead of DHCP:
    Ethernet.begin(mac, ip);
  }
  piscarLed();

}

void loop()
{
  dht11Sensor();
  sensorChuva();
  piscarLed();
  webApi();
  //morteSensor();
  envioMorteApi();
  delay(1000);
}

//funcoes:
void morteSensor(){
  float valorMorte= analogRead(mortePin);
  Serial.print("Morte: ");
  Serial.println(valorMorte);
  if(valorMorte>parametroMorte){
      envioMorteApi();
  }
}
void webApi(){
  if (client.available()) {
    char c = client.read();
    Serial.print(c);
  }
  if (!client.connected()) {
    Serial.println();
    Serial.println("disconnecting.");
    client.stop();

    // do nothing forevermore:
    while (true);
  }
}
void envioMorteApi(){
  if (client.connect(server, 8080)) {
    Serial.println("connected");
    // Make a HTTP request:
    client.println("GET /?t=armadilha1&c=1 HTTP/1.1");
    client.println("Host: 10.0.0.3");
    client.println("Connection: close");
    client.println();
  } else {
    // if you didn't get a connection to the server:
    Serial.println("connection failed");
  }
}

void sensorChuva(){
  valChuva=analogRead(chuvaPin);
  Serial.print("chuva: ");
  if(valChuva<400){
    Serial.println("Chovendo");
  }else{
    Serial.println("Sem chuva");
  }
  
}
void piscarLed (){
  digitalWrite(led, HIGH);
  delay(1000);
  digitalWrite(led, LOW);
}

void dht11Sensor(){
  DHT.read11(dht_dpin); //Lê as informações do sensor
  Serial.print("Umidade = ");
  Serial.print(DHT.humidity);
  Serial.print(" %  ");
  Serial.print("Temperatura = ");
  Serial.print(DHT.temperature); 
  Serial.println(" Celsius  ");
  delay(2000);  
}
