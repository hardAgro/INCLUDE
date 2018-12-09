<?php 
class LoginController extends Controller
{
    protected $usuario;

    protected $view;
    protected $layout;

    public function __construct()
    {
        $this->usuario = $this->model('Usuario');

        $this->view = $this->view();
        $this->layout = $this->view->layout('default-layout');
    }

    public function login()
    {   
        $this->layout;
        return $this->view->show("index.login");
    }

    public function logar() 
    {
        $dataLogin['login'] = addslashes(Input::inPost('login'));
        $dataLogin['password'] = addslashes(Input::inPost('password'));

        # Verifica se o Usuário que está tentando logar existe na tabela (usuario)
        if ($this->usuario->userExist($dataLogin)) {
            $usuario = $this->usuario->findBy('login', $dataLogin['login']);

            Session::putSession("id_usuario", $usuario["id_usuario"]);
            Session::putSession("nome_usuario", $usuario["nome_usuario"]);
            Session::putSession("email", $usuario["login"]);
            Session::putSession("usuario_imagem", $usuario["imagem"]);
            Session::putSession("genero_usuario", $usuario["genero"]);
            Session::putSession("id_conta", $usuario["id_conta"]);

            return Redirect::to('dashboard.index');
        } 

        Session::flash('error', "Login ou Senha incorretos");
        return Redirect::to('login.login');
    }

    public function logout()
    {
        $this->usuario->logout();
        return Redirect::to('index.index');
    }
}