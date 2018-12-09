<?php 
class Categoria extends Model
{
	protected $table = "categoria";

	public function categorias()
	{
		return $this->query("SELECT * FROM {$this->table} ORDER BY categoria_geral ASC");
	}

	public function cadastrar($data)
	{
		return $this->save($data);
	}

	public function editar($data, $idCategoria)
	{
		return $this->update($data, $idCategoria);
	}
}