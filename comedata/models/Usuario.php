<?php 
class Usuario extends Model
{
	protected $table = "usuario";

	public function usuarios()
	{
		return $this->select()->getAll();
	}

	public function cadastrar($data)
	{
		return $this->save($data);
	}

	public function seIdContaExiste($idConta)
	{
		$query = $this->query("SELECT * FROM {$this->table} WHERE id_conta = '{$idConta}'");

		if (count($query) > 0) {
			return true;
		}

		return false;
	}
}