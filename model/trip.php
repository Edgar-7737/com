<?php 
//--------------------------Modelo de las Rutas-----------------------///
    require_once("model/db.php");
        
    class trip{
       /*  se declaran las variables */
        public $idTrip;
        public $idRoute;
        public $idPackages;
        public $title;
        public $departureLocation;
        public $departureDate;
        public $departureTime;
        public $returnDate;
        public $returnTime;
        public $numberSlots;
        public $price;
        public $status;

        /* variable de la base de datos */
        public $table= 'trip';
        public $conection;

        
        public function getConection(){ /* se conecta con la base de datos */
            $DbObj= new Db;
            $this->conection = $DbObj->conection;
        }
         
        public function getTrip($status) {
            $this->getConection();
            $sql = "SELECT v.*, v.title AS titleTrip, 
                         GROUP_CONCAT(t.amount SEPARATOR '<br><br>') AS amount , t.id,
                       GROUP_CONCAT(p.title SEPARATOR '<br><br>') AS titlePackages, 
                       GROUP_CONCAT(t.idPackages SEPARATOR '<br><br>') ,
                       q.parroquia AS parroquiaName, r.place, m.municipio, e.estado,
                       COUNT(t.idTrip) AS tripCount
                FROM traveloffer t    
                INNER JOIN packages p ON t.idPackages = p.idPackages
                INNER JOIN trip v ON t.idTrip = v.idTrip
                INNER JOIN route r ON v.idRoute = r.idRoute
                INNER JOIN parroquia q ON r.idParroquia = q.id_p
                INNER JOIN municipio m ON q.municipio_id = m.id_m
                INNER JOIN estado e ON m.estado_id = e.id_e
                WHERE t.status = :status 
                GROUP BY v.idTrip";
            $stmt = $this->conection->prepare($sql);
            $stmt->bindParam(':status', $status, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll();
        }

        public function addingTrip($param){  /* añadir en BD la ruta de Viaje */
            $this->getConection();
            if(isset($param['idRoute'])) $this->idRoute = $param['idRoute'];  
            if(isset($param['idPackages'])) $this->idPackages = $param['idPackages'];  
            if(isset($param['title']))  $this->title = $param['title'];
            if(isset($param['departureLocation'])) $this->departureLocation = $param['departureLocation'];
            if(isset($param['departureDate'])) $this->departureDate = $param['departureDate'];
            if(isset($param['departureTime'])) $this->departureTime = $param['departureTime'];
            if(isset($param['returnDate'])) $this->returnDate = $param['returnDate'];
            if(isset($param['returnTime'])) $this->returnTime = $param['returnTime'];
            if(isset($param['numberSlots']))  $this->numberSlots = $param['numberSlots'];
            if(isset($param['price']))  $this->price = $param['price'];
            $this->status = true; 
            $band=TRUE;
            //$band = $this->consulta($param);//busqueda de parroquia Y lugar esta parte es para saber si ya esta insertada no se reincerte
            if($band){
                $sql = "INSERT INTO " . $this->table . 
                " (`idTrip`, `idRoute`, `title`, `departureLocation`, `departureDate`, `departureTime`, `returnDate`, `returnTime`, `numberSlots`, `price`) 
                VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $this->conection->prepare($sql);
                $stmt->execute([$this->idRoute, $this->title, $this->departureLocation, $this->departureDate, $this->departureTime, $this->returnDate, $this->returnTime, $this->numberSlots, $this->price]);
                $lastInsertId = $this->conection->lastInsertId(); 
                $this->addingTravelOffer($this->idPackages, $lastInsertId,$this->price, $this->status); 
                echo "------------------------------------GUARDADO CON EXITO----------------------------------";
            }else{
              echo "------------------------------------YA HAY UN REGISTRO IGUAL----------------------------------";
            } 
            return;
        }

        public function addingTravelOffer($param, $lastInsertId, $price, $status){
            if(count($param)>0){                   
                foreach($param as $data){ 
                    $packagePrice = $this->getPackagePrice($data);
                    $totalPrice = $price + $packagePrice;
                    $sql2 = "INSERT INTO traveloffer (`id`, `idTrip`, `idPackages`, `amount`, `status` ) 
                    VALUES (NULL, ?, ?, ?, ?)"; 
                    $stmt2 = $this->conection->prepare($sql2); 
                    $stmt2->execute([$lastInsertId, $data, $totalPrice, $status]);
                }
            }
        }
        public function getPackagePrice($idPackages) {
            $this->getConection();
            $sql = "SELECT price FROM packages WHERE idPackages = ?";
            $stmt = $this->conection->prepare($sql);
            $stmt->execute([$idPackages]);
            return $stmt->fetchColumn();
        }



        public function consulta($param){// Verificar si ya existe un registro con los mismos valores de place y location
            $this->getConection();
            if (isset($param['place'])) {$this->place = $param['place'];}
            if(isset($param['parroquia'])) $this->idParroquia = $param['parroquia'];

            $sqlCheck = "SELECT COUNT(*) FROM ".$this->table." WHERE place = ? AND idParroquia = ?";
            $stmtCheck = $this->conection->prepare($sqlCheck);
            $stmtCheck->execute([$this->place, $this->idParroquia]);
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
            
            $band = $this->consulta($param);// esta parte es para saber si hay un registro igual
            ECHO "---------------------------------------------------------------------".$band;
            if($band ===0 || $band ===1){ 
                $sql = "UPDATE ".$this->table. " SET idParroquia= ?, location = ? , place = ? , description = ?, image = ? WHERE idRoute = ?";
                $stmt = $this->conection->prepare($sql);
                $res = $stmt->execute([$this->idParroquia, $this->location, $this->place,  $this->description, $this->image, $this->idRoute  ]);
              
                echo "------------------------------------GUARDADO CON EXITO----------------------------------";
            }else if($band >=2 ){
                echo "------------------------------------YA HAY UN REGISTRO IGUAL----------------------------------";  
            }
            return;
        }

        public function getTripById($id) {
            $this->getConection();
            $sql = "SELECT v.*,r.*, q.parroquia , m.municipio, e.estado
                    FROM trip v
                    INNER JOIN route r ON v.idRoute = r.idRoute
                    INNER JOIN parroquia q ON r.idParroquia = q.id_p
                    INNER JOIN municipio m ON q.municipio_id = m.id_m
                    INNER JOIN estado e ON m.estado_id = e.id_e
                    WHERE v.idTrip = ?";
            $stmt = $this->conection->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->fetch();
        }
        
        public function statusTrip($id, $opc){   /*Modifica el Status en la BD*/ 
            $this->getConection();
            $opc==='true'? $opc='1': $opc='0'; 
            $this->status=$opc;
            $sql = "UPDATE traveloffer SET status = ?  WHERE idTrip = ?";
			$stmt = $this->conection->prepare($sql);
			$res = $stmt->execute([$this->status, $id ]);
        }

    }

?>