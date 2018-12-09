import pymysql
import datetime

host = "35.196.36.57"
user = "root"
password = "Luc@slevi"
database = "comedata"

hora = datetime.datetime.now()

db = pymysql.connect(host=host, user=user, password=password, db=database,
	cursorclass=pymysql.cursors.DictCursor)

try:
   cursor = db.cursor()
   cursor.execute("DELETE FROM data WHERE DATE(data_cadastro) != DATE(NOW())")
   cursor.execute("INSERT INTO log_delecao(data_delecao) VALUES(%s)", hora)
   db.commit()
   print("Query Executada com Sucesso!")
except:
	db.rollback()
	print("Erro ao executar a Query")

print(cursor.fetchone())
db.close()