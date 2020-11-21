<?php

    class ConexionBD {
        private $conexion;

        private $host = 'localhost:3306';
        private $usuario = 'acorn';
        private $contraseña = 'pepe';
        private $bd = 'BD_Escuela_usuarios';

        public function __construct() {
            $this->conexion = mysqli_connect($this->host, $this->usuario, $this->contraseña, $this->bd);
        }

        public function getConexion() {
            return  $this->conexion;
        }
    }

?>