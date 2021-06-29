<?php

include_once("../fachada.php");

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
        $data = $_POST;
        $data_pedido = strtotime($data['data_pedido']);
        $data_entrega = strtotime($data['data_entrega']);

        $pedido = new Pedido(null,intval($data['numero']),date('Y-m-d h:i:s', $data_pedido),date('Y-m-d h:i:s', $data_entrega),intval($data['situacao']),intval($data['cliente_id']));
        $dao_pedido->insere($pedido);
        http_response_code(201);
        break;
    case 'PUT':
        if(!empty($_GET['id'])){
            $id=intval($_GET['id']);
            $pedido = $dao_pedido->buscaPorId($id);
            
            $data = _parsePut();
            
            if($pedido) {
                $data_pedido = strtotime($data['data_pedido']);
                $data_entrega = strtotime($data['data_entrega']);
                $pedido->setNumero(intval($data['numero']));
                $pedido->setDataPedido(date('Y-m-d h:i:s', $data_pedido));
                $pedido->setDataEntrega(date('Y-m-d h:i:s', $data_entrega));
                $pedido->setSituacao(intval($data['situacao']));
                $pedido->setClienteID(intval($data['cliente_id']));
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
            $pedido = $dao_pedido->buscaPorId($id);
            $dao_pedido->remove($pedido);
            http_response_code(204);
        }else{
            http_response_code(404);
        }
        break;
    default:
        http_response_code(405);
        break;
}

function _parsePut()
{
    global $_PUT;

    /* PUT data comes in on the stdin stream */
    $putdata = fopen("php://input", "r");

    /* Open a file for writing */
    // $fp = fopen("myputfile.ext", "w");

    $raw_data = '';

    /* Read the data 1 KB at a time
       and write to the file */
    while ($chunk = fread($putdata, 1024))
        $raw_data .= $chunk;

    /* Close the streams */
    fclose($putdata);

    // Fetch content and determine boundary
    $boundary = substr($raw_data, 0, strpos($raw_data, "\r\n"));

    if(empty($boundary)){
        parse_str($raw_data,$data);
        $GLOBALS[ '_PUT' ] = $data;
        return;
    }

    // Fetch each part
    $parts = array_slice(explode($boundary, $raw_data), 1);
    $data = array();

    foreach ($parts as $part) {
        // If this is the last part, break
        if ($part == "--\r\n") break;

        // Separate content from headers
        $part = ltrim($part, "\r\n");
        list($raw_headers, $body) = explode("\r\n\r\n", $part, 2);

        // Parse the headers list
        $raw_headers = explode("\r\n", $raw_headers);
        $headers = array();
        foreach ($raw_headers as $header) {
            list($name, $value) = explode(':', $header);
            $headers[strtolower($name)] = ltrim($value, ' ');
        }

        // Parse the Content-Disposition to get the field name, etc.
        if (isset($headers['content-disposition'])) {
            $filename = null;
            $tmp_name = null;
            preg_match(
                '/^(.+); *name="([^"]+)"(; *filename="([^"]+)")?/',
                $headers['content-disposition'],
                $matches
            );
            list(, $type, $name) = $matches;

            //Parse File
            if( isset($matches[4]) )
            {
                //if labeled the same as previous, skip
                if( isset( $_FILES[ $matches[ 2 ] ] ) )
                {
                    continue;
                }

                //get filename
                $filename = $matches[4];

                //get tmp name
                $filename_parts = pathinfo( $filename );
                $tmp_name = tempnam( ini_get('upload_tmp_dir'), $filename_parts['filename']);

                //populate $_FILES with information, size may be off in multibyte situation
                $_FILES[ $matches[ 2 ] ] = array(
                    'error'=>0,
                    'name'=>$filename,
                    'tmp_name'=>$tmp_name,
                    'size'=>strlen( $body ),
                    'type'=>$value
                );

                //place in temporary directory
                file_put_contents($tmp_name, $body);
            }
            //Parse Field
            else
            {
                $data[$name] = substr($body, 0, strlen($body) - 2);
            }
        }

    }
    $GLOBALS[ '_PUT' ] = $data;
    return $data;
}

?>