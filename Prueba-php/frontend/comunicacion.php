<?php


switch($_POST['operacion']){
    case 'inicioDeSecion':
        
        $nombre = $_POST['nombre'];
        $contrasena = $_POST['contrasena'];

        // Crea un array con los datos a enviar
        $data = array('op' =>1,'nombre' => $nombre, 'contrasena' => $contrasena);
        //var_dump($data);
        //die();
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data),
                'timeout' => 60,  // Tiempo de espera en segundos, si no se recibe respuesta se genera un error,
            ),
        );
        $context  = stream_context_create($options);
        $result = file_get_contents('http://backend/endpoint.php', false, $context);

        if ($result === FALSE) { 
            // Maneja el error
            echo "Hubo un error al hacer la solicitud.";
        } else {
            // Elimina el texto "Conectado exitosamente" de la respuesta
            $json = str_replace("Connected successfully", "", $result);
          
            // Decodifica la respuesta JSON a una variable PHP
            $data = json_decode($json, true);
            // Ahora se puede acceder a los datos como un array de PHP
            if(isset($data['error'])){
                header('Location: index.php?error='.$data['error']);    
           }
        }


        break;
    case 'registro':
        $nombre = $_POST['nombre'];
        $contrasena = $_POST['contrasena'];
        $comentario = $_POST['comentario'];

        $data = array('op' => '2', 'nombre' => $nombre, 'contrasena' => $contrasena, 'comentario' => $comentario);
        //var_dump($data);
        //die();   
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data),
            ),
        );
        $context  = stream_context_create($options);
        $result = file_get_contents('http://backend/endpoint.php', false, $context);

        if ($result === FALSE) { 
            // Maneja el error
            echo "Hubo un error al hacer la solicitud.";
        } else {
            // Elimina el texto "Conectado exitosamente" de la respuesta
            $json = str_replace("Connected successfully", "", $result);
          
            // Decodifica la respuesta JSON a una variable PHP
            $data = json_decode($json, true);
           
            // Ahora se puede acceder a los datos como un array de PHP
            if(isset($data['mensaje'])){
                header('Location: index.php?error='.$data['mensaje']);    
           }
        }
        break;
}


