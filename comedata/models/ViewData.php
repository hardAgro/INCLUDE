<?php 
class ViewData extends Model
{
	protected $table = "view_data";
    
    # Realiza o Agrupamento por Hora
	public function groupByHora($segredo, $ordenacao = "ASC")
	{
		return $this->query(
			"SELECT ROUND( (SUM(dt.valor))/COUNT(1), 2) AS VALOR, 
			HOUR(dt.data_cadastro) AS DATA
			FROM view_data AS vi
			INNER JOIN data AS dt ON vi.id_view_data = dt.id_view_data
			WHERE vi.segredo = '{$segredo}' AND DATE(dt.data_cadastro) 
			BETWEEN NOW() - INTERVAL 1 DAY AND NOW()
			GROUP BY HOUR(dt.data_cadastro) ORDER BY DATA {$ordenacao}"
		);
	}
    
    # Realiza o Agrupamento por Mês
	public function groupByMes($segredo, $ordenacao = "ASC")
	{
		return $this->query(
			"SELECT ROUND( (SUM(dt.valor))/COUNT(1), 2) AS VALOR, 
			DATE_FORMAT(dt.data_cadastro, '%m/%Y') AS DATA
			FROM view_data AS vi
			INNER JOIN data AS dt ON vi.id_view_data = dt.id_view_data
			WHERE vi.segredo = '{$segredo}'
			GROUP BY DATE_FORMAT(dt.data_cadastro, '%m/%Y') 
			ORDER BY DATE_FORMAT(dt.data_cadastro, '%m/%Y') DATA {$ordenacao}"
		);
	}

	# Realiza o Agrupamento por Dia
	public function groupByDia($segredo, $ordenacao = "ASC")
	{
		return $this->query(
			"SELECT ROUND( (SUM(dt.valor))/COUNT(1), 2) AS VALOR, 
			DATE_FORMAT(dt.data_cadastro, '%d') AS DATA FROM view_data AS vi
			INNER JOIN data AS dt ON vi.id_view_data = dt.id_view_data
			WHERE vi.segredo = '{$segredo}' AND DATE(dt.data_cadastro) 
			BETWEEN NOW() - INTERVAL 30 DAY AND NOW()
			GROUP BY DATE_FORMAT(dt.data_cadastro, '%d') 
			ORDER BY DATE_FORMAT(dt.data_cadastro, '%d') {$ordenacao}"
		);
	}

	# Realiza o Agrupamento por Minuto
	public function groupByMinuto($segredo, $ordenacao = "ASC")
	{
		return $this->query(
			"SELECT ROUND( (SUM(dt.valor))/COUNT(1), 2) AS VALOR, 
			minute(dt.data_cadastro) AS DATA FROM view_data AS vi
			INNER JOIN data AS dt ON vi.id_view_data = dt.id_view_data
			WHERE vi.segredo = '{$segredo}' 
			AND TIME(dt.data_cadastro) BETWEEN now() + INTERVAL -1 hour AND now()
			AND hour(dt.data_cadastro) = hour(now()) AND DATE(dt.data_cadastro) = DATE(NOW())
			GROUP BY minute(dt.data_cadastro) ORDER BY minute(dt.data_cadastro) {$ordenacao}"
		);
	}

	public function filtrarPorPeriodo($segredo, $inicio, $fim)
	{
		return $this->query(
			"SELECT ROUND( (SUM(dt.valor))/COUNT(1), 2) AS VALOR, 
			DATE(dt.data_cadastro) AS DATA
			FROM view_data AS vi
			INNER JOIN data AS dt ON vi.id_view_data = dt.id_view_data
			WHERE vi.segredo = '{$segredo}' AND DATE(dt.data_cadastro) 
			BETWEEN '{$inicio}' AND '{$fim}'
			GROUP BY DATE(dt.data_cadastro) 
			ORDER BY DATE(dt.data_cadastro) ASC"
		);
	}

	public function ultimoRegistroDoComponente($segredo)
	{
		return $this->query("
			SELECT ROUND( (SUM(dt.valor))/COUNT(1), 2) AS VALOR, 
		    dt.data_cadastro AS DATA
			FROM view_data AS vi
			INNER JOIN data AS dt ON vi.id_view_data = dt.id_view_data
			WHERE vi.segredo = '{$segredo}' 
			GROUP BY DATA ORDER BY dt.data_cadastro DESC LIMIT 1"
		);
	}

	public function mostrarNoDashboard($idUsuario)
	{
		return $this->query("SELECT * FROM {$this->table} WHERE mostrar_no_dashboard = 1 AND id_usuario = {$idUsuario}", "array");
	}

	public function mediaEdesvioPadrao($standardDeviationService, $valores)
	{
		$conjunto = [];
        foreach ($valores as $data) {
            array_push($conjunto, $data->VALOR);
        }

        $standardDeviationService->setRawGroup($conjunto);
        $desvioPadrao = round($standardDeviationService->deviation(), 2);
        $media = round($standardDeviationService->average(), 2);

        return ["desvioPadrao" => $desvioPadrao, "media" => $media];
	}

	public function minimoEmaximo($conjunto)
	{
		if (count($conjunto) > 0) {
			return ["min" => min($conjunto)->VALOR, "max" => max($conjunto)->VALOR];
		}

		return ["min" => 0, "max" => 0];
	}

	public function viewDataByIdUsuario($idUsuario)
	{
		return $this->query("SELECT * FROM {$this->table} WHERE id_usuario = '{$idUsuario}'");
	}
    
    # Verifica se já existe um determinado Segredo Cadastrado
	public function jaExisteSegredo($segredo)
	{
		$query = $this->query("SELECT * FROM {$this->table} WHERE segredo = '{$segredo}'");
				
		if (count($query) > 0) {
			return true;
		}

		return false;
	}

	public function sePertenceAoUsuario($idUsuario, $segredo)
	{
		$query = $this->query(
			"SELECT * FROM {$this->table} WHERE id_usuario = '{$idUsuario}'
		    AND segredo = '{$segredo}'"
		);
				
		if (count($query) > 0) {
			return true;
		}

		return false;
	}
    
    # Primeiro Dado Cadastrado
	public function dataDoPrimeiroDadoCadastrado($segredo)
	{
		return $this->query(
			"SELECT dt.data_cadastro FROM view_data AS vi INNER JOIN data AS dt ON 
			vi.id_view_data = dt.id_view_data WHERE vi.segredo = '{$segredo}'
			ORDER BY dt.id_data ASC LIMIT 1"
		);
	}

	public function deletarComponente($idComponente)
	{
		return $this->queryDelete("DELETE FROM {$this->table} WHERE id_view_data = {$idComponente}");
	}

	public function componentesPorIdDoUsuario($idUsuario)
	{
		return $this->query(
			"SELECT vi.id_view_data AS idComponente, vi.nome_view_data AS nomeComponente ,
			DATE_FORMAT(vi.data_cadastro, '%d/%m/%Y') AS dataCadastro  
			FROM view_data AS vi INNER JOIN usuario ON vi.id_usuario = usuario.id_usuario
			WHERE usuario.id_usuario = {$idUsuario}"
        ); 
	}
}