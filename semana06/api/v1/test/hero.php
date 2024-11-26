<?php
class hero
{
    private $id;
    private $tipo; 
    private $titulo_esp; 
    private $titulo_eng; 
    private $parrafo_esp;
    private $parrafo_eng; 
    private $activo;

    public function __construct($id = null, $tipo = null, $titulo_esp = null, $titulo_eng = null, $parrafo_esp = null, $parrafo_eng = null, $activo = null)
    {
        $this->id = $id;
        $this->tipo = $tipo;
        $this->titulo_esp = $titulo_esp;
        $this->titulo_eng = $titulo_eng;
        $this->parrafo_esp = $parrafo_esp;
        $this->parrafo_eng = $parrafo_eng;
        $this->activo = $activo;
    }

    // Getters y setters
    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }
    public function getTipo() { return $this->tipo; }
    public function setTipo($tipo) { $this->tipo = $tipo; }
    public function getTituloEsp() { return $this->titulo_esp; }
    public function setTituloEsp($titulo_esp) { $this->titulo_esp = $titulo_esp; }
    public function getTituloEng() { return $this->titulo_eng; }
    public function setTituloEng($titulo_eng) { $this->titulo_eng = $titulo_eng; }
    public function getParrafoEsp() { return $this->parrafo_esp; }
    public function setParrafoEsp($parrafo_esp) { $this->parrafo_esp = $parrafo_esp; }
    public function getParrafoEng() { return $this->parrafo_eng; }
    public function setParrafoEng($parrafo_eng) { $this->parrafo_eng = $parrafo_eng; }
    public function getActivo() { return $this->activo; }
    public function setActivo($activo) { $this->activo = $activo; }

    // Método para obtener todos los servicios
    public function getAll()
    {
        $lista = [];
        $con = new Conexion();
        $query = "SELECT id, tipo, titulo_esp, titulo_eng, parrafo_esp, parrafo_eng, activo FROM hero";

        
        if ($stmt = $con->getConnection()->prepare($query)) {
            $stmt->execute();
            $result = $stmt->get_result();
            
            while ($registro = $result->fetch_assoc()) {
                $lista[] = $registro;
            }

            $stmt->close();
        }

        $con->closeConnection();
        return $lista;
    }

    
    public function add(hero $_nuevo)
    {
        $con = new Conexion();
        
       
        $query = "INSERT INTO hero (tipo, titulo_esp, titulo_eng, parrafo_esp, parrafo_eng, activo) VALUES (?, ?, ?, ?, ?, ?)";
        
        if ($stmt = $con->getConnection()->prepare($query)) {
            $stmt->bind_param(
                'sssssi', 
                $_nuevo->getTipo(), 
                $_nuevo->getTituloEsp(), 
                $_nuevo->getTituloEng(), 
                $_nuevo->getParrafoEsp(), 
                $_nuevo->getParrafoEng(), 
                $_nuevo->getActivo() ? 1 : 0
            );
            $stmt->execute();
            $stmt->close();
        }

        $con->closeConnection();
        return true;
    }
}
?>
