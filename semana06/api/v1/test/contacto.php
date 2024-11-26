<?php
class contacto
{
    private $id;
    private $tipo;          
    private $valor;         
    private $activo;        

    public function __construct($id = null, $tipo = null, $valor = null, $activo = null)
    {
        $this->id = $id;
        $this->tipo = $tipo;
        $this->valor = $valor;
        $this->activo = $activo;
    }

    // Getters y setters
    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }
    public function getTipo() { return $this->tipo; }
    public function setTipo($tipo) { $this->tipo = $tipo; }
    public function getValor() { return $this->valor; }
    public function setValor($valor) { $this->valor = $valor; }
    public function getActivo() { return $this->activo; }
    public function setActivo($activo) { $this->activo = $activo; }

    // Método para obtener todos los servicios
    public function getAll()
    {
        $lista = [];
        $con = new Conexion();
        $query = "SELECT id, tipo, valor, activo FROM contacto";

        // Usamos consultas preparadas para evitar inyecciones SQL
        if ($stmt = $con->getConnection()->prepare($query)) {
            $stmt->execute();
            $result = $stmt->get_result();
            
            while ($registro = $result->fetch_assoc()) {
                $registro['activo'] = $registro['activo'] == 1 ? true : false;
                $lista[] = $registro;
            }

            $stmt->close();
        }

        $con->closeConnection();
        return $lista;
    }

    // Método para agregar un nuevo servicio
    public function add(servicios $_nuevo)
    {
        $con = new Conexion();
        
       
        $query = "INSERT INTO contacto (tipo, valor, activo) VALUES (?, ?, ?)";
        
        if ($stmt = $con->getConnection()->prepare($query)) {
            $activo = $_nuevo->getActivo() ? 1 : 0;
            $stmt->bind_param('ssi', $_nuevo->getTipo(), $_nuevo->getValor(), $activo);
            $stmt->execute();
            $stmt->close();
        }

        $con->closeConnection();
        return true;
    }
}
?>
