<?php 
header('Access-Control-Allow-Origin: *');
class ViewDataController extends Controller
{
    protected $viewData;
    protected $data;
    protected $standardDeviation;

    protected $view;
    protected $layout;

    public function __construct()
    {
        $this->viewData = $this->model('ViewData');
        $this->data = $this->model('Data');
        $this->standardDeviation = $this->service("StandardDeviation");

        $this->view = $this->view();
        $this->layout = $this->view->layout('default-layout');
    }

    public function index()
    {
        return $this->view->show("view_data.index");
    }

    public function cadastrar()
    {
        $idUsuario = Session::getSession("id_usuario");

        $data["nome_view_data"] = Input::inPost("nome_view_data");
        $data["id_usuario"] = Session::getSession("id_usuario");
        $data["titulo_x"] = Input::inPost("titulo_x");
        $data["titulo_y"] = Input::inPost("titulo_y");
        $data["id_agrupador"] = Input::inPost("id_agrupador");
        $data["data_cadastro"] = Date::dateTime();
        $data["id_tipo_grafico"] = Input::inPost("id_tipo_grafico");

        $segredo = PasswordGenerator::generate().Session::getSession("id_usuario");

        if ($this->viewData->jaExisteSegredo($segredo)) {
            while ($this->viewData->jaExisteSegredo($segredo)) {
                $segredo = PasswordGenerator::generate().Session::getSession("id_usuario");
            }
        }

        $data["segredo"] = $segredo;
        
        # Realiza o Cadastro do View Data
        try {

            $this->viewData->save($data);

            Session::flash('success', "Componente Cadastrada com Sucesso");
            return Redirect::to('viewData.viewDatas', "idUsuario={$idUsuario}");

        } catch(\Exception $e) {
            var_dump($e);
        }
    }

    public function editar()
    {
        $idViewData = Input::inGet("idViewData");
        $viewData = $this->viewData->findBy("id_view_data", $idViewData);

        return $this->view->show("view_data.index", compact("viewData"));
    }

    public function alterar()
    {
        $idViewData = Input::inPost("idViewData");

        $data["nome_view_data"] = Input::inPost("nome_view_data");
        $data["titulo_x"] = Input::inPost("titulo_x");
        $data["titulo_y"] = Input::inPost("titulo_y");
        $data["id_agrupador"] = Input::inPost("id_agrupador");
        $data["id_tipo_grafico"] = Input::inPost("id_tipo_grafico");

        if ($this->viewData->update($data, $idViewData, "id_view_data")) {
            Session::flash('success','Edição realizada com Sucesso!');

        } else {
            Session::flash('error','Erro ao Tentar realizar a Edição!');
        }

        return Redirect::to("viewData.editar", "idViewData={$idViewData}");
    }

    public function marcarMostrarNoDashboard()
    {
        $idViewData = Input::inGet("idViewData");
        $viewData = $this->viewData->findBy("id_view_data", $idViewData);

        if ($viewData["mostrar_no_dashboard"] == 0) {
            $data["mostrar_no_dashboard"] = 1;
        } elseif ($viewData["mostrar_no_dashboard"] == 1) {
            $data["mostrar_no_dashboard"] = 0;
        }

        if ($this->viewData->update($data, $idViewData, "id_view_data")) {
            echo json_encode(["status" => true]);
        } else {
            echo json_encode(["status" => false]);
        }
    }

    public function viewDatas()
    {
        $idUsuario = Input::inGet("idUsuario");
        $viewDatas = $this->viewData->viewDataByIdUsuario($idUsuario);
        $dataDados = $this->data;

        return $this->view->show("view_data.view_datas", compact("viewDatas", "dataDados"));
    }

    public function viewData()
    {
        $segredo = Input::inGet("segredo");

        $viewData = $this->viewData->findBy("segredo", $segredo);
        $valores = [];

        $subTitulo = false;
        $tipoDataEixoX = false;
        $tituloX = false;
        
        # Agrupa por Mês
        if ($viewData["id_agrupador"] == 3) {
            $valores = $this->viewData->groupByMes($segredo);
            $tituloX = "Meses";
        
        # Agrupa por Hora
        } elseif ($viewData["id_agrupador"] == 1) {
            $valores = $this->viewData->groupByHora($segredo);
            $subTitulo = "Dados das ultimas 24 horas";
            $tipoDataEixoX = "hora";
            $tituloX = "Horas";
        
        # Agrupa por Dia
        } elseif ($viewData["id_agrupador"] == 2) {
            $valores = $this->viewData->groupByDia($segredo);
            $subTitulo = "Dados dos ultimos 30 dias";
            $tituloX = "Dias";

        # Agrupa por Minuto
        } elseif ($viewData["id_agrupador"] == 4) {
            $valores = $this->viewData->groupByMinuto($segredo);
            $subTitulo = "Dados dos ultimos 60 minutos";
            $tituloX = "Minutos";
        }

        $mediaEdesvioPadrao = $this->viewData->mediaEdesvioPadrao($this->standardDeviation, $valores);
        $minimoEmaximo = $this->viewData->minimoEmaximo($valores);

        return $this->view->show("view_data.view_data", 
            compact(
                "viewData", 
                "valores",
                "subTitulo",
                "tipoDataEixoX",
                "tituloX",
                "mediaEdesvioPadrao",
                "minimoEmaximo"
        ));
    }

    public function apiInternaViewData()
    {
        $segredo = Input::inGet("segredo");
        
        # Nome da página dos Graficos
        $paginaDoGrafico = false;
        $subTitulo = false;
        $tituloX = false;
        $tipoDataEixoX = false;

        $viewData = $this->viewData->findBy("segredo", $segredo);
        $tipoGrafico = $viewData["id_tipo_grafico"];
        $valores = [];
        
        # Agrupa por Mês
        if ($viewData["id_agrupador"] == 3) {

            $valores = $this->viewData->groupByMes($segredo);
            $subTitulo = "Dados das ultimos 30 dias";
            $tituloX = "Meses";

            if ($tipoGrafico == 3) {
                $paginaDoGrafico = "graficos.coluna.grafico_coluna";
            } else {
                $paginaDoGrafico = "graficos.linha.grafico_linha";
            }
            
        # Agrupa por Hora
        } elseif ($viewData["id_agrupador"] == 1) {

            $valores = $this->viewData->groupByHora($segredo);
            $subTitulo = "Dados das ultimas 24 horas";
            $tituloX = "Horas";
            $tipoDataEixoX = "hora";

            if ($tipoGrafico == 3) {
                $paginaDoGrafico = "graficos.coluna.grafico_coluna";
            } else {
                $paginaDoGrafico = "graficos.linha.grafico_linha";
            }

        # Agrupa por Dia
        } elseif ($viewData["id_agrupador"] == 2) {

            $valores = $this->viewData->groupByDia($segredo);
            $subTitulo = "Dados dos ultimos 30 dias";
            $tituloX = "Dias";

            if ($tipoGrafico == 3) {
                $paginaDoGrafico = "graficos.coluna.grafico_coluna";
            } else {
                $paginaDoGrafico = "graficos.linha.grafico_linha";
            }

        # Agrupa por Minuto
        } elseif ($viewData["id_agrupador"] == 4) {

            $valores = $this->viewData->groupByMinuto($segredo);
            $subTitulo = "Dados dos ultimos 60 minutos";
            $tituloX = "Minutos";
            
            if ($tipoGrafico == 3) {
                $paginaDoGrafico = "graficos.coluna.grafico_coluna";
            } else {
                $paginaDoGrafico = "graficos.linha.grafico_linha";
            }   
        }

        $mediaEdesvioPadrao = $this->viewData->mediaEdesvioPadrao($this->standardDeviation, $valores);

        return $this->view->show($paginaDoGrafico, 
            compact(
                "viewData", 
                "valores",
                "subTitulo",
                "tituloX",
                "tipoDataEixoX",
                "mediaEdesvioPadrao"
        ));
    }

    public function filtrar()
    {
        $tipoDataEixoX = "ano";
        $segredo = Input::inPost("segredo");
        $inicio = Input::inPost("inicio");
        $fim = Input::inPost("fim");

        if ( ! isset($_GET["method_get"])) {
            Redirect::to(
                "viewData.filtrar", 
                "method_get|segredo={$segredo}|inicio={$inicio}|fim={$fim}"
            );
        }

        $segredo = Input::inGet("segredo");
        $inicio = Input::inGet("inicio");
        $fim = Input::inGet("fim");
        
        $valores = [];
        $viewData = $this->viewData->findBy("segredo", $segredo);

        $tipoGrafico = $viewData["id_tipo_grafico"];

        $valores = $this->viewData->filtrarPorPeriodo($segredo, $inicio, $fim);

        if ($tipoGrafico == 3) {
            $paginaDoGrafico = "graficos/coluna/grafico_coluna";
        } else {
            $paginaDoGrafico = "graficos/linha/grafico_linha";
        } 
        
        $mediaEdesvioPadrao = $this->viewData->mediaEdesvioPadrao($this->standardDeviation, $valores);
        $minimoEmaximo = $this->viewData->minimoEmaximo($valores);

        $subTitulo = "Busca por Período: de ".
        Date::dateFormat($inicio)." à ".Date::dateFormat($fim);
        $tituloX = "Data";

        return $this->view->show("view_data.view_data", 
            compact(
                "viewData", 
                "valores",
                "subTitulo",
                "tituloX",
                "paginaDoGrafico",
                "tipoDataEixoX",
                "mediaEdesvioPadrao",
                "minimoEmaximo"
        ));
    }

    public function deletarComponente()
    {
        $idComponente = Input::inGet("idComponente");
        
        if ($this->data->deletarData($idComponente)) {
            $this->viewData->deletarComponente($idComponente);
        }
      
        $idUsuario = Session::getSession("id_usuario");

        Session::flash('success', "Componente Deletado com Sucesso!");
        return Redirect::to('viewData.viewDatas', "idUsuario={$idUsuario}");
    }
}