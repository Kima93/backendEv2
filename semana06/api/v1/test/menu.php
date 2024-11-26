<?php
class menu
{
    private $id;
    private $tipo; 
    private $link; 
    private $texto; 
    private $idioma; 
    private $activo;

    public function __construct($id = null, $tipo = null, $link = null, $texto = null, $idioma = null, $activo = null)
    {
        $this->id = $id;
        $this->tipo = $tipo;
        $this->link = $link;
        $this->texto = $texto;
        $this->idioma = $idioma;
        $this->activo = $activo;
    }

    // Getters y setters
    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }
    public function getTipo() { return $this->tipo; }
    public function setTipo($tipo) { $this->tipo = $tipo; }
    public function getLink() { return $this->link; }
    public function setLink($link) { $this->link = $link; }
    public function getTexto() { return $this->texto; }
    public function setTexto($texto) { $this->texto = $texto; }
    public function getIdioma() { return $this->idioma; }
    public function setIdioma($idioma) { $this->idioma = $idioma; }
    public function getActivo() { return $this->activo; }
    public function setActivo($activo) { $this->activo = $activo; }

    // Método para obtener todos los registros
    public function getAll()
    {
        $lista = [];
        $con = new Conexion();
        $query = "SELECT id, tipo, link, texto, idioma, activo FROM menu"; 

        
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

    // Método para agregar un nuevo registro
    public function add(menu $_nuevo)
    {
        $con = new Conexion();

       
        $query = "INSERT INTO menu (tipo, link, texto, idioma, activo) VALUES (?, ?, ?, ?, ?)";

        if ($stmt = $con->getConnection()->prepare($query)) {
            $activo = $_nuevo->getActivo() ? 1 : 0;
            $stmt->bind_param('ssssi', $_nuevo->getTipo(), $_nuevo->getLink(), $_nuevo->getTexto(), $_nuevo->getIdioma(), $activo);
            $stmt->execute();
            $stmt->close();
        }

        $con->closeConnection();
        return true;
    }
}
?>
