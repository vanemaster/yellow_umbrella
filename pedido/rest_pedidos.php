<?php

include_once("../fachada.php");
include_once("../login/verifica.php");

$result = true;

ini_set('display_errors', 'On');

$dao_pedido = $factory->getPedidoDao();

$request_method=$_SERVER["REQUEST_METHOD"];

switch($request_method){
    case 'GET':
        if(!empty($_GET["id"])){
            $id = intval($_GET["id"]);
            $pedido = $dao_pedido->buscaPorId($id);

            if($pedido){
               $result = array(
                   "id" => $pedido->getId(),
                   "numero" => $pedido->getNumero(),
                   "data_pedido" => $pedido->getDataPedido(),
                   "data_entrega" => $pedido->getDataEntrega(),
                   "situacao" => $pedido->getSituacao(),
                   "cliente_id" => $pedido->getClienteID(),
               );
               echo json_encode($result);
               http_response_code(200);
            }else{
                http_response_code(404);
            }
        }else{
            http_response_code(404);
        }
        break;
    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);

        $pedido = new Pedido(null,$data['numero'],$data['data_pedido'],$data['data_entrega'],$data['situacao'],$data['cliente_id']);
        $dao_pedido->insere($pedido);
        http_response_code(201);
        break;
    case 'PUT':
        if(!empty($_GET['id'])){
            $id=intval($_GET['id']);
            $pedido = $dao_pedido->buscaPorId($id);
            
            if($pedido) {
                $data = json_decode(file_get_contents('php://input'), true);
                $pedido->setNumero($data['numero']);
                $pedido->setDataPedido($data['data_pedido']);
                $pedido->setDataEntrega($data['data_entrega']);
                $pedido->setSituacao($data['situacao']);
                $pedido->setClienteID($data['cliente_id']);
                $dao_pedido->altera($pedido);
                http_response_code(200);
            }else{
                http_response_code(404);
            }
        }else{
            http_response_code(404);
        }
        break;
    case 'DELETE':
        if(!empty($_GET['id'])){
            $id=intval($_GET['id']);
            $dao_pedido->remove($id);
            http_response_code(204);
        }else{
            http_response_code(404);
        }
        break;
    default:
        http_response_code(405);
        break;
}

?>