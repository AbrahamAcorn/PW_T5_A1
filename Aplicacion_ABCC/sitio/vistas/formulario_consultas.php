<?php
    
    session_start();
    if($_SESSION['autenticado'] == false) {
        header("location:index.php");
    } 

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <title>CONSULTAS ALUMNOS</title>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel='stylesheet' type='text/css' media='screen' href='../estilos/tabla.css'>
        <script src='main.js'></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    </head>

    <body>
        <?php
            require_once('index2.html');
        ?>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand">Buscar por:</a>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <form class="form-inline my-2 my-lg-0" action="formulario_consultas.php" method="post">

                    <ul class="navbar-nav mt-2 mt-lg-0 mr-3">
                        <li class="nav-item dropdown">
                            <select name="campo">
                                <option >Num. de control</option>
                                <option >Nombre</option>
                                <option >Primer Ap.</option>
                                <option >Segundo Ap.</option>
                                <option >Edad</option>
                                <option >Semestre</option>
                                <option >Carrera</option>
                            </select>
                        </li>
                    </ul>

                    <input class="form-control mr-sm-2" type="search" placeholder="Search" name="valor" id="valor">
                    <input class="btn btn-outline-success my-2 my-sm-0" type="submit" value="Search" name="buscar">
                    <!--<button class="btn btn-outline-success my-2 my-sm-0" type="submit" >Search</button>-->
                </form>
            </div>
        </nav>

        <table id="customers">
            <tr> 
                <th>Num. Control</th> 
                <th>Nombre</th> 
                <th>Primer Ap.</th> 
                <th>Segundo Ap.</th> 
                <th>Edad</th> 
                <th>Semestre</th> 
                <th>Carrera</th>
            </tr>

            <?php

                if(isset($_POST['buscar'])) {
                    include('../scripts_php/conexion_bd.php');
                    $campo = $_POST['campo'];
                    $valor = $_POST['valor'];

                    echo "Campo: ".$campo;
                    echo "<br>Valor: ".$valor."<br>";

                    if($campo == 'Num. de control') {
                        $campo = 'NoControl';
                    } else if($campo == 'Primer Ap.') {
                        $campo = 'apellido';
                    } else if($campo == 'Segundo Ap.') {
                        $campo = 'apellido2';
                    }

                    $con = new ConexionBD();
                    $conexion = $con->getConexion();
                    $sql = "SELECT * FROM Alumnos WHERE $campo = '$valor'";

                    $res = mysqli_query($conexion, $sql);                

                    if($res) {
                        while( $fila = mysqli_fetch_assoc($res)) {
                            printf(
                                "<tr><td>".$fila['NoControl']."</td>".
                                "<td>".$fila['nombre']."</td>".
                                "<td>".$fila['apellido']."</td>".
                                "<td>".$fila['apellido2']."</td>".
                                "<td>".$fila['edad']."</td>".
                                "<td>".$fila['semestre']."</td>".
                                "<td>".$fila['carrera']."</td></tr>"
                            );
                        }
                    } else {
                        echo "<script> alert('No hay datos'); ";
                    }
                }
            ?>

        </table>

    </body>