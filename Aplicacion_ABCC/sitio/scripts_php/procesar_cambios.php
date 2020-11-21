<?php

    include('alumnoDAO.php');

    //Validación de datos

    $nc = $_POST['caja_num_control'];
    $n = $_POST['caja_nombre'];
    $pa = $_POST['caja_primer_ap'];
    $sa = $_POST['caja_segundo_ap'];
    $e = $_POST['caja_edad'];
    $s = $_POST['caja_semestre'];
    $c = $_POST['caja_carrera'];

    $aDAO = new AlumnoDAO();

    $aDAO->modificarAlumnos($nc, $n, $pa, $sa, $e, $s, $c);


?>