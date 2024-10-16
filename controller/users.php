<?php 
require_once("model/user.php");
require_once ("model/userSession.php");

  class usersController{

    public $view;
    public $objUser;
    public $objUserSession; 

    public function __construct(){
      $this->view = 'user\listUser';
      $this->objUser = new user;
      $_GET['response'] = "false";
      $this->objUserSession = new userSession;
      $this->objUserSession->sessionAccessAdmin();//para denegar el accesp a los usurios no admins
    }

    public function list(){
      return $this->objUser->getUsersByPrivilege($_GET['userType'],$_GET['status']);
      
    }

    public function register(){
      //resgitringe el acesso a los usuarios si iniciaron sesion o si hay una sesion activa inseperada      
      $this->objUserSession->activeSessionValidation();
      $this->view='user\register';
      if(isset($_POST['send'])){
        /*comprueba si el email exite si es asi devuelve true en caso contrario false */
        if($this->objUser->getUserByEmail($_POST['email'],"COUNT")){//COUNT indica el tipo de consulta
          $_GET['response'] = "registered_mail";//da una respuesta en la vista, indica si el correo ya fue registrado
        }else{
          $this->objUser->insert($_POST);//insersion de las datos en la DB
          
          $_POST['action'] = "validation";
          $_GET['email'] = $_POST['email']; 
          $this->view='user\codeIntroduction';
          $_GET['response'] = $this->objUser->accountVerification($_POST['email'], $_POST['hash']); //verificador de correo electronico
        }
      }
    }

    /*Inicio de sesion del usuario */
    public function login(){
      $this->view='user\login';
      
      $this->objUserSession->activeSessionValidation();

      /*se comprueba que se quiera pasar datos */
      if(isset($_POST['send'])){
        /*se extraen los datos de la BD para comparar */
        $param = $this->objUser->getUserByEmail($_POST['email']);
        /*Comprobacion de los datos del formulario con la base de datos*/
        if($param !== false && password_verify($_POST['password'], $param['password'])){
          $_GET['email'] = $param['email']; 
          $aux = $this->objUser->accountVerification($param['email'],$_POST['hash']);
          if($aux === 'valid_verify' ){
            // session_set_cookie_params(0);
            $this->objUserSession= new userSession;//-------Se inicia la sesion a travez de la instanciacion del objeto
            $this->objUserSession->setCurrentUser($param);//-Se inicializan los datos de la SESSION
            $this->objUserSession->timeSession();
            $_GET['response'] = 'true' ;

            /*Se seleciona la vista segun el privilegio*/
            $this->view = ($param['privilege'] === 'turista')? 'home/home' : $this->view = "dashboard/dashboard"; return $this->redirectingToDashboard();
            
            /**En caso de que el usuario necesite verificarse */
          }else if($aux === "set_verify" || $aux === "error_send_Verify"){
            $_POST['email'] = $param['email']; 
            $_POST['action'] = "validation";
            $this->view='user\codeIntroduction';
          }
          $_GET['response'] = $aux ;
        }else{
          $_GET['response'] = "incorrect_email_pass" ; //----si no se inicia se devuelve false a travez de la variable $_GET
        }
      }
    }

   /*Registro de usuarios publicistas */
    public function registerPublicist(){
      
      $this->view='user\register';
      $_GET['userType']='publicist';//indica el tipo de usuario que se esta registrando
      
      if(isset($_POST['send'])){  
        if($this->objUser->getUserByEmail($_POST['email'],"COUNT")){//se verifica que el correo ingresado no este registrado
          $_GET['response'] = "registered_mail";
        }else{
          $this->objUser->insert($_POST,'publicista');//insersion de las datos en la DB
          $_GET['response'] = 'user_insert';
        }
      }
    }

    /*Cambia el status de la cuenta */
    public function status(){
      
      $this->view = 'user\listUser';
      if(isset($_GET['id'])){
          /*$_GET['opc'] es una variable que controla que opcion e una condicional se va a realizar */
          $this->objUser->statusControl($_GET['id'],$_GET['opc']);
      }
      return $this->objUser->getUsersByPrivilege($_GET['userType'],$_GET['status']);   
  }

  ///////////////////////////////////////////////////////////////////////////////////////
  /*LLama al modelo para enviar un correo electronico de verificacion */
  /* public function sendEmail(){
    $hash = "none";
    $_GET['response'] = $this->objUser->accountVerification($_GET['email'],$hash);

    if(isset($_GET['view']) && $_GET['view'] === 'register'){
      $this->view='user\register';
    }else if(isset($_GET['view']) && $_GET['view'] === 'userValidation'){
      $this->view = 'user\userValidation'; 
    }else{
      $this->view='user\login';
    }
    
  } */
  /*Funcion para activar la cuenta de usuarios*/
 /*  public function activation(){
    $this->view = "user/userValidation" ;
    if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
      $_GET['response'] = $this->objUser->accountActivation($_GET['email'],$_GET['hash']);
      $_GET['email'] = $_GET['email'];
    }
  } */
///////////////////////////////////////////////////////////////////////////////////////

  /*permite manejar comprobar el email ingresado para la recuperacion y enviar el mail con el codigo de verificacion */
  public function emailForRecover(){
    
    $this->objUserSession->activeSessionValidation();

    $this->view = 'user/recoverEmail';
      if(isset($_POST['send'])){
        $param = $this->objUser->getUserByEmail($_POST['email']);//se comprueba que el correo ingresado existe
        if($param !== false ){//si existe se cambia la vista y se envia el mail
          $hash="none";//
          $aux = $this->objUser->accountVerification($_POST['email'], $hash ,'not_send');
          if( $aux === 'valid_verify' ){
            $_GET['email'] = $_POST['email'];
            $_POST['action'] = "recover";
            $_GET['response'] = $this->objUser->recoverPassword($param, $_POST['email'], $_POST['hash'],"no_send_json");//envio de mail
            $this->view = "user/codeIntroduction";//cambio de la vista 
          }else{// en caso de que no este verificado e intente cambiar de contraseña
            if($aux === 'set_verify'){
              $_GET['response'] = "account_verification";
              $_GET['email'] = $_POST['email'];
            }else{
              $_GET['response'] = $aux ;  
            }
          }
        }else{
          $_GET['response'] = 'mail_not_found';//retorna una respues a la vista para indicar que el email ingresado no esta registrado
        }
      }    
  }
  /*permite recibir y validar el codigo enviado por el usuario */
  public function codeValidation(){
    
    $this->objUserSession->activeSessionValidation();
    $this->view = "user/codeIntroduction";
    if(isset($_POST['send'])){
      /* llamado al modelo con los datos enviados por el usuario para validar */
      $aux = $this->objUser->codeValidation($_POST['email'], $_POST['code'], $_POST['hash']);
      if($aux === "valid_code" ){
        if($_GET['opc'] === "validation"){
          $this->view = 'user/login';
          $aux = $this->objUser->accountActivation($_POST['email']);
          if($aux === 'error_verifivation'){
            $this->view = "user/codeIntroduction";
          }
        }else if($_GET['opc'] === "recover"){
          $this->view = 'user/recoverPassword';
        }
        
      }// si aux es verdadero se cambia la vista para el cambio de contraseña
      $_GET['response'] = $aux;// capta la respuesta del modelo para enviarla a la vista
      $_GET['email'] = $_POST['email'];
      $_POST['action'] =  $_GET['opc'];//indica la accion que quiero realizar en la vista de codeIntrodiction
    }
  }

  /**permite reenviar el codigo de verificacion en caso de que este alla vencido*/
  public function sendCode(){
    $this->view = "user/codeIntroduction";
    $param = $this->objUser->getUserByEmail($_GET['email']);
    if(isset($_GET['opc']) && $_GET['opc'] === "validation"){
      $hash = "none";
      $this->objUser->sendEmailValidation($param,$hash);
    }else if( isset($_GET['opc']) && $_GET['opc'] === "recover"){
      $this->objUser->recoverPassword($param,$_POST['email'],$_POST['hash']);// se envia el mail al usuario
    }
  }
    
   
  /**permite el cambio de contraseña */
  public function changePassword(){
    
    $this->objUserSession->activeSessionValidation();
    $this->view = 'user/recoverPassword';
    if(isset($_POST['send'])){
      /*llamado al modelo para cambiar la contraseña y retorna una repuesta a la vista */
     $_GET['response'] = $this->objUser->changePassword($_POST['email'], $_POST['password']);
     if($_GET['response'] === 'password_found') $this->view = 'user\login';
    }
  }



  /**Edita perfiles de usuario */
  public function editEmployee(){
    
    $this->view = 'user\editEmploye';
    if(isset($_POST['edit']) && $_POST['edit'] === "send"){
      $_GET['response'] = $this->objUser->editEmployee($_POST,$_GET['id']);
    }
    return $this->objUser->getUserById($_GET['id']);
  }

  public function userVerification(){
    if(isset($_GET['email'])){
      $param = $this->objUser->getUserByEmail($_GET['email']);
      $this->objUser->sendEmailValidation($param,$_POST['hash'],'none');
      $_POST['email'] = $_GET['email']; 
      $_POST['action'] = "validation";
      $this->view='user\codeIntroduction';
      $_GET['response'] = 'set_verify';
    }
  }

  public function redirectingToDashboard(){
    $this->objUserSession= new userSession;
    require_once('dashboard.php');
    $obj = new dashboardController;
    return $obj->summary() ;
  }

    /*Cierre de session */
  public function logout(){
    $band = true;
    $this->objUserSession= new userSession;
    $this->objUserSession->closeSession(); 
  }

  public function timeLoguot(){
    $this->view='user\login';
    $_GET['response'] = "loguot";
  }

  }


?>