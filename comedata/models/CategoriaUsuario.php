<?php 

class CategoriaUsuario extends Model
{
	protected $table = "categoria_usuario";

	public function cadastrar($data)
	{
		return $this->save($data);
	}
    
    # Query Retorna todas as Categorias vinculadas a um Determinado Usuário
	public function selectCategoriasDoUsuario($idUsuario)
	{
		return $this->query
		(
			"SELECT categoria.id_categoria, categoria.nome AS categoria_nome FROM usuario 
			INNER JOIN categoria_usuario ON usuario.id_usuario = categoria_usuario.id_usuario
			INNER JOIN categoria ON categoria_usuario.id_categoria = categoria.id_categoria
			WHERE usuario.id_usuario = {$idUsuario}"
		);
	}

	public function seNaoExistirRegistro($idUsuario, $idCategoria)
	{
		$query = $this->query
		(
			"SELECT * FROM {$this->table} WHERE id_usuario = {$idUsuario} AND id_categoria = {$idCategoria}"
		);

		if (count($query) < 1) {
			return true;
		}

		return false;
	}
}