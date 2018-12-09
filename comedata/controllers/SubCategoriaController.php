<?php 
class SubCategoriaController extends Controller
{
    protected $usuario;
    protected $categoria;
    protected $subCategoria;

    protected $uploadFiles;

    protected $view;
    protected $layout_pricipal;

    public function __construct()
    {
        $this->usuario = $this->model('Usuario');
        $this->categoria = $this->model("Categoria");
        $this->subCategoria = $this->model("SubCategoria");

        $this->uploadFiles = $this->service("UploadFiles");

        $this->view = $this->view();
        $this->layout_pricipal = $this->view->layout('default-layout');
    }

    public function index()
    {
        $idCategoria = Input::inGet("idCategoria");
        $subCategorias = $this->subCategoria->subCategorias($idCategoria);

        $categoria = $this->categoria->findBy("id_categoria", $idCategoria);

        return $this->view->make("sub_categoria.index", compact("subCategorias", "categoria"));
    }

    public function inserir()
    {
        $data["nome"] = Input::inPost("nome");
        $data["id_categoria"] = Input::inPost("idCategoria");
        $data["data_cadastro"] = Date::dateTime();

        $this->uploadFiles->file($_FILES["imagem"]);
        $this->uploadFiles->folder("public/img/sub_categorias/");
        $this->uploadFiles->extensions(array("png","jpg","jpeg"));

        try {

            $this->uploadFiles->move();
            $data["imagem"] = $this->uploadFiles->destinationPath();

        } catch(\Exception $e) {
            return Redirect::back();
        }
        
        try {

            $this->subCategoria->cadastrar($data);

            $idCategoria = $data['id_categoria'];

            Session::flash('success','Sub Categoria Salva com Sucesso!');
            return Redirect::to("subcategoria.index", "action=subCategoria|idCategoria={$idCategoria}");

        } catch(\Exception $e) {

            Session::flash('error','Erro ao Cadastrar Sub Categoria: ' .$e);
            return Redirect::back();
        }
    }

    public function alterar()
    {
        $idSubCategoria = Input::inPost("idSubCategoria");

        $data["nome"] = Input::inPost("nome");
        $data["data_cadastro"] = Date::dateTime();

        $this->uploadFiles->file($_FILES["imagem"]);
        $this->uploadFiles->folder("public/img/sub_categorias/");
        $this->uploadFiles->extensions(array("png","jpg","jpeg"));
        
        # Se carregar uma Imagem
        if ($_FILES["imagem"]["name"] != "") {

            # Verifica se a Imagem Existe
            if (file_exists(Input::inPost("caminho_imagem"))) {
                try {

                    $this->uploadFiles->move();
                    $data["imagem"] = $this->uploadFiles->destinationPath();

                } catch(\Exception $e) {
                    var_dump($e);
                }
            }
        }

        try {

            $this->subCategoria->update($data, $idSubCategoria, "id_sub_categoria");

            $idCategoria = Input::inPost("idCategoria");

            Session::flash('success','Sub Categoria Editada com Sucesso!');
            return Redirect::to("subcategoria.index", "action=subCategoria|idCategoria={$idCategoria}");

        } catch(\Exception $e) {

            Session::flash('error','Erro ao Editar Sub Categoria: ' .$e);
            return Redirect::back();
        }
    }

    public function subCategoriaDacategoria()
    {
        $this->layout_pricipal;

        $idUsuario = Input::inGet("idUsuario");
        $idCategoria = Input::inGet("idCategoria");

        $categoria = $this->categoria->findBy("id_categoria", $idCategoria);

        $subCategorias = $this->subCategoria->subCategoriaPorUsuario($idUsuario, $idCategoria);
        return $this->view->make("categoria_sub_categoria.index", 
            compact(
                "subCategorias",
                "categoria"
            ));
    }
}