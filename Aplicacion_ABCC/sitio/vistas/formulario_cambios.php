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
        <title>CAMBIOS ALUMNOS</title>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
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
                <form class="form-inline my-2 my-lg-0" action="formulario_cambios.php" method="post">

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

        <?php

            include('../scripts_php/conexion_bd.php');

            function buscarRetorno() {
                if(isset($_POST['buscar'])) {

                    $campo = $_POST['campo'];
                    $valor = $_POST['valor'];
    
                    //echo "Campo: ".$campo;
                    //echo "<br>Valor: ".$valor."<br>";
    
                    if($campo == 'Num. de control') {
                        $campo = 'Num_Control';
                    } else if($campo == 'Primer Ap.') {
                        $campo = 'Primer_Ap';
                    } else if($campo == 'Segundo Ap.') {
                        $campo = 'Segundo_Ap';
                    }
    
                    $con = new ConexionBD();
                    $conexion = $con->getConexion();
                    $sql = "SELECT * FROM Alumnos WHERE $campo = '$valor'";
    
                    $res = mysqli_query($conexion, $sql);                
    
                    $fila = mysqli_fetch_assoc($res);
                    return $fila;
                } else {
                    $fila['Num_Control'] = "";
                    $fila['Nombre'] = "";
                    $fila['Primer_AP'] = "";
                    $fila['Segundo_AP'] = "";
                    $fila['Edad'] = "";
                    $fila['Semestre'] = "Elige una opción";
                    $fila['Carrera'] = "";
                    return $fila;
                }
            }
            
        ?>


        <form method="POST" action="../scripts_php/procesar_cambios.php">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Numero Control</label>
                    <input type="text" class="form-control" id="inputEmail4" placeholder="Número de control" name="caja_num_control" value="<?php echo buscarRetorno()['Num_Control']; ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Nombre</label>
                    <input type="text" class="form-control" id="inputPassword4" placeholder="Solo letras" name="caja_nombre" value="<?php echo buscarRetorno()['Nombre']; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="inputAddress">Primer Apellido</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="solo letras" name="caja_primer_ap" value="<?php echo buscarRetorno()['Primer_AP']; ?>">
            </div>
            <div class="form-group">
                <label for="inputAddress2">Segundo Apellido</label>
                <input type="text" class="form-control" id="inputAddress2" placeholder="Solo letras" name="caja_segundo_ap" value="<?php echo buscarRetorno()['Segundo_AP']; ?>"> 
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputCity">Edad</label>
                    <input type="text" class="form-control" id="inputCity" placeholder="Edad" name="caja_edad" value="<?php echo buscarRetorno()['Edad']; ?>"> 
                </div>
                <div class="form-group col-md-4">
                    <label for="inputState">Semestre</label>
                    <select id="inputState" class="form-control" name="caja_semestre">
                        <option><?php echo buscarRetorno()['Semestre']; ?></option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                        <option>7</option>
                        <option>8</option>
                        <option>9</option>
                        <option>10</option>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="inputZip">Carrera</label>
                    <input type="text" class="form-control" id="inputZip" name="caja_carrera" value="<?php echo buscarRetorno()['Carrera']; ?>">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>

    </body>

</html>