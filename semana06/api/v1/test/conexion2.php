<?php


class Conexion2 {

   
    private $host = "localhost";      
    private $usuario = "root";        
    private $contraseña = "3312";         
    private $base_de_datos = "clinicat1_ipss_backend_t3_s70"; 

    private $conexion; 

    
    public function __construct() {
     
        $this->conectar();
    }

   
    private function conectar() {
       
        $this->conexion = new mysqli($this->host, $this->usuario, $this->contraseña, $this->base_de_datos);
        
        
        if ($this->conexion->connect_error) {
            
            die("Conexión fallida: " . $this->conexion->connect_error);
        }
    }

    
    public function getConnection() {
        return $this->conexion;
    }

    public function closeConnection() {
        $this->conexion->close();
    }
}
?>
