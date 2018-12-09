import requests
import random
import time

while True:
	my_numbers = 0 #str(random.randint(0,40))
	print(my_numbers)
	time.sleep( 5 )
	requests.get("http://localhost:7000/?api=putByGet&idConta=rafaellevissacomeDataUh%UDWt&segredo=HzR!VOa10&valor="+my_numbers)