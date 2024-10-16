<?php

class homeController{

    public $view;
    public $objUserSession;

    public function __construct(){
        $this->view= 'home/home'; 

        //activa la sesion si anterior mente habia una
        $this->objUserSession = new userSession;
        $this->objUserSession->recoverySession();
    }

    public function callPubSpecial(){           //--------Controlador para mostrar las piblicaciones activas en el home
        require_once "pubEspecial.php";         //--------Llama archivo controldor del Publicacion
        $pubSpecial= new pubEspecialController; //------Se instancia el controlador del piblicacion especial
        return $pubSpecial->View();             //------Se retornan los valores de las Publicaciones especiaes de la BD
    }

    public function callRoute(){           //--------Controlador para mostrar las Rutas activas en el home
        require_once "route.php";           //--------Llama archivo controlador del Rutas      
        $route= new routeController;        //--------Se instancia el controlador del rutas
        return $route->listRouteEnabled();  //--------Se retornan los valores de las Rutas de la BD
    }
    public function callPackage(){           //--------Controlador para mostrar las paquetes activas en el home
        require_once "packages.php";           //--------Llama archivo controlador del paquetes      
        $package= new packagesController;        //--------Se instancia el controlador del paquetes
        return $package->list();  //--------Se retornan los valores de las paquetes de la BD
    }
    //////////////////////////////////////////////////////
    public function callfaqs(){           //--------Controlador para mostrar las piblicaciones activas en el home
        require_once "faqs.php";         //--------Llama archivo controldor del Publicacion
        $faqs= new faqsController; //------Se instancia el controlador del piblicacion especial
        return $faqs->listFaq();             //------Se retornan los valores de las Publicaciones especiaes de la BD
    }

    /* public function callRoute(){           //--------Controlador para mostrar las Rutas activas en el home
        require_once "route.php";           //--------Llama archivo controlador del Rutas      
        $route= new routeController;        //--------Se instancia el controlador del rutas
        return $route->listRouteEnabled();  //--------Se retornan los valores de las Rutas de la BD
    }
    public function callPackage(){           //--------Controlador para mostrar las paquetes activas en el home
        require_once "packages.php";           //--------Llama archivo controlador del paquetes      
        $package= new packagesController;        //--------Se instancia el controlador del paquetes
        return $package->list();  //--------Se retornan los valores de las paquetes de la BD
    } */
    

    /////////////////////////////////////////////////////
    public function dashBoard(){
        $this->view='dashBoard';
    }
    
}

?>