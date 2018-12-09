<?php 
class CategoriaController extends Controller
{
    protected $usuario;
    protected $categoria;
    protected $categoriaUsuario;

    protected $view;
    protected $layout_pricipal;

    public function __construct()
    {
        $this->usuario = $this->model('Usuario');
        $this->categoria = $this->model("Categoria");
        $this->categoriaUsuario = $this->model("CategoriaUsuario");

        $this->view = $this->view();
        $this->layout_pricipal = $this->view->layout('default-layout');
    }

    public function index()
    {
        $this->layout_pricipal;

        $categorias = $this->categoria->categorias();

        return $this->view->make("categoria.index", compact("categorias"));
    }

    public function inserir()
    {
        $data["nome"] = Input::inPost("nome");
        $data["categoria_geral"] = Input::inPost("categoria_geral");
        $data["data_cadastro"] = Date::dateTime();

        if ($data["categoria_geral"] == false) {
            $data["categoria_geral"] = 0;
        } else {
            $data["categoria_geral"] = 1;
        }

        try {

            $this->categoria->cadastrar($data);
            Session::flash('success','Categoria Salva com Sucesso!');

        } catch(\Exception $e) {

            Session::flash('error','Erro ao Cadastrar Categoria: ' .$e);
            return Redirect::back();
        }

        $usuarios = $this->usuario->usuarios();
        $idCategoria = $this->categoria->getLastID();
        
        # Verifica se é uma Categoria Geral. Se for, vincula a todos os Usuários
        foreach ($usuarios as $usuario) {
            
            if ($this->categoriaUsuario->seNaoExistirRegistro($usuario->id_usuario, $idCategoria)) {

                try {
                    $dataCategoriaUsuario["id_categoria"] = $idCategoria;
                    $dataCategoriaUsuario["id_usuario"] = $usuario->id_usuario;
                    $dataCategoriaUsuario["data_cadastro"] = Date::dateTime();

                    $this->categoriaUsuario->cadastrar($dataCategoriaUsuario);

                } catch(\Exception $e) {

                    Session::flash('error','Erro ao Cadastrar Categoria: ' .$e);
                    return Redirect::back();
                }

            }
        }

        return Redirect::to("categoria.index", "action=categoria");
    }

    public function alterar()
    {
        $idCategoria = Input::inPost("idCategoria");

        $data["nome"] = Input::inPost("nome");
        $data["categoria_geral"] = Input::inPost("categoria_geral");

        if ($data["categoria_geral"] == false) {
            $data["categoria_geral"] = 0;
        } else {
            $data["categoria_geral"] = 1;
        }

        try {

            $this->categoria->update($data, $idCategoria, "id_categoria");
           
            Session::flash('success','Categoria Salva com Sucesso!');
            return Redirect::to("categoria.index", "action=categoria");

        } catch(\Exception $e) {
            
            Session::flash('error','Erro ao Cadastrar Categoria: ' .$e);
            return Redirect::back();
        }
    }
}