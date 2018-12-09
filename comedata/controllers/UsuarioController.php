<?php 
class UsuarioController extends Controller
{
    protected $usuario;
    protected $uploadFiles;

    protected $view;
    protected $layout;

    public function __construct()
    {
        $this->usuario = $this->model('Usuario');

        $this->uploadFiles = $this->service("UploadFiles");

        $this->view = $this->view();
        $this->layout = $this->view->layout('default-layout');
    }

    public function cadastrar()
    {
        $dataUsuario["nome_usuario"] = Input::inPost("nome_usuario");
        $dataUsuario["login"] = Input::inPost("login");
        $dataUsuario["genero"] = (int) Input::inPost("genero");
        $dataUsuario["id_conta"] = explode("@", $dataUsuario["login"])[0]."comeData".PasswordGenerator::generate();
        $dataUsuario["password"] = Hash::make(Input::inPost("password"));
        $dataUsuario["data_cadastro"] = Date::dateTime();

        $this->uploadFiles->file($_FILES["imagem"]);
        $this->uploadFiles->folder("public/img/usuarios/");
        $this->uploadFiles->extensions(array("png","jpg","jpeg"));

        if ($this->usuario->loginExists($dataUsuario["login"])) {
            Session::flash('error','Este E-mail já existe');
            return Redirect::back();
        }

        try {

            $this->uploadFiles->move();
            $dataUsuario["imagem"] = $this->uploadFiles->destinationPath();

        } catch(\Exception $e) {
            var_dump($e);
        }

        try {

            $this->usuario->cadastrar($dataUsuario);

        } catch(\Exception $e) {
            var_dump($e);
        }

        Session::flash('success','Obrigado por se cadastrar! Faça Login com a sua conta.');
        return Redirect::to("login.login"); 
    }
}