<?php 

  require_once("model/db.php");

  class faq{
    /*Atributos de la clase preguntas frecuentes*/
    public $idFaq;
    public $query;
    public $respond;
    public $status;

    /*Atrubutos para la conexion con BD */
    public $table = 'faq';
    public $conection;

    /*conexion con DB siendo asignada en la variable conection para ser manipulada desde alli */
    public function getConection(){
      $DbObj= new Db;
      $this->conection = $DbObj->conection;
    }
    /*Consulta para saber si se repite fue para los faq */
  public function consulta($param, $id = null) {
    $this->getConection();
    if (isset($param['query'])) {$this->query = $param['query'];}
    if (isset($param['respond'])) {$this->respond = $param['respond'];}

    $sqlCheck = "SELECT COUNT(*) FROM " . $this->table . " WHERE query = ? AND respond = ?";
    if ($id !== null) {
        $sqlCheck .= " AND id_preg_frecuente != ?";
    }
    $stmtCheck = $this->conection->prepare($sqlCheck);
    if ($id !== null) {
        $stmtCheck->execute([$this->query, $this->respond, $id]);
    } else {
        $stmtCheck->execute([$this->query, $this->respond]);
    }
    return $stmtCheck->fetchColumn();
}

    /*Extraccion de todas las preguntas frecuentes de
     la tabla en la DB */
    public function getFaq(){
      $this->getConection();
      $sql = "SELECT * FROM " .$this->table. " WHERE status != 0";
      $stmt = $this->conection->prepare($sql);
      $stmt->execute();

      return $stmt->fetchAll(PDO::FETCH_OBJ);
      
    }

/* insercion de registro */
  public function insertFaq($param){
            
    $this->getConection();
    /* comprobacion y asignacion de las variables globales para simplificar su manipulacion */
    if(isset($param['query'])) {
      $this->query = limpiar_cadena($_POST['query']); 
    }
    if(isset($param['respond'])){ 
      $this->respond = limpiar_cadena($_POST['respond']);
    } 
      $this->status = true;
      /* guardado de la consulta correspondiente a realizar */
      $band = $this->consulta($param);//busqueda de parroquia Y lugar esta parte es para saber si ya esta insertada no se reincerte
      if($band===0){
      $sql = "INSERT INTO " . $this->table . "(`query`, `respond` , `status`) VALUES( ?, ? , ?)";
      /* preparado y ejecucion de la consulta */
      $stmt = $this->conection->prepare($sql);
      $stmt->execute([$this->query, $this->respond,$this->status]);
      $id = $this->conection->lastInsertId();
      echo "------------------------------------GUARDADO CON EXITO----------------------------------";
    }else{
      echo "------------------------------------YA HAY UN REGISTRO IGUAL----------------------------------";
    } 
  }

  /* busqueda de registro por id */
  public function getFaqById($id){
    if(is_null($id)) return false;
    $this->getConection();
    /* guardado de la consulta correspondiente a realizar */
    $sql = "SELECT * FROM ".$this->table. " WHERE id_preg_frecuente = ?";
    $stmt = $this->conection->prepare($sql);/* preparado y ejecucion de la consulta */
    $stmt->execute([$id]); 
    return $stmt->fetch(PDO::FETCH_OBJ);/* envio del registro encontrado */
  }


  /* guardado de registro */
  public function saveFaq($param){
    $this->getConection();
    /* verificar existencia */
    /* reasignacion de valores */
    if(isset($param["id"])) $idFaq = limpiar_cadena($param["id"]);
    if(isset($param["query"])) $query = limpiar_cadena($param["query"]);
    if(isset($param["respond"])) $respond = limpiar_cadena($param["respond"]);
    $this->status = true;
    /* operacion en la base de datos */

    $aux = $this->getFaqById($idFaq);
    $band = $this->consulta($param, $idFaq); // esta parte es para saber si hay un registro igual

    if ($band === 0 || (isset($aux) && $aux->id_preg_frecuente === $idFaq)) {
        $sql = "UPDATE ".$this->table. " SET query=?, respond=?, status=? WHERE id_preg_frecuente=?";
        $stmt = $this->conection->prepare($sql);
        $res = $stmt->execute([$query, $respond, $this->status, $idFaq]);
        echo "----------------------------------GUARDADO CON EXITO-----------------------------";
    } else {
        echo "------------------------------YA EXISTE UN REGISTRO IGUAL--------------------------";
    }
}

  public function statusControl($id,$opc){

    $this->getConection();

    if(isset($id)){
     
      if($opc === 'disable'){
          $this->status = "0";    
      }else if($opc === 'enable'){
          $this->status = "1";
      }
    
    } 
    
    $sql = "UPDATE " .$this->table. " SET status = ? WHERE id_preg_frecuente = ?";
    $stmt = $this->conection->prepare($sql);
    $res = $stmt->execute([$this->status, $id ]);

  }


  /*Extraccion de paquetes de la DB segun su estatus */
  public function getFaqByStatus($opc) {
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

    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
}

