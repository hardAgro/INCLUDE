<?php 
header('Access-Control-Allow-Origin: *');
class ApiController extends Controller
{
    protected $viewData;
    protected $data;
    protected $usuario;

    protected $view;
    protected $layout;

    public function __construct()
    {
        $this->viewData = $this->model('ViewData');
        $this->data = $this->model('Data');
        $this->usuario = $this->model("Usuario");

        $this->view = $this->view();
        $this->layout = $this->view->layout('default-layout');
    }

    public function putByGet()
    {
        $idConta = Input::inGet("idConta");
        $segredo = Input::inGet("segredo");
        $valor = Input::inGet("valor");

        if ( ! Input::has("valor")) {
            echo "Você esqueceu o parametro (valor) na sua URL.";
            exit;
        }

        if ($valor == "") {
            echo "O parametro (valor) não pode ser vazio";
            exit;
        }

        if ( ! is_numeric(filter_var($valor, FILTER_SANITIZE_NUMBER_INT))) {
            echo "Parametro (valor) deve ser um Número";
            exit;
        }

        $usuario = $this->usuario->findBy("id_conta", $idConta);
        $idUsuario = $usuario["id_usuario"];

        $viewData = $this->viewData->findBy("segredo", $segredo);
        $idViewData = $viewData["id_view_data"];

        if ($this->usuario->seIdContaExiste($idConta)) {

            if ($this->viewData->sePertenceAoUsuario($idUsuario, $segredo)) {

                $dataValor["id_view_data"] = $idViewData; 
                $dataValor["id_usuario"] = $idUsuario; 
                $dataValor["valor"] = (float) $valor;
                $dataValor["data_cadastro"] = Date::dateTime();

                if ($this->data->save($dataValor)) {
                    echo json_encode(["status" => "200"]);
                } else {
                    echo json_encode(["status" => "400"]);
                }

            } else {
                echo "Este Segredo não Pertence a este Usuário";
            }

        } else {
            echo "ID da Conta não reconhecido";
        }
    }

    public function callDataBySegredo()
    {
        $segredo = Input::inGet("segredo");
        echo json_encode($this->viewData->groupByMinuto($segredo));
    }

    public function teste()
    {
        $cmdResult = shell_exec("python3 /views/graficos/deviation.py");
        var_dump(json_decode($cmdResult));
    }

    public function getData()
    {
        $idConta = Input::inGet("idConta");
        $segredo = Input::inGet("segredo");
        $agrupador = Input::inGet("agrupador");
        $apenasOultimoRegistro = strtolower(Input::inGet("lastData"));

        if ( ! Input::has("idConta")) {
            echo "Você esqueceu o id da sua conta.";
            exit;
        }

        if ( ! Input::has("segredo")) {
            echo "Você esqueceu o segredo do seu componente.";
            exit;
        }

        if ( ! Input::has("agrupador")) {
            echo "Escolha um Agrupador! São eles: byMinuto, byHora, byDia, byMes";
            exit;
        }

        if ($agrupador !== "byMinuto" && $agrupador !== "byHora" && $agrupador !== "byDia" && $agrupador !== "byMes") {
            echo "Escolha um Agrupador! São eles: byMinuto, byHora, byDia, byMes";
            exit;
        }

        $usuario = $this->usuario->findBy("id_conta", $idConta);
        $idUsuario = $usuario["id_usuario"];

        $viewData = $this->viewData->findBy("segredo", $segredo);
        $idViewData = $viewData["id_view_data"];

        if ($this->usuario->seIdContaExiste($idConta)) {

            if ($this->viewData->sePertenceAoUsuario($idUsuario, $segredo)) {
                
                $arrayData = [];

                if ($apenasOultimoRegistro == "true") {
                    foreach ($this->viewData->ultimoRegistroDoComponente($segredo) as $data) {
                        array_push($arrayData, $data);
                    }
                }

                if ($agrupador == "byHora") {
                    foreach ($this->viewData->groupByHora($segredo) as $data) {
                        array_push($arrayData, $data);
                    }

                } elseif ($agrupador == "byMes") {
                     foreach ($this->viewData->groupByMes($segredo) as $data) {
                        array_push($arrayData, $data);
                    }

                } elseif ($agrupador == "byMes") {
                     foreach ($this->viewData->groupByDia($segredo) as $data) {
                        array_push($arrayData, $data);
                    }

                } elseif ($agrupador == "byMinuto") {
                     foreach ($this->viewData->groupByMinuto($segredo) as $data) {
                        array_push($arrayData, $data);
                    }
                }

                if (count($arrayData) < 1) {
                    echo "Nenhum dado para este periodo!";
                } else {
                    echo json_encode($arrayData);
                }

            } else {
                echo "Este Segredo não Pertence a este Usuário";
            }

        } else {
            echo "ID da Conta não reconhecido";
        }
    }

    public function getComponenteFromApp()
    {
        $idComponente = Input::inGet("idComponente");
        $segredo = $this->viewData->findBy("id_view_data", $idComponente);
        $periodo = Input::inGet("periodo");

        if ($periodo == "minuto") {
            echo json_encode($this->viewData->groupByMinuto($segredo["segredo"], "DESC"));
        } elseif ($periodo == "hora") {
            echo json_encode($this->viewData->groupByHora($segredo["segredo"], "DESC"));
        } elseif ($periodo == "dia") {
            echo json_encode($this->viewData->groupByDia($segredo["segredo"], "DESC"));
        } else {
            echo json_encode($this->viewData->groupByMinuto($segredo["segredo"], "DESC"));
        }
    }

    public function getComponenteByIdUsuario()
    {
        $idUsuario = Input::inGet("idUsuario");
        echo json_encode($this->viewData->componentesPorIdDoUsuario($idUsuario));
    }

    public function logar() 
    {
        $dataLogin['login'] = Input::inGet('login');
        $dataLogin['password'] = Input::inGet('password');

        # Verifica se o Usuário que está tentando logar existe na tabela (usuario)
        if ($this->usuario->userExist($dataLogin)) {
            $usuario = $this->usuario->findBy('login', $dataLogin['login']);
            echo json_encode(["nome" => $usuario["nome_usuario"], "id" => $usuario["id_usuario"], "status" => 200]);
        } else {
            echo json_encode(["status" => 0]);
        }
    }
}