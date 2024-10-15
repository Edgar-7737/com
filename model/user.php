<?php 

/* Modelo de usuario */
  require ("model/db.php");
  require_once ("config/config.php");
  

  class user {

    /* Atributos de el usuario */
    public $idUser;
    public $name;
    public $lastname;
    public $phone;
    public $email;
    public $password;
    public $privilege;
    public $status;
    public $verified;
   
    /*Atributos de conexion con BD */
    private $table = 'user';
	  private $conection;

    /*Atributo para manejar el cambio de contraseña*/ 
    public $objAuCode;

    public function __construct() {
		
    }

    /*Conexion con DB */
    public function getConection(){
      $dbObj = new Db();
      $this->conection = $dbObj->conection;
    }

    /*Extraccion de usuarios de la DB */
    public function getUsersByPrivilege($userType, $status) {
      $this->getConection();
      $sql = "SELECT * FROM " . $this->table . " WHERE privilege = ? AND status = ? AND verified != 0";
      $stmt = $this->conection->prepare($sql);
      $stmt->execute([$userType, $status]);
      return $stmt->fetchAll();
  }

  public function getUserById($id,$query="NONE"){
      $this->getConection();      
      /*condicional para saber que tipo de consulta con respecto al id se quiere hacer */
      ($query === "COUNT") ? $sql = "SELECT COUNT(*) FROM " . $this->table . " WHERE idUser = ?" : $sql = "SELECT * FROM " . $this->table . " WHERE idUser = ?" ;
      $stmt = $this->conection->prepare($sql);
      $stmt->execute([$id]);
      /*segun la consulta retorna el valor adecuado para esta */
      return ($query === "COUNT")?  $stmt->fetchColumn() > 0 :  $stmt->fetch();
  }
    /*Extraccion de Usuarios Por el email de la DB y devuelve true o false */
    public function getUserByEmail($email,$query="NONE"){  
      $this->getConection();
      /*condicional para saber que tipo de consulta con respecto al email se quiere hacer */
      ($query === "COUNT") ? $sql = "SELECT COUNT(*) FROM " . $this->table . " WHERE email = ?" : $sql = "SELECT * FROM " . $this->table . " WHERE email = ?" ;
      $stmt = $this->conection->prepare($sql);
      $stmt->execute([$email]);
      /*segun la consulta retorna el valor adecuado para esta */
      return ($query === "COUNT")?  $stmt->fetchColumn() > 0 :  $stmt->fetch();
    }
    /* Insercion de nuevos Usuarios a la DB */
    public function insert($param,$privilege = 'turista'){

      $this->getConection();

      if(isset($param['name'])){
        $this->name = strtolower($param['name']);
        $this->name = ucfirst($this->name);
      } 
      if(isset($param['lastName'])){
        $this->lastname = strtolower($param['lastName']);
        $this->lastname = ucfirst($this->lastname);
      } 
      if(isset($param['phone'])){$this->phone = $param['phone'];} 
      if(isset($param['email'])) $this->email=$param['email'];
      if(isset($param['password'])){
        $this->password = $param['password'];
        $hash = password_hash($this->password, PASSWORD_BCRYPT, COST_PASSWORD );
      } 
      $this->privilege = $privilege;
      if($privilege === 'turista'){
        $this->status = "0";
        $this->verified = "0";
      }else{
        $this->status = "1";
        $this->verified = "1";
      }
      

      $sql = "INSERT INTO ".$this->table. "(`idUser`, `name`, `lastName`,`phone`, `email`, `password`, `privilege`, `status`, `verified`) VALUES(NULL, ? , ? , ? , ? , ? , ?, ?, ? )";
      $stmt = $this->conection->prepare($sql);
      $stmt->execute([$this->name,$this->lastname,$this->phone,$this->email,$hash,$this->privilege,$this->status,$this->verified]);
      $this->conection->lastInsertId();
    }

    public function editEmployee($param,$id){
      $this->getConection();
      
      if(isset($id)) $this->idUser = $id;

      if(isset($param['name'])){
        $this->name = strtolower($param['name']);
        $this->name = ucfirst($this->name);
      } 
      if(isset($param['lastName'])){
        $this->lastname = strtolower($param['lastName']);
        $this->lastname = ucfirst($this->lastname);
      } 
      if(isset($param['phone'])) $this->phone = $param['phone']; 
      if(isset($param['email'])) $this->email=$param['email'];

      
    
      $sql = "UPDATE ".$this->table. " SET name = ?, lastName = ?, phone = ?, email = ? WHERE idUser = ?";
      $stmt = $this->conection->prepare($sql);
      $stmt->execute([$this->name,$this->lastname,$this->phone,$this->email,$this->idUser]);
      return "edited_user";
    }


    public function statusControl($id,$opc){
      $this->getConection();
      if(isset($id)) $this->idUser = $id;
      if($opc === 'disable') {
          $this->status = "0";    
      }else if($opc === 'enable'){
          $this->status = "1";
      }
      
      $sql = "UPDATE ".$this->table. " SET status = ? WHERE idUser = ?";
      $stmt = $this->conection->prepare($sql);
      $stmt->execute([$this->status, $this->idUser ]);

  } 
  /////////////////////////////////////////////////////////////////////////////////
  /*verifica que el usuario alla verificado su cuenta */
  public function accountVerification($email,&$hash, $aux = 'none'){
    $param = $this->getUserByEmail($email);

    if($param['status'] === '1' && $param['verified'] === '1' ){
       return 'valid_verify';//retorna verifiaccion valida si esta verificado
    }else if($param['status'] === '0' && $param['verified'] === '0'){
      if($aux === 'not_send') return 'set_verify';
      return  ($this->sendEmailValidation($param,$hash,"none"));// si no esta verificado se envia un mensaje al correo del usuario para que pueda verificarse
    }else if($param['status'] === '0' && $param['verified'] === '1'){
      return 'user_ban';//indica que el usuario se encuentra baneado
    }else{
      return 'account_verification_error';//indica un error en la verificacion
    }
  }
  ///////////////////////////////////////////////////////////////////////////////////
  /*envia un mensaje de con un link el cual al acceder verifica que el correo es utilizado por alguien */
  public function sendEmailValidation($param,&$hash, $JS_json = 'send_json'){
    
    $auCode = $this->codeControl($param['email']);
    $hash = $auCode['hash'];// se guarda el valor del hash para operar en la vista 

    $message = $this->headMail();// se capta el estandar del head del mail
    $message .= "<body>
        <div class='container'>
            <div class='header'>Código de Verificación: </div>
            <div class='content'>
                <p>Intento de verificación de cuenta ".$auCode['date']."</p>
                <p>Hola! ".$param['name']." ".$param['lastName'].",</p>
                <p>Su código de verificación de un solo uso es:</p>
                <div class='code'>".$auCode['code']."</div>
                <p>Por favor, utilice este código para completar su proceso de verificación. Si no solicitó este código, por favor ignore este mensaje.</p>
            </div>
            <div class='footer'>
                <p>Por favor, no responda a este mensaje ya que es generado automáticamente por nuestro sistema.</p>
                <p>Atentamente:<br>El equipo de Bitacora Oriental</p>
            </div>
        </div>
    </body>
    </html>";

    $to      = $param['email']; // Enviar Email al usuario
    $subject = "Bitacora Oriental: Verificación de cuenta"; // Darle un asunto al correo electrónico
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: tuemail@ejemplo.com' . "\r\n"; 
    
              
    if (mail($to,$subject,$message,$headers)){//se envia el correo y se valida si se a enviado correctamente
      if($JS_json === "send_json"){
        $aux = $auCode['hash'];
        echo json_encode($aux, JSON_UNESCAPED_UNICODE);
        exit();
      } 
      return 'set_verify';//indica que se envio correctamente y genera un respuesta en la vista
    } else {
        return 'error_send_Verify';//inidica que no se envio correctamente el correo
    }

  }
  /*Activacion de cuenta del usuario */
  public function accountActivation($email){   
    $hash ="none";
    $aux =  $this->accountVerification($email,$hash,'not_send');
   if( $aux === 'set_verify'){
      $this->getConection();
      $this->email = $email;
      /*consulta para saber si el email y el hash enviados a traves del link coinciden con los de la DB */
      $sql = "SELECT email FROM " . $this->table . " WHERE email = ?";
      $stmt = $this->conection->prepare($sql);
      $stmt->execute([$this->email]);
      if($stmt->rowCount() > 0){//condicion para ver si coinciden los datos email y hash
        /*consulta para acivar la cuenta, Modifica los valores status y hash */
        $sql = "UPDATE " . $this->table . " SET status = ?, verified = ? WHERE email = ?";
        $stmt = $this->conection->prepare($sql);
        $stmt->execute(['1', '1', $this->email]);

        $param = $this->getUserByEmail($this->email);
      
        $message = $this->headMail();// se capta el estandar del head del mail
        $message .= "<body>
            <div class='container'>
                <div class='header'>Registro de cuenta realizado con exito!</div>
                <div class='content'>
                    <p>Hola! ".$param['name']." ".$param['lastName'].",</p>
                    <p>Gracias por registrarte en nuestro sitio Web Bitacora Oriental</p>
                    <p>Ingresa a nuestro sitio web y disfruta de las experiencias turisticas que Bitacora Oriental puede ofrecer</p>
                    <a href='http://localhost/MVC_11nuevo/index.php?controller=users&action=login' ><button class='button' >Iniciar Sesión</button></a> 
                    
                </div>
                <div class='footer'>
                    <p>Por favor, no responda a este mensaje ya que es generado automáticamente por nuestro sistema.</p>
                    <p>Atentamente:<br>El equipo de Bitacora Oriental</p>
                </div>
            </div>
        </body>
        </html>";
    
        $to      = $param['email']; // Enviar Email al usuario
        $subject = "Bitacora Oriental: Bienvenido!"; // Darle un asunto al correo electrónico
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: tuemail@ejemplo.com' . "\r\n"; 

        mail($to,$subject,$message,$headers);
        return "success_verifivation";
        }else{
          //echo '<br>Error de activacion de cuenta';//si no se logra activar debe retornar algun mensaje de error al usuario
          $aux = 'error_verifivation';
        }
    }
    return $aux; 
  }

  /**Envia un codigo de verificacion al correo del usuario */
  public function recoverPassword($param,&$email,&$hash, $JS_json = 'send_json'){
    $auCode = $this->codeControl($param['email']);
    $email = $param['email'];//se guarda el valor del email para operar en la vista
    $hash = $auCode['hash'];// se guarda el valor del hash para operar en la vista 

    $message = $this->headMail();// se capta el estandar del head del mail
    $message .= "<body>
        <div class='container'>
            <div class='header'>Código de Verificación: </div>
            <div class='content'>
                <p>Intento de recuperacion de contraseña ".$auCode['date']."</p>
                <p>Estimado ".$param['name']." ".$param['lastName'].",</p>
                <p>Su código de verificación de un solo uso es:</p>
                <div class='code'>".$auCode['code']."</div>
                <p>Por favor, utilice este código para completar su proceso de verificación. Si no solicitó este código, por favor ignore este mensaje.</p>
            </div>
            <div class='footer'>
                <p>Por favor, no responda a este mensaje ya que es generado automáticamente por nuestro sistema.</p>
                <p>Atentamente,<br>El equipo de Bitacora Oriental</p>
            </div>
        </div>
    </body>
    </html>";

    $to      = $param['email']; // Enviar Email al usuario
    $subject = "Bitacora Oriental: ¿Olvidaste tu contraseña?"; // Darle un asunto al correo electrónico
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: tuemail@ejemplo.com' . "\r\n"; 
    
    if (mail($to,$subject,$message,$headers)){//se envia el correo y se valida si se a enviado correctamente
      if($JS_json === "send_json"){
        $aux = $auCode['hash'];
        echo json_encode($aux, JSON_UNESCAPED_UNICODE);
        exit();
      } 
     
      return 'mail_send';//indica que se envio correctamente y genera un respuesta en la vista
    }else{
      if($JS_json === "send_json"){
        $aux = "error_send";
        echo json_encode($aux, JSON_UNESCAPED_UNICODE);
        exit();
      } 
        return 'error_send';//inidica que no se envio correctamente el correo
    } 

  }

  /**establece la comunicacion entre el modelo de authenticationCode y user, y a su vez crea
   y extrea de la base de datos un codigo de verificacion para validar al usuario*/
  public function codeControl($email){
    require_once ('model/authenticationCode.php');// se requiere al modelo de authenticationCode
    $this->getConection();// la conexion se realiza en el modelo de user
    $this->objAuCode = new authenticationCode;//instancia de la clase de authenticationCode    
    $id = $this->objAuCode->createAuthenticationCode($email,$this->conection);//crea y retorna el id del codigo creado
    return $this->objAuCode->getAuthenticationCodeByIdANDEmail($email,$id,$this->conection);// extrae los datos del codigo y los retorna
  }

  /**valida el codigo que el usuario esta ingresando*/
  public function codeValidation($email, $code, $hash){
    require_once ('model/authenticationCode.php');// se requiere al modelo de authenticationCode
    $this->getConection();// la conexion se realiza en el modelo de user
    $AuCode = new authenticationCode;//instancia de la clase de authenticationCode    
    /*se comprueba que el codigo de verificacion exista */
    if($AuCode->getAuthenticationCodeByEmailANDCodeANDHash($email, $code, $hash, $this->conection)){
      if($AuCode->dateVerification($email, $code, $hash, $this->conection)){// se comprueba que el codigo de verificacion no alla expirado
        return "valid_code";
      }else{
        return 'date_expire';// retorna una respuesta que indica que el codigo caduco
      }
    }else{ 
      return 'code_invalid';//retorna una respuesta que indica que el codigo ingresado no existe
    }
  }

  /*consulta para el cambio de contraseña */
  public function changePassword($email, $password){
    $this->getConection();
    /**extrae el hash vinculado al usuario de la base de datos*/
    $sql = "SELECT `password` FROM " . $this->table . " WHERE email = ? ";
    $stmt = $this->conection->prepare($sql);
    $stmt->execute([$email]);
    $hash = $stmt->fetchColumn(); // Obtener el valor de la columna directamente
    /*comprueba que la la nueva contraseña no se igual a la vieja */
    if(password_verify($password, $hash)){
      return 'same_passwords';// retorna una respuesta que indica que las contraseñas son iguales
    }else{// si no son siguales se procede a modificar el password del usuario en la DB
      $hash = password_hash($password, PASSWORD_BCRYPT, COST_PASSWORD );
      $sql = "UPDATE " . $this->table . " SET password = ? WHERE email = ?";
      $stmt = $this->conection->prepare($sql);
      $stmt->execute([$hash,$email]);
      
      $param = $this->getUserByEmail($email);
      
      $message = $this->headMail(); // se capta el estandar del head del mail
      $message .= "<body>
            <div class='container'>
                <div class='header'>Contraseña actualizada!</div>
                <div class='content'>
                    <p>Hola! ".$param['name']." ".$param['lastName'].",</p>
                    <p>Su cambio de contraseña fue realizado correctamente</p>
                    <p>Esperomos que pueda seguir disfrutando de las experiencias turisticas que Bitacora Oriental puede ofrecer</p>
                    <a href='http://localhost/MVC_11nuevo/index.php?controller=users&action=login' ><button class='button' >Iniciar Sesión</button></a> 
                </div>
                <div class='footer'>
                    <p>Por favor, no responda a este mensaje ya que es generado automáticamente por nuestro sistema.</p>
                    <p>Atentamente:<br>El equipo de Bitacora Oriental</p>
                </div>
            </div>
        </body>
        </html>";
    
        $to      = $param['email']; // Enviar Email al usuario
        $subject = "Bitacora Oriental: Contraseña Actualizada"; // Darle un asunto al correo electrónico
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: tuemail@ejemplo.com' . "\r\n"; 
      mail($to,$subject,$message,$headers);
      return 'password_found';// retorna una respuesta que indica que el cambio de contraseña se echo correctamente
  
    }

  }
  /*Funcion para estandarizar el estilo de las mails */
  public function headMail(){//return el head de un html con css para crear el mail
    return "<!DOCTYPE html>
  <html lang='es'>
  <head>
      <meta charset='uft8_spanish2_ci'>
      <style>
          body { font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px; display: flex; justify-content: center; align-items: center; height: 100vh; }
          .container { background-color: #ffffff; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); max-width: 600px; width: 100%; }
          .header { font-size: 24px; color: #333333; text-align: center; }
          .content { margin-top: 20px; color: #555555; }
          .content p { font-size: 16px; }
          .code { font-size: 20px; color: #000000; font-weight: bold; text-align: center; margin: 20px 0; }
          .button { display: block; width: 180px; margin: 20px auto; padding: 10px; background-color: #2dbd2d; color: #ffffff ; text-align: center; text-decoration: none; border-radius: 7px; }
          .footer { margin-top: 20px; font-size: 12px; color: #999999; text-align: center; }
      </style>
  </head>";
    }


  }//////////////////////////////////////////////////////////////////////////////////////
?>