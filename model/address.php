<?php
$address= new address();
///////////////////////////////////
class address{
    /*  se declaran las variables */
    public $conection;

    public function getConection(){ /* se conecta con la base de datos */
         $DbObj= new Db;
         $this->conection = $DbObj->conection;
    }

    public function getDependence($aux){ //busca los estados municipios y parroquias a partir de un id de la parroquia
        $this->getConection();

            $sql = " SELECT p.parroquia 'parroquia', m.municipio 'municipio',  e.estado 'estado'
            FROM parroquia p 
                INNER JOIN municipio m ON  p.municipio_id = m.id_m
                INNER JOIN estado e ON m.estado_id = e.id_e
            WHERE p.id_p = $aux ";

            $stmt = $this->conection->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
    }

    public function addressEdo(){
        $this->getConection();
        $sql = "SELECT id_e, estado FROM estado";
        $stmt = $this->conection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);  
      
    }
} 
if(isset($_POST['id_e'])){
    
    $conn = new PDO('mysql:host=localhost;dbname=bitacora_oriental2', 'root', '');
    $sql= "SELECT id_m, municipio FROM municipio WHERE estado_id = {$_POST['id_e']}  ORDER BY municipio ASC ";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $respuesta = "<option value=''>Seleccionar</option>";
            if (count($result) > 0) {
                foreach ($result as $row) {
                        $respuesta .= "<option value='".$row['id_m']. "'>".$row['municipio']."</option>"  ;
                    }
                }
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}
        
if(isset($_POST['id_m'])){
    $conn = new PDO('mysql:host=localhost;dbname=bitacora_oriental2', 'root', '');
    $sql= "SELECT id_p, parroquia FROM parroquia WHERE municipio_id = {$_POST['id_m']} ORDER BY parroquia ASC ";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $respuesta = "<option value=''>Seleccionar</option>";
            if (count($result) > 0) {
                foreach ($result as $row) {
                        $respuesta .= "<option value='".$row['id_p']. "'>".$row['parroquia']."</option>"  ;
                    }
                }
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}








?>

