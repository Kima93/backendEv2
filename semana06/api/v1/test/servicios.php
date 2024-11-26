<?php
class servicios
{
    private $id;
    private $titulo_esp; 
    private $titulo_eng; 
    private $descripcion_esp; 
    private $descripcion_eng; 
    private $activo;

    public function __construct($id = null, $titulo_esp = null, $titulo_eng = null, $descripcion_esp = null, $descripcion_eng = null, $activo = null)
    {
        $this->id = $id;
        $this->titulo_esp = $titulo_esp;
        $this->titulo_eng = $titulo_eng;
        $this->descripcion_esp = $descripcion_esp;
        $this->descripcion_eng = $descripcion_eng;
        $this->activo = $activo;
    }

    // Getters y setters
    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }
    public function getTituloEsp() { return $this->titulo_esp; }
    public function setTituloEsp($titulo_esp) { $this->titulo_esp = $titulo_esp; }
    public function getTituloEng() { return $this->titulo_eng; }
    public function setTituloEng($titulo_eng) { $this->titulo_eng = $titulo_eng; }
    public function getDescripcionEsp() { return $this->descripcion_esp; }
    public function setDescripcionEsp($descripcion_esp) { $this->descripcion_esp = $descripcion_esp; }
    public function getDescripcionEng() { return $this->descripcion_eng; }
    public function setDescripcionEng($descripcion_eng) { $this->descripcion_eng = $descripcion_eng; }
    public function getActivo() { return $this->activo; }
    public function setActivo($activo) { $this->activo = $activo; }

    // Método para obtener todos los servicios
    public function getAll()
    {
        $lista = [];
        $con = new Conexion();
        $query = "SELECT id, titulo_esp, titulo_eng, descripcion_esp, descripcion_eng, activo FROM servicios"; // Reemplaza indicador por servicio

        
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
        
        
        $query = "INSERT INTO servicio (titulo_esp, titulo_eng, descripcion_esp, descripcion_eng, activo) VALUES (?, ?, ?, ?, ?)";
        
        if ($stmt = $con->getConnection()->prepare($query)) {
            $activo = $_nuevo->getActivo() ? 1 : 0;
            $stmt->bind_param('ssssi', $_nuevo->getTituloEsp(), $_nuevo->getTituloEng(), $_nuevo->getDescripcionEsp(), $_nuevo->getDescripcionEng(), $activo);
            $stmt->execute();
            $stmt->close();
        }

        $con->closeConnection();
        return true;
    }
}
?>
