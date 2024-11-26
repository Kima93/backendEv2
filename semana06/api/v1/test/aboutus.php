<?php

class AboutUs
{
    
    public function getAll()
    {
        $lista = [];
        $con = new Conexion(); 

        
        $query = "SELECT id, titulo_esp, titulo_eng, descripcion_esp, descripcion_eng FROM aboutus";

     
        if ($stmt = $con->getConnection()->prepare($query)) {
            $stmt->execute();
            $result = $stmt->get_result();
            
            while ($registro = $result->fetch_assoc()) {
              
                $registro['activo'] = true;  
                
                $lista[] = $registro;
            }

            $stmt->close();
        }

        $con->closeConnection();
        return $lista;
    }
}
