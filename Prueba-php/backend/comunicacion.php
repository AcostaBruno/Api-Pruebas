<?php


function enviarDatos($direccion, $datos){
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($datos),
        ),
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($direccion, false, $context);
    
    if ($result === FALSE) { 
        $text = date('d-m-Y H:i:s') . " - Error con la operacion con el endpoint: ". $direccion . "\n";
        file_put_contents('log.txt', $text, FILE_APPEND);
        return false;
    }

    $text = date('d-m-Y H:i:s') . " - Datos de regreso ". $direccion . "  " .var_dump($datos). " \n";
    file_put_contents('log.txt', $text, FILE_APPEND);
    return true;
}