<?php

    include('alumnoDAO.php');

    //Validación de datos

    $campo = $_POST['campo'];
    $valor = $_POST['valor'];

    $aDAO = new AlumnoDAO();

    $aDAO->buscarAlumnos($campo, $valor);


?>