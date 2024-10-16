<?php 
//--------------------------Modelo de las Rutas-----------------------///
    require_once("model/db.php");
        
    class route{
       /*  se declaran las variables */
        public $idRoute;
        public $idParroquia;
        public $location;
        public $place  ;
        public $description;
        public $image;
        public $status;
        /* variable de la base de datos */
        public $table= 'route';
        public $conection;

        
        public function getConection(){ /* se conecta con la base de datos */
            $DbObj= new Db;
            $this->conection = $DbObj->conection;
        }
        
        public function getRoutesByStatus($status) {
            $this->getConection();
            $sql = "SELECT r.*, p.parroquia, m.municipio, e.estado
            FROM $this->table r
                INNER JOIN parroquia p ON r.idParroquia = p.id_p
                INNER JOIN municipio m ON p.municipio_id = m.id_m
                INNER JOIN estado e ON m.estado_id = e.id_e
            WHERE r.status = :status";
            $stmt = $this->conection->prepare($sql);
            $stmt->bindParam(':status', $status, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll();
        }
        
        public function addingRoute($param,$image){  /* añadir en BD la ruta de Viaje */
            $this->getConection();
            if(isset($param['parroquia'])) $this->idParroquia = $param['parroquia']; 
            if(isset($param['location'])) $this->location = $param['location'];
            if(isset($param['place'])) $this->place = $param['place'];
            if(isset($param['description']))  $this->description = $param['description'];
            $this->status = true; 
            if (isset($image)) {
                $routeImage = 'asset/img/' . basename($image['name']); 
                if(move_uploaded_file($image['tmp_name'], $routeImage)){
                     $this->image = $routeImage;
                }else {
                    throw new Exception("Error al insertar la imagen");
                }
            } 
            $band = $this->consulta($param);//busqueda de parroquia Y lugar esta parte es para saber si ya esta insertada no se reincerte
            if($band===0){
                $sql = "INSERT INTO " . $this->table . " (`idRoute`, `idParroquia`, `location`, `place`, `description`, `image`, `status`) VALUES (NULL, ?, ?, ?, ?, ?, ?)";
                $stmt = $this->conection->prepare($sql);
                $stmt->execute([$this->idParroquia, $this->location, $this->place, $this->description, $this->image, $this->status]);
                echo "------------------------------------GUARDADO CON EXITO----------------------------------";
            }else{
              echo "------------------------------------YA HAY UN REGISTRO IGUAL----------------------------------";
            } return;
        }

        public function consulta($param, $id = null) {
            $this->getConection();
            if (isset($param['place'])) {$this->place = $param['place'];}
            if (isset($param['parroquia'])) {$this->idParroquia = $param['parroquia'];}
        
            $sqlCheck = "SELECT COUNT(*) FROM " . $this->table . " WHERE place = ? AND idParroquia = ?";
            if ($id !== null) {
                $sqlCheck .= " AND idRoute != ?";
            }
        
            $stmtCheck = $this->conection->prepare($sqlCheck);
            if ($id !== null) {
                $stmtCheck->execute([$this->place, $this->idParroquia, $id]);
            } else {
                $stmtCheck->execute([$this->place, $this->idParroquia]);
            }
            return $stmtCheck->fetchColumn();
        }

        public function AboutWriting($param, $file ,$id){    /*Sobre escribe Informacion en el ID  en la BD*/ 
            $this->getConection();
            
            if(isset($id)) $this->idRoute = $id;
            if(isset($param['parroquia'])) $this->idParroquia = $_POST['parroquia'];
            if(isset($param['place'])) $this->place = $_POST['place'];
            if(isset($param['location'])) $this->location = $_POST['location'];
            if(isset($param['description']))$this->description = $_POST['description'];
           
            if(empty($files) ) {
                $routeImage = 'asset/img/' . basename($file['name']); 
                if(move_uploaded_file($file['tmp_name'], $routeImage)){
                     $this->image = $routeImage;
                }else $this->image = $param['backup'];
            }
            $aux = $this->getRouteById($id);
            $band = $this->consulta($param, $this->idRoute); // esta parte es para saber si hay un registro igual

            if ($band === 0 || (isset($aux) && $aux['idRoute'] === $id)) {
                $sql = "UPDATE " . $this->table . " SET idParroquia = ?, location = ?, place = ?, description = ?, image = ? WHERE idRoute = ?";
                $stmt = $this->conection->prepare($sql);
                $res = $stmt->execute([$this->idParroquia, $this->location, $this->place, $this->description, $this->image, $this->idRoute]);
                echo "----------------------------------GUARDADO CON EXITO-----------------------------";
            } else {
                echo "------------------------------YA EXISTE UN REGISTRO IGUAL--------------------------";
            }
        }


        public function getRouteById($id){  /* Busca por ID  en la BD*/
            $this->getConection();
            $sql = "SELECT * FROM ".$this->table. " WHERE idRoute = ?";
            $stmt = $this->conection->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->fetch(); 
        }

        public function statusRoute($id, $opc){   /*Modifica el Status en la BD*/ 
            $this->getConection();
            $this->idRoute=$id;
            $opc==='true'? $opc='1': $opc='0'; 
            $this->status=$opc;
            $sql = "UPDATE ".$this->table. " SET status = ?  WHERE idRoute = ?";
			$stmt = $this->conection->prepare($sql);
			$res = $stmt->execute([$this->status, $this->idRoute ]);
        }

    }

?>