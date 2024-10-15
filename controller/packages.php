<?php
    require_once("model/packages.php");
    require_once("model/userSession.php");
    class packagesController{

        public $view;
        public $objpackages;
        public $objUserSession;
        public function __construct(){
            $_GET['response'] = 'false';
            $this->view='packages\packagesList';
            $this->objpackages = new packages;
            $this->objUserSession = new userSession;
           $this->objUserSession->sessionAccessTourist();//Restringe el acceso a los turistas 
        }

        /**Funcion para determinar si hay reservaciones pendientes*/
        public function count(){
            if($this->objpackages->countPendingReservations()){
                echo "pending_reservations";
            }else{
                echo "not_pending_reservations";
            }
            exit();
        }

        /* listar Paquetes */
        public function list(){
            return $this->objpackages->getPackagesByStatus('enable');
        }
        
        /*Listar paquetes deshabilitados*/
        public function listDisable(){
            $this->view= 'packages\listPackagesDisable';
            return $this->objpackages->getPackagesByStatus('disable');
        }

        /*Insertar paquetes */
        public function insert(){
            $this->view= 'packages\insertPackages';
            $_GET['response'] = false ;
            if( isset($_POST['send']) ){
                $_GET['response'] = $this->objpackages->insertPackages($_POST);
                echo $_GET['response'];exit;
            }   
             
        }

        /*editar paquetes */
        public function edit(){
            $this->view='packages\editPackages';
            $_GET['response'] = false;
            if(isset($_GET['id'])){
                if(isset($_POST['edit']) && $_POST['edit'] === "send" ){
                   $_GET['response'] = $this->objpackages->editPackages($_POST,$_GET['id']);
                   echo $_GET['response'];exit;
                }
            return $this->objpackages->getPackagesById($_GET['id']);
            }
        }
        
        /*habilitar e inhabilitar paqutes */
        public function status(){
            if(isset($_GET['id'])){
                /*$_GET['opc'] es una variable que controla que opcion e una condicional se va a realizar */
                $_GET['response'] = $this->objpackages->statusControl($_GET['id'],$_GET['opc']);
            }
            if($_GET['opc'] === 'enable'){
                $this->view = 'packages\listPackagesDisable';
                return $this->objpackages->getPackagesByStatus('disable');
            }else{
                
                return $this->objpackages->getPackagesByStatus('enable');
            }
        
        }
      
    }
?>
