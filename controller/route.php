<?php
//--------------------------------------Controlador de las Rutas----------------------------------///
    require_once("model/route.php"); //--------------llamado al archivo del controlador de las Rutas
        
    class routeController{

        public $view; //---------------Atributo para las vistas
        public $ObjRoute; //---------- Atributo para el modelo de la base de datos
        public $objUserSession;//------Atributo para mantener la sesion activa
        
        public function __construct(){ //-------------------Constructor de atributos base del controlador
            $this->view='route\listRoute';   //-------------listRoute vista base de las Rutas
            $this->ObjRoute = new route ; //----------------Instancia el modelo de la base de datos de Rutas
            $this->objUserSession = new userSession; //-----Instancia del obj sesion
        }
         
        
        public function listRouteEnabled(){ /* --------------------listar Rutas Habiles  */
            return $this->ObjRoute->getRoutesByStatus(1); //----------llamado del lista de paquetes habilitados en la bd
        }
        
        public function listRouteDisabled(){    /* ----------Listar rutas Desahabilitas----------*/
           $this->view='route\routeListDisabled';   // -----------Asigna la vista de Rutas desahabilitadas
           return $this->ObjRoute->getRoutesByStatus(0); //---Retorna de la bd las rutas Desahabilitadas  
        }
  
        public function addRoute() {
            $this->view = 'route\addRoute'; // Se manda la vista de añadir Rutas 
            if (isset($_POST['send'])) { // Se evalúa si se enviaron datos en el botón send
                //$_POST = $this->chainCorrector($_POST); // Se depura el arreglo enviado 
                //header('Location:index.php?controller=route&action=listRouteEnabled');
                $this->ObjRoute->addingRoute($_POST, $_FILES['image']);     
            }  
        }

        public function editRoute(){  //--------------------------Editar Rutas de  Viaje
            $this->view='route\editRoute';       //---------------Cambia la pantalla al editRoute
                //------------------------------------------------Llama a la funcion de sobre escribir
            if(isset($_POST['send'])){ 
                $_POST=$this->chainCorrector($_POST);   //-------------Se depura el arreglo enviado
                $this->ObjRoute->AboutWriting($_POST, $_FILES['image'] ,$_GET['id']); 
            }
            return $this->ObjRoute->getRouteById($_GET['id']);  //------------Retorna el objeto modificado
             
        }

        public function disableRoute(){   /* ---------------------------Desahabilitar y habilitar Rutas de viaje----------*/
            if (isset($_GET['id']) && isset($_GET['opc'])){             //----------Valida si se envio el id y la opc a editar
                $this->ObjRoute->statusRoute($_GET['id'], $_GET['opc']);  //----------Llama a el objeto que capta y edita el status
                return  $_GET['opc']==='false'?  $this->listRouteEnabled() : $this->listRouteDisabled();                 
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