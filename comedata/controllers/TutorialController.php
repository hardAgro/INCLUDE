<?php 
class TutorialController extends Controller
{
    protected $view;
    protected $layout;

    public function __construct()
    {
        $this->view = $this->view();
        $this->layout = $this->view->layout('default-layout');
    }

    public function index()
    {
    	return $this->view->show("tutoriais.index");
    }
}