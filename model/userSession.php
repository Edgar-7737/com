<?php
/*
        //activa la sesion si anterior mente habia una
        $this->objUserSession = new userSession;
        $this->objUserSession->recoverySession();

        //funncion para resgitringir el acceso a los usuarios turistas

        //public function sessionAccessAdmin()

        //cookie de sesion que inidica el tiempo de vida de la sesion cuando de cierra el navegador
        session_set_cookie_params(0);// en cero indica que al cerrar el navegaro la sesion finaliza

 */
    class userSession {
        
        public function __construct(){
            if(session_status() !== PHP_SESSION_ACTIVE)     session_start();
            if(isset($_SESSION['timeSession']) && !isset($band))    $this->timeValidation();
            if(isset($_SESSION['timeSession']) && !isset($band))    $this->timeSession();
        }
        /*Inicializa la variable de user */
        public function setCurrentUser($user){
            $_SESSION['user'] = $user;
        }
        /*Recupera una sesion si habia una anteriormente */
        public function recoverySession(){
            if(!isset($_SESSION['user'])){
                session_unset();
                session_destroy();
            }
        }
        /*Define el tiempo de sesion de un usuario */
        public function timeSession(){
            date_default_timezone_set('America/Caracas');// se establece la zona horaria
            $_SESSION['timeSession'] = date("Y-m-d H:i:s");//se capta la hora de ingreso del usuario
        }
        /*comprueba si el tiempo de sesion de un usuario a caducado */
        public function timeValidation(){
            date_default_timezone_set('America/Caracas');
            $dateExpire = date("Y-m-d H:i:s"); // Formato de fecha // si no esta asi Y-m-d H:i:s no funciona
            $seconds = strtotime($dateExpire) - strtotime($_SESSION['timeSession']) ;// determinado los segundos transcurridos
            $minutes = $seconds / 60;// convirtiendo a minutos
            if($minutes > LOGOUT_TIME) $this->finishedTime();
        }
        //funncion para resgitringir el acceso a los usuarios turistas
        public function sessionAccessTourist(){
            if( isset($_SESSION['user']['privilege']) && $_SESSION['user']['privilege'] === 'turista'){
                $this->closeSession();
            }
        }
        /*Permite el acceso solo a los usuarios administradores */
        public function sessionAccessAdmin(){// se comprueban las credenciales
            if(isset($_SESSION['user']['privilege']) && $_SESSION['user']['privilege'] !== 'admin'){
                //dependiendo del rol se redireciona 
                if($_SESSION['user']['privilege'] === 'publicista'){
                    header('location: index.php?controller=dashboard&action=summary');
                }else{
                    header('location: index.php?controller=home');
                } 
            }
        }
        
       

        /*Funcion para validar si la sesion esta acitva */
        public function activeSessionValidation(){
            if (isset($_SESSION['user'])){//para restringir el acceso a ciertas funciones de user
                $this->closeSession(); 
            }else{
                session_unset();
                session_destroy();
            }
        }
        /*Redirige a los usauros a si el tiempo de sesion a caducado */
        public function finishedTime(){
            session_unset();
            session_destroy();
            header('location: index.php?controller=users&action=timeLoguot');
            exit();
        }
        /*Cierra la sesion y redirige al usuario */
        public function closeSession(){
            session_unset();
            session_destroy();
            header("location:". DEFAULT_ADDRESS_LOGOUT);
            exit();
        }
    }

?> 