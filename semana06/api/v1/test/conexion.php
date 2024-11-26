<?php

class Conexion
{
    private $connection;
    private $host;
    private $username;
    private $password;
    private $db;
    private $port;
    private $server;

    public function __construct()
    {
        $this->server = $_SERVER['SERVER_NAME'];
        $this->connection = null;
        $this->host = '127.0.0.1';
        $this->port = 3306; //puerto por default de mysql
        $this->db = 'clinicat1_ipss_backend_t3_s70';
        $this->username = 'root';
        $this->password = '3312';

        
    }

    public function getConnection()
    {
        try {
            $this->connection = mysqli_connect($this->host, $this->username, $this->password, $this->db, $this->port);
            mysqli_set_charset($this->connection, 'utf8');
            if (!$this->connection) {
                throw new Exception("Error en la conexión: " . mysqli_connect_error());
            }
            return $this->connection;
        } catch (Exception $ex) {
            error_log($ex->getMessage());
            die("Error al conectar a la base de datos.");
        }
    }

    public function closeConnection()
    {
        if ($this->connection) {
            mysqli_close($this->connection);
        }
    }
}
