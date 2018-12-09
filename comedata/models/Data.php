<?php 
class Data extends Model
{
	protected $table = "data";

	public function getQuantidadeDataByIdComponente($idComponente)
	{
		$query = $this->query("SELECT COUNT(*) AS QUANTIDADE FROM {$this->table} WHERE id_view_data = {$idComponente}");
		$quantidade = false;

		foreach ($query as $data) {
			$quantidade = $data->QUANTIDADE;
		}

		if ($quantidade > 0) {
			return true;
		}

		return false;
	}

	public function deletarData($idComponente)
	{
		return $this->queryDelete("DELETE FROM {$this->table} WHERE id_view_data = {$idComponente}");
	}
}