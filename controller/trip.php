<?php
//--------------------------------------Controlador de las Rutas----------------------------------///
    require_once("model/trip.php"); //--------------llamado al archivo del controlador de las Rutas
        
    class tripController{

        public $view; //---------------Atributo para las vistas
        public $ObjTrip; //---------- Atributo para el modelo de la base de datos
        public $objUserSession;//------Atributo para mantener la sesion activa
        
        public function __construct(){ //-------------------Constructor de atributos base del controlador
            $this->view='trip\listTrip';   //-------------listTrip vista base de las Rutas
            $this->ObjTrip = new trip ; //----------------Instancia el modelo de la base de datos de Rutas
            $this->objUserSession = new userSession; //-----Instancia del obj sesion
        }
   
        public function listTripEnabled(){ /* --------------------listar Rutas Habiles  */
            return $this->ObjTrip->getTrip(1); //----------llamado del lista de paquetes habilitados en la bd
        }

        public function listTripDisabled(){    /* ----------Listar rutas Desahabilitas----------*/
            $this->view='trip\listDisabledTrip';
            return $this->ObjTrip->getTrip(0); //---Retorna de la bd las rutas Desahabilitadas  
        }
  
        public function addTrip() {
            $this->view = 'trip\addTrip'; //-------------- Se manda la vista de añadir viajes
            if (isset($_POST['send'])) { //----------------Se evalúa si se enviaron datos en el botón send
               // $_POST = $this->chainCorrector($_POST); // Se depura el arreglo enviado
                $this->ObjTrip->addingTrip($_POST);    
            } else{
                require_once "route.php";           //--------Llama archivo controlador del Rutas      
                $route= new routeController;        //--------Se instancia el controlador del rutas
                return $route->listRouteEnabled();  //--------Se retornan los valores de las Rutas de la BD
            }
        }

        public function editTrip(){  //--------------------------Editar Rutas de  Viaje
            $this->view='trip\editTrip';       //---------------Cambia la pantalla al editTrip
                //------------------------------------------------Llama a la funcion de sobre escribir
            if(isset($_POST['send'])){ 
                //$_POST=$this->chainCorrector($_POST);   //-------------Se depura el arreglo enviado
               // $this->ObjTrip->AboutWriting($_POST, $_GET['id']); 
            }
            return $this->ObjTrip->getTripById($_GET['id']);  //------------Retorna el objeto modificado
             
        }

        public function disableTrip(){   /* ---------------------------Desahabilitar y habilitar Rutas de viaje----------*/
            if (isset($_GET['id']) && isset($_GET['opc'])){             //----------Valida si se envio el id y la opc a editar
                $this->ObjTrip->statusTrip($_GET['id'], $_GET['opc']);  //----------Llama a el objeto que capta y edita el status
                return  $_GET['opc']==='false'?  $this->listTripEnabled() : $this->listTripDisabled();                 
                //---------------Muestra las vistas de habilitando o desahabilidando-----------------*/
            }    
        }

        public function chainCorrector($chain) {            /* CORRIGE LAS IMPERFECCIONES DE LA CADENA */
            foreach ($chain as &$valor) {         //-------------------Se recorre el objeto tipo arreglo
                if ($valor !== "backup") {        //-----------Se verifica si el valor no debe modificarse 
                    $valor = trim($valor);        //-------------------Se eliminan los espacios al principio y al final
                    $valor = strtolower($valor);  //----------------Se convierte toda la cadena en minuscula
                    $valor = ucfirst($valor);     //----------------Se convierte la primera letra en Mayuscula  
                }
            }
            return $chain;
        }
    }  /*----------------------------------------------------------------------- FINAL DEL OBJETO ROUTE*/
?>