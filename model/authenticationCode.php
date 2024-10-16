<?php 
/*Este modelo es capas de gestionar codigos de verificacion para los distintos tipos de usuarios
 */


class authenticationCode {
    /*atributos para manejar codigos de autenticacion*/
    public $id;
    public $email;
    public $code;
    public $hash;
    public $date;

    private $table = 'authenticationcode';
   
  

  public function __construct(){}
  
  /**crea codigos de verificacion unicos y los guarda en la BD */
  public function createAuthenticationCode($email,$conection){
    $this->email = $email;// id del usuario para ser utilizado como clave foranea
    $this->code = rand(100000,999999);// generacion del codigo de confirmacion
    $this->hash = md5(rand(0,10000));// generacion del token

    /**consulta que guarda los datos del codigo de autenticacion */
    $sql = "INSERT INTO ".$this->table. "(`id`,`email`,`code`,`hash`,`date` ) VALUES(NULL, ? , ? , ? , NOW() )";
    $stmt = $conection->prepare($sql); 
    $stmt->execute([$this->email, $this->code, $this->hash]);
    $id = $conection->lastInsertId();
    return $id;
  }
  /**consulta para extrar los datos de un codigo de verificacion segun su id */
  public function getAuthenticationCodeByIdANDEmail($email, $id , $conection){
    $sql = "SELECT * FROM " . $this->table . " WHERE id = ? AND email = ?" ;
    $stmt = $conection->prepare($sql);
    $stmt->execute([$id, $email]);
    return $stmt->fetch();
  }

  /**consulta para verificar si un codigo de verificacion existe */
  public function getAuthenticationCodeByEmailANDCodeANDHash($email, $code, $hash, $conection){
    $sql = "SELECT * FROM " . $this->table . " WHERE email = ? AND code = ? AND hash = ?" ;
    $stmt = $conection->prepare($sql);
    $stmt->execute([$email, $code, $hash]);
    return $stmt->rowCount() > 0;
  }

  /**consulta para validar que el codigo de verificacion no a caducado */
  public function dateVerification($email, $code, $hash, $conection){
    /**consulta de extra de la fecha del codigo*/
    $sql = "SELECT `date` FROM " . $this->table . " WHERE email = ? AND code = ? AND hash = ?";
    $stmt = $conection->prepare($sql);
    $stmt->execute([$email, $code, $hash]);
    $dateCode = $stmt->fetchColumn(); // Obtener la fecha del codigo para operar

    date_default_timezone_set('America/Caracas');// se establece la zona horaria
    $dateExpire = date("Y-m-d H:i:s"); // Formato de fecha // si no esta asi Y-m-d H:i:s no funciona
    $seconds = strtotime($dateExpire) - strtotime($dateCode);// determinado los segundos transcurridos
    $minutes = $seconds / 60;// convirtiendo a minutos
    return ($minutes < DEFAULT_DATE_CODE); // Retorna true si han pasado más de 10 minutos 
      }

}


?>


