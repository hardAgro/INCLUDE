import requests
import random
import time

while True:
    
    # Endereço da API do ComeData
    rota_comedata = "http://escoladoarduino.com.br/comedataiot/?api=putByGet&idConta="
    
    # ID da sua conta no ComedData. (Esse ID é gerado no momento em que você se cadastra no sistema)
    id_conta = "valdiney.2comeDatagnD-!zG"

    # Segredo do seu componente no ComeData. (Esse ID é gerado no momento em que você cria um comenponente no sistema)
    segredo = "0M3Zk*A7"

    # O valor do seu Sensor
    valor_sensor = str(random.randint(0,40))

    # Eexecuta uma requisição GET para a API do ComeData passando seus parametros necessários. (O retorno desta requisição deve ser Status 200)
    requisicao = requests.get(rota_comedata+"&idConta="+id_conta+"&segredo="+segredo+"&valor="+valor_sensor)
    print(requisicao)

    time.sleep(5)