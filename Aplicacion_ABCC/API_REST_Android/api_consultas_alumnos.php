<?php

    include('../sitio/scripts_php/conexion_bd.php');

    $con = new ConexionBD();
    $conexion = $con->getConexion();

    //var_dump($conexion);

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $cadena_JSON = file_get_contents('php://input'); //Recibe información a través de HTTP

        if($cadena_JSON == false) {
            echo "No hay cadena JSON";
        } else {
            $filtro = json_decode($cadena_JSON, true);

            $sql = "SELECT * FROM Alumnos";

            $res = mysqli_query($conexion, $sql);
            
            $datos['alumnos'] = array();
            if($res) {
                //Todo bien
                while($fila = mysqli_fetch_assoc($res)) {
                    $alumno = array();
                    $alumno['nc'] = $fila['NoControl'];
                    $alumno['n'] = $fila['nombre'];
                    $alumno['pa'] = $fila['apellido'];
                    $alumno['sa'] = $fila['apellido2'];
                    $alumno['e'] = $fila['edad'];
                    $alumno['s'] = $fila['semestre'];
                    $alumno['c'] = $fila['carrera'];

                    array_push($datos['alumnos'], $alumno);
                }

                echo json_encode($datos);

            } else {
                //Todo mal
                $respuesta['exito'] = false;
                $respuesta['mensaje'] = "Error en la carga de datos";
                $cad = json_encode($respuesta);
                var_dump($cad);
            }
        }        

    } else {
        echo "No hay peticion HTTP";
    }

?>