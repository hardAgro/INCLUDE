<?php 

class SubCategoria extends Model
{
	protected $table = "sub_categoria";

	public function cadastrar($data)
	{
		return $this->save($data);
	}

	public function subCategorias($idCategoria)
	{
		return $this->query
		(
			"SELECT sub_categoria.id_categoria, sub_categoria.id_sub_categoria, sub_categoria.nome AS sub_nome,
             categoria.nome AS categoria_nome, categoria.id_categoria AS id_categoria,
             sub_categoria.imagem,
             sub_categoria.data_cadastro AS sub_data_cadastro
			 FROM sub_categoria INNER JOIN categoria ON 
			 sub_categoria.id_categoria = categoria.id_categoria
			 WHERE sub_categoria.id_categoria = {$idCategoria}"
		);
	}

	public function subCategoriaPorUsuario($idUsuario, $idCategoria)
	{
		return $this->query
		(
			"SELECT sub_categoria.imagem, sub_categoria.nome FROM usuario INNER JOIN categoria_usuario 
			 ON usuario.id_usuario = categoria_usuario.id_usuario	
		     INNER JOIN sub_categoria ON sub_categoria.id_categoria = categoria_usuario.id_categoria
			 WHERE usuario.id_usuario = {$idUsuario} AND sub_categoria.id_categoria = {$idCategoria}"
		);
	}
}