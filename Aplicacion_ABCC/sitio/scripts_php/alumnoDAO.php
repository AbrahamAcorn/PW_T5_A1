<?php
    include('conexion_bd.php');

    class AlumnoDAO {
        private $conexion;

        public function __construct() {
            $this->conexion = new ConexionBD();
        }

        //=============================== METODOS PARA ABCC ===============================

        //------------------------------- ALTAS -------------------------------

        public function agregarAlumnos($nc, $n, $pa, $sa, $e, $s, $c) {
            $sql = "INSERT INTO Alumnos VALUES('$nc', '$n', '$pa', '$sa', $e, $s, '$c')";
            
            if(mysqli_query($this->conexion->getConexion(), $sql) ) {
                //echo "Perfecto, casi soy ISC =)";
                //header('location:..........')
                echo "<script> alert('Agregado con Exito'); </script>";
                header('location:../vistas/formulario_altas.php');

            } else {
                echo "¿Será muy tarde para cambiar de carrera?";
                echo mysqli_error($this->conexion->getConexion());
            }
        }

        public function eliminarAlumnos($nc) {
            $sql = "DELETE FROM Alumnos WHERE NoControl='$nc'";
            
            if(mysqli_query($this->conexion->getConexion(), $sql) ) {
                //echo "Perfecto, casi soy ISC =)";
                //header('location:..........')
                //echo "<script> alert('Agregado con Exito'); </script>";
                header('location:../vistas/formulario_bajas.php');

            } else {
                echo "¿Será muy tarde para cambiar de carrera?";
                echo mysqli_error($this->conexion->getConexion());
            }
        }

        public function modificarAlumnos($nc, $n, $pa, $sa, $e, $s, $c) {
            $sql = "UPDATE Alumnos SET NoControl='$nc', nombre='$n', apellido='$pa', Apellido2='$sa', edad=$e, Semestre=$s, Carrera='$c' WHERE NoControl='$nc';";
            
            if(mysqli_query($this->conexion->getConexion(), $sql) ) {
                echo "<script> alert('Modificado con Exito'); </script>";
                header('location:../vistas/formulario_cambios.php');

            } else {
                echo "¿Será muy tarde para cambiar de carrera?";
                echo mysqli_error($this->conexion->getConexion());
            }
        }

        public function buscarAlumnos($campo, $valor) {
            $sql = "SELECT * FROM Alumnos WHERE ".$campo."='$valor'";
            
            if(mysqli_query($this->conexion->getConexion(), $sql) ) {
                echo "<script> alert('Busqueda con Exito'); </script>";
                header('location:../vistas/formulario_consultas.php');

            } else {
                echo "¿Será muy tarde para cambiar de carrera?";
                echo mysqli_error($this->conexion->getConexion());
            }
        }


    }
?>