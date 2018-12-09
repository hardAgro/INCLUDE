<?php 

class DashboardController extends Controller
{
    protected $viewData;
    protected $data;

    protected $view;
    protected $layout;

    public function __construct()
    {
        $this->viewData = $this->model('ViewData');
        $this->data = $this->model('Data');

        $this->view = $this->view();
        $this->layout = $this->view->layout('default-layout');
    }

    public function index()
    {
        $modelViewData = $this->viewData;
        $viewDatas = $this->viewData->mostrarNoDashboard(Session::getSession("id_usuario"));
        
        return $this->view->show("dashboard.index", compact("viewDatas", "modelViewData"));
    }
}
