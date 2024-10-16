


<?php
/*Variables globales*/
define("DB_HOST", "localhost");
define("DB", "bitacora_oriental2");
define("DB_USER", "root");
define("DB_PASS", "");

define("COST_MVC", "bitacora_oriental");
/*Manejo de sessiones */
define("COST_PASSWORD", ["cost" => 11]);
/**EL DEFAULT_ADDRESS_LOGOUT debe tener el nombre de la carpeta*/
define("DEFAULT_ADDRESS_LOGOUT","index.php");
/**Define la cantidad di dias de antelacion con la que se notifica el viaje mas cercano */
define("TRAVEL_NOTIFICATION_PERIOD",7); //se expresa en dias
/*Duracion de la valides de los mensajes de verificación (Se expresa en minutos)*/
define("DEFAULT_DATE_CODE", 10);
/*Duracion del tiempo de sesion de los usuarios(Se expresa en minutos) */
Define("LOGOUT_TIME",30);

/* constantes para cargar la pagina por defecto en la main(pagina principal) */
define ( "DEFAULT_CONTROLLER", "home");//vista por defecto
define ("DEFAULT_ACTION", "" );// accion por defecto

/*cookie de sesion que inidica el tiempo de vida de la sesion cuando de cierra el navegador */
session_set_cookie_params(0);






?>