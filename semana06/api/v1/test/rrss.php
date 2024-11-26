<?php
class rrss
{
    private $id;
    private $rrss; 
    private $icono; 
    private $link; 
    private $activo; 

    public function __construct($id = null, $rrss = null, $icono = null, $link = null, $activo = null)
    {
        $this->id = $id;
        $this->rrss = $rrss;
        $this->icono = $icono;
        $this->link = $link;
        $this->activo = $activo;
    }

    // Getters y setters
    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }

    public function getRrss() { return $this->rrss; }
    public function setRrss($rrss) { $this->rrss = $rrss; }

    public function getIcono() { return $this->icono; }
    public function setIcono($icono) { $this->icono = $icono; }

    public function getLink() { return $this->link; }
    public function setLink($link) { $this->link = $link; }

    public function getActivo() { return $this->activo; }
    public function setActivo($activo) { $this->activo = $activo; }

    // Método para obtener todos los RRSS
    public function getAll()
    {
        $lista = [];
        $con = new Conexion();
        $query = "SELECT id, rrss, icono, link, activo FROM rrss"; 

       
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

    // Método para agregar un nuevo RRSS
    public function add(rrss $_nuevo)
    {
        $con = new Conexion();
        
      
        $query = "INSERT INTO rrss (rrss, icono, link, activo) VALUES (?, ?, ?, ?)";
        
        if ($stmt = $con->getConnection()->prepare($query)) {
            $activo = $_nuevo->getActivo() ? 1 : 0;
            $stmt->bind_param('sssi', $_nuevo->getRrss(), $_nuevo->getIcono(), $_nuevo->getLink(), $activo);
            $stmt->execute();
            $stmt->close();
        }

        $con->closeConnection();
        return true;
    }
}
?>
