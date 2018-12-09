<?php 
# Conexão com a Base de dados
require_once("database/DatabaseConfig.php");
require_once("system/database/Database.php");
$pdo = Database::connect();

# Função para deleção dos registros
function deletar($pdo) {
	$query = $pdo->prepare("DELETE FROM data WHERE DATE(data_cadastro) != DATE(NOW())");
	return $query->execute();
}

# Chama a função de deleção
if (deletar($pdo)) {
	logDelecao($pdo);
}

function logDelecao($pdo) {
	$pdo->prepare("INSERT INTO log_delecao(data_delecao) VALUES(?)");
	$pdo->execute(array(date("Y-m-d H:i:s")));
}

//DELETE FROM data WHERE DATE(data_cadastro) <= DATE_SUB(CURDATE(), INTERVAL 10 DAY)