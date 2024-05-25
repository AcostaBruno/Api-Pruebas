<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require 'db.php';
require_once 'comunicacion.php';

switch($_POST['op']){
    case '1':
        $text = date('d-m-Y H:i:s') . " - Solicitud recibida 1\n";
        file_put_contents('log.txt', $text, FILE_APPEND);

        $nombre = $_POST['nombre'];
        $contrasena = $_POST['contrasena'];


        $consulta = "SELECT * FROM usuarios WHERE nombre = '$nombre' AND contrasena = '$contrasena'";
        $resultado = $conn->query($consulta);
    


        if ($resultado->num_rows > 0) {
            file_put_contents('log.txt', "44\n", FILE_APPEND);
            $row = $resultado->fetch_assoc();
            $datos = array( 'error' => 'Usuario correcto', 'id' => $row['id'], 'nombre' => $row['nombre'], 'comentario' => $row['comentario']);

            $text = date('d-m-Y H:i:s') . " - Usuario valido " . $row['nombre'] ."\n";
            file_put_contents('log.txt', $text, FILE_APPEND);

            echo json_encode($datos);
           
        } else {
            $text = date('d-m-Y H:i:s') . " - Usuario invalido\n";
            file_put_contents('log.txt', $text, FILE_APPEND);

            $datos = array('error' => 'Usuario o contraseña incorrectos', 'op' => '1');
            echo json_encode($datos);
         
        }

        break;
    case '2':
        $nombre = $_POST['nombre']; 
        $contrasena = $_POST['contrasena'];
        $comentario = $_POST['comentario'];



        $consulta = "INSERT INTO usuarios (nombre, contrasena, comentario) VALUES ('$nombre', '$contrasena', '$comentario')";
        if ($conn->query($consulta) === TRUE) {
            $datos = array('mensaje' => 'Usuario registrado correctamente');
            $text = date('d-m-Y H:i:s') . " - Usuario registrado correctamente\n";
        } else {
            $datos = array('error' => 'Error al registrar el usuario');
            $text = date('d-m-Y H:i:s') . " - Error al registrar el usuario\n";
        }

        echo json_encode($datos);
        break;
}