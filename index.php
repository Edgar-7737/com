<?php

/* LLamado a el archivo userSession para manejar sesiones */
require_once("model/userSession.php");

/*instacia de la clase userSession para operar las sessiones y tambien inica sesion automaticamente */

//$objUserSession = new userSession;

/* LLamado a los archvos config y direccionador*/
require_once("config/config.php");
require_once("inc/main.php");

/* Validacion del controlador y la accion */  /*asigancion por defecto si no se carga nada*/
if(!isset($_GET["controller"]) )   $_GET["controller"]= constant("DEFAULT_CONTROLLER");
if(!isset($_GET["action"]))         $_GET["action"]= constant("DEFAULT_ACTION");

/* se crea la direccion del controlador a la que se quiere acceder */
$controller_path= "controller/".$_GET["controller"].".php";

/* valida si el archivo existe */
if(!file_exists($controller_path)) $controller_path = 'controller/'.constant("DEFAULT_CONTROLLER").'.php';

/* se accede al controlador */
require_once $controller_path;

/* se crea el nombre de la clase del controlador que se quiere usar y se le concatena Controller */
$controllerName = $_GET["controller"].'Controller';

/* se instancia el controlador */
$controller = new $controllerName();

/* validar que el motodo exista  */
$dataToView['data'] = array();
if(method_exists($controller,$_GET["action"])) $dataToView['data'] = $controller->{$_GET["action"]}();



/*Empalme de la arquitectura del Portal Web */
require_once 'view/template/header.php';
require_once 'view/'.$controller->view.".php";/* accediendo al atributo view que contiene la vista*/
require_once 'view/template/footer.php';

?>