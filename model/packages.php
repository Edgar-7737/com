<?php
   
/*  modelo del modulo paquete     */

    require_once("model/db.php");

    class packages{

        /*Atributos de la clase paquetes  */
        public $idPackages;
        public $title;
        public $description;
        public $transport;
        public $food;
        public $lodging;
        public $price;
        public $status;

        /*Atributos para la conexion con BD */
        public $table= 'packages';
        public $conection;

        public function __construct(){
            
        }

        /*conexion con DB */
        public function getConection(){
            $DbObj= new Db;
            $this->conection = $DbObj->conection;
        }

        public function countPendingReservations(){
            $this->getConection();
            $sql = "SELECT COUNT(*) FROM " . $this->table . " WHERE status = ?";
            $stmt = $this->conection->prepare($sql);
            $stmt->execute(['0']);
            return $stmt->fetchColumn() > 0;
        }
        
        /*Extraccion de paquetes de la DB segun su estatus */
        public function getPackagesByStatus($opc) {
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

        /*Extraccion  de paquetes por ID de la BD */
        public function getPackagesById($id){
            if(is_null($id)) return false;
            $this->getConection();
            $sql = "SELECT * FROM ".$this->table. " WHERE idPackages = ?";
            $stmt = $this->conection->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->fetch();
        }

        public function getPackagesBydata($title, $description, $transport, $food, $lodging, $price){
            $this->getConection();
            $sql = "SELECT COUNT(*) FROM " .$this->table. " WHERE title = ? AND description = ? AND transport = ? AND food = ? AND lodging = ? AND price = ?";
            $stmt = $this->conection->prepare($sql);
            $stmt->execute([$title, $description, $transport, $food, $lodging, $price]);
            return $stmt->fetchColumn() > 0;
        }

        /*Insertar nuevos paquetes a  la DB */
        public function insertPackages($param){
            
            $this->getConection();

            if(isset($param['title'])) {
                $this->title = strtolower($param['title']);
                $this->title = ucfirst($this->title);
            }
            if(isset($param['description'])){
                $this->description = strtolower($param['description']);
                $this->description = ucfirst($this->description);
            }
            if(isset($param['transport']))  $this->transport = $param['transport'];
            if(isset($param['food']))   $this->food = $param['food'];
           
            if(isset($param['lodging'])) $this->lodging = $param['lodging'];
            if(isset($param['price']))  $this->price = floatval($param['price']);
            $this->status = true ;

            if(!$this->getPackagesBydata($this->title,$this->description,$this->transport,$this->food,$this->lodging,$this->price)){
                $sql = "INSERT INTO ".$this->table. "(`idPackages`, `title`, `description`, `transport`, `food`, `lodging`, `price`, `status`) VALUES(NULL, ? , ? , ? , ? , ? , ? , ? )";
                $stmt = $this->conection->prepare($sql);
                $stmt->execute([$this->title,$this->description,$this->transport,$this->food,$this->lodging,$this->price,$this->status]);
                $this->conection->lastInsertId();
                return "save";
            }else{
                return "duplicate";
            }
        }
        /*Edicion de Paquetes de viaje en la DB */
        public function editPackages($param,$id){
            $this->getConection();
            
            if(isset($id)) $this->idPackages = $id;
            if(isset($param['title'])){
                $this->title = strtolower($param['title']);
                $this->title = ucfirst($this->title);
            }
            if(isset($param['description'])){
                $this->description = strtolower($param['description']);
                $this->description = ucfirst($this->description);
            }
            if(isset($param['transport']))  $this->transport = $param['transport'];
            if(isset($param['food']))   $this->food = $param['food'];
            if(isset($param['lodging'])) $this->lodging = $param['lodging'];
            if(isset($param['price'])){
                $this->price = str_replace(',', '.', $param['price']);
                $this->price = floatval($this->price);//salida con el la DB se guarden con los numerso flotantes solo con punto;
            }
            $aux = $this->getPackagesById($id);
            $band = $this->getPackagesBydata($this->title,$this->description,$this->transport,$this->food,$this->lodging,$this->price);// esta parte es para saber si hay un registro igual
            if ($band === FALSE || (isset($aux) && $aux['idPackages'] === $id)) {
                $sql = "UPDATE ".$this->table. " SET title = ? ,description = ? ,transport = ? ,food = ? ,lodging = ? ,price = ? WHERE idPackages = ?";
                $stmt = $this->conection->prepare($sql);
                $stmt->execute([$this->title, $this->description, $this->transport, $this->food, $this->lodging, $this->price, $this->idPackages   ]);
                return "update" ;
            }else{
                return "duplicate_edition";
            }
        }
    
        public function statusControl($id,$opc){

            $this->getConection();

            if(isset($id)) $this->idPackages = $id;

            if($opc === 'disable'){
                $this->status = "0";    
            }else if($opc === 'enable'){
                $this->status = "1";
            }
            
            $sql = "UPDATE ".$this->table. " SET status = ? WHERE idPackages = ?";
			$stmt = $this->conection->prepare($sql);
			$res = $stmt->execute([$this->status, $this->idPackages ]);

            return 'disabled_not_allowed';

        }


    }

?>