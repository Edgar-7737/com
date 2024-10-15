<?php

    require_once("model/dashboard.php");
    require_once("model/userSession.php");
    
    class dashboardController{

        public $view;
        public $objDashboard;
        public $objUserSession;

        public function __construct(){
            $_GET['response'] = 'false';
            $this->objDashboard = new dashboard;
            $this->objUserSession = new userSession;
        }

    public function summary(){
        $this->view = "dashboard/dashboard";

        //llamado a los datos de la base de datos para el dashboard
        return array( // array asosiativo esquisofrenico 

            //panel de control del dasboard
            "packages" => $this->objDashboard->packetCounting(),
            "route" => $this->objDashboard->routeCounting(),
            "faq" => $this->objDashboard->faqCounting(),
            "pubSpecials" => $this->objDashboard->pubSpecialsCounting(),
                //"trip" => $this->objDashboard->tripCounting(),
            "userTourist" => $this->objDashboard->userTouristCounting(),
            "userPublicist" => $this->objDashboard->userPublicistCounting(),

            //notificaciones del dashboard
           // "numberNotification" => $this->objDashboard->numberNotification(),
            "nearbyTrip" => $this->objDashboard->nearbyTrip(),
            

            //viajes planificados
            "traveloffer" => $this->objDashboard->traveloffer(),
        ); 
    }
    

    /**
     * consulta para los viajes y cuando salen (idtrip title fecha) que sea 7 dias antes del viaje 
     * consulta para las reservaciones pendientes 
     * consulata para saber si las los comentarios, bitacoras o reservaciones estan habilitados o deshabilitado
     */


}/////////////////////////////////////////////////////////////////

/* $packages = $this->objDashboard->packetCounting();
    $route = $this->objDashboard->routeCounting();
    $faq = $this->objDashboard->faqCounting();
    $pubSpecials = $this->objDashboard->pubSpecialsCounting();
    //$trip = $this->objDashboard->tripCounting();
    $traveloffer = $this->objDashboard->travelofferCounting();
    $userTourist = $this->objDashboard->userTouristCounting();
    $userEmployee = $this->objDashboard->userEmployeeCounting(); */
?>