<?php 

class IndexController extends Controller
{
    protected $sensor;
    protected $usuario;
    
    protected $view;
    protected $layout;

    public function __construct()
    {
        $this->sensor = $this->model('ViewData');
        $this->usuario = $this->model("Usuario");

        $this->view = $this->view();
        $this->layout = $this->view->layout('default-layout');
    }

    public function index()
    {
        $usuarios = $this->usuario->usuarios();
    	return $this->view->show("index.index", compact("usuarios"));
    }

    public function cadastreSe()
    {
    	return $this->view->show("index.cadastre_se");
    }
}