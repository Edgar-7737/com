<?php

/*  modelo del modulo publicaciones especiales */

  require_once("model/db.php");

    class pubEspecial{
      public $idPubSpecial;
      public $title;
      public $description;
      public $image;
      public $status;

   
      /*Atrubutos para la conexion con BD */
      public $table = 'PubSpecials';
      public $conection;

      public function __construct(){
            
      }

      /*conexion con DB */
      public function getConection(){
        $DbObj= new Db;
        $this->conection = $DbObj->conection;
      }

      public function getPubEspecialByStatus($opc) {
        $this->getConection();
        if(!isset($opc)) return false; 
        $sql = "SELECT * FROM " . $this->table . " WHERE status = ?";
        $stmt = $this->conection->prepare($sql);

        /* condicional para saber que contenido extraer */
        if ($opc === 'enable') {
            $stmt->execute(["1"]);
        } elseif ($opc === 'disable') {
            $stmt->execute(["0"]);
        } 
    
        return $stmt->fetchAll();
    }
        
  
      /*Extraccion de publicaciones especiales de la DB */

      public function getpubEspecialById($id){
        if(is_null($id)) return false;
        $this->getConection();
        $sql = "SELECT * FROM ".$this->table. " WHERE idPubSpecial = ?";
        $stmt = $this->conection->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetch();
      } 

      /*Insertar nuevas publicaciones especiales a  la DB */
        
      public function insertPubEspecial($param) {
        $this->getConection();
    
        if (isset($param['title'])) $this->title = $param['title'];
        if (isset($param['description'])) $this->description = $param['description'];
        $this->status = true;
    
        if (isset($param['image'])) {
            // *******Obtener la extensión del archivo***********
            $extension = pathinfo($param['image']['name'], PATHINFO_EXTENSION);
            
            // ********Crear un nombre único para la imagen********
            $nombreImagen = uniqid('pub_', true) . '.' . $extension; // Ejemplo: pub_605c1f2a1a2b3.png
            $rutaImagen = 'asset/imgpubspecial/' . $nombreImagen;
    
            if (move_uploaded_file($param['image']['tmp_name'], $rutaImagen)) {
                $this->image = $rutaImagen;
    
                $sql = "INSERT INTO pubSpecials (`idPubSpecial`, `title`, `description`, `image`, `status`) VALUES(NULL, ?, ?, ?, ?)";
                $stmt = $this->conection->prepare($sql);
                try {
                    $stmt->execute([$this->title, $this->description, $this->image, $this->status]);
                    return $this->conection->lastInsertId();
                } catch (PDOException $e) {
                    echo "Error al insertar la publicación: " . $e->getMessage();
                    return false;
                }
            } else {
                echo "Error al subir la imagen.";
                return false;
            }
        } else {
            echo "No se ha seleccionado un archivo de imagen.";
            return false;
        }
    }
    

    /*edita las publicaciones especiales de la DB */
    public function editPubEspecial($param, $id) {
        try {
            $this->getConection();
    
            if (isset($id)) $this->idPubSpecial = $id;
            if (isset($param['title'])) $this->title = $param['title'];
            if (isset($param['description'])) $this->description = $param['description'];
        
            if (isset($param['image']) && $param['image']['error'] === UPLOAD_ERR_OK) {
                $nombreImagen = basename($param['image']['name']);
                $rutaImagen = 'asset/imgpubspecial/' . $nombreImagen;
    
                if (move_uploaded_file($param['image']['tmp_name'], $rutaImagen)) {
                    $this->image = $rutaImagen;
                } else {
                    echo "Error al subir la imagen.";
                    return false;
                }
            }
    
            $sql = "UPDATE pubSpecials SET ";
            $values = [];
    
            if (isset($this->title)) {
                $sql .= "title = ?";
                $values[] = $this->title;
            }
    
            if (isset($this->description)) {
                if (count($values) > 0) $sql .= ", ";
                $sql .= "description = ?";
                $values[] = $this->description;
            }
    
            if (isset($this->image)) {
                if (count($values) > 0) $sql .= ", ";
                $sql .= "image = ?";
                $values[] = $this->image;
            }
    
            $sql .= " WHERE idPubSpecial = ?";
            $values[] = $this->idPubSpecial;
    
            $stmt = $this->conection->prepare($sql);
            $resultado = $stmt->execute($values);
    
            if ($resultado) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Error al actualizar la publicación: " . $e->getMessage();
            return false;
        } catch (Exception $e) {
            echo "Error inesperado: " . $e->getMessage();
            return false;
        }
    }

    public function statusControl($id,$opc){

        $this->getConection();

        if(isset($id)) $this->idPubSpecial = $id;

        if($opc === 'disable'){
            $this->status = "0";    
        }else if($opc === 'enable'){
            $this->status = "1";
        }
        
        $sql = "UPDATE ".$this->table. " SET status = ? WHERE idPubSpecial = ?";
        $stmt = $this->conection->prepare($sql);
        $res = $stmt->execute([$this->status, $this->idPubSpecial]);

    }
    
  
      

}

?>