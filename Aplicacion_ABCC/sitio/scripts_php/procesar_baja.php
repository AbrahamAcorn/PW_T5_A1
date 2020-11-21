<?php

    include('alumnoDAO.php');

    //Validación de datos
    $aDAO = new AlumnoDAO();
    $nc = $_GET['nc'];
    $aDAO->eliminarAlumnos($nc);
?>