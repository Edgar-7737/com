<?php

require_once("model/db.php");

class Dashboard {

    /* Atributos para la conexión con BD */
    public $table;
    public $conection;

    public function __construct() {
        
    }

    public function getConection() {
        $DbObj = new Db();
        $this->conection = $DbObj->conection;
    }

    public function packetCounting() {
        $this->getConection();

        // Consulta SQL para contar registros con status = 1
        $sql_status_1 = "SELECT COUNT(*) AS total_status_1 FROM packages WHERE status = 1";
        $result_status_1 = $this->conection->query($sql_status_1);
        $total_enable = $result_status_1->fetch();
        // Consulta SQL para contar registros con status = 0
        $sql_status_0 = "SELECT COUNT(*) AS total_status_0 FROM packages WHERE status = 0";
        $result_status_0 = $this->conection->query($sql_status_0);
        $total_disable =  $result_status_0->fetch();
        // Captar los datos en variables
      /*   echo "----------------------------------PAQUETES<br>";
        echo "----------------------------------Total: ".$total_enable['total_status_1'] + $total_disable['total_status_0']. "<br>";
        echo "----------------------------------Enable: ".$total_enable['total_status_1']."<br>";
        echo "----------------------------------Disable: ".$total_disable['total_status_0']. "<br>";
         */
        return array(
            "packages" => $total_enable['total_status_1'] + $total_disable['total_status_0'],
            "packagesEnable" => $total_enable['total_status_1'],
            "packagesDisable" => $total_disable['total_status_0']
        );
    }

    public function routeCounting(){
        $this->getConection();

        // Consulta SQL para contar registros con status = 1
        $sql_status_1 = "SELECT COUNT(*) AS total_status_1 FROM route WHERE status = 1";
        $result_status_1 = $this->conection->query($sql_status_1);
        $total_enable = $result_status_1->fetch();
        // Consulta SQL para contar registros con status = 0
        $sql_status_0 = "SELECT COUNT(*) AS total_status_0 FROM route WHERE status = 0";
        $result_status_0 = $this->conection->query($sql_status_0);
        $total_disable =  $result_status_0->fetch();
        // Captar los datos en variables
       /*  echo "<br>----------------------------------RUTAS<br>";
        echo "----------------------------------Total: ".$total_enable['total_status_1'] + $total_disable['total_status_0'] . "<br>";
        echo "----------------------------------Enable: ".$total_enable['total_status_1']."<br>";
        echo "----------------------------------Disable: ".$total_disable['total_status_0']. "<br>";
         */
        return array(
            "route" => $total_enable['total_status_1'] + $total_disable['total_status_0'],
            "routeEnable" => $total_enable['total_status_1'],
            "routeDisable" => $total_disable['total_status_0']
        );

    }

    public function faqCounting(){
        // Consulta SQL para contar registros con status = 1
        $sql_status_1 = "SELECT COUNT(*) AS total_status_1 FROM faq WHERE status = 1";
        $result_status_1 = $this->conection->query($sql_status_1);
        $total_enable = $result_status_1->fetch();
        // Consulta SQL para contar registros con status = 0
        $sql_status_0 = "SELECT COUNT(*) AS total_status_0 FROM faq WHERE status = 0";
        $result_status_0 = $this->conection->query($sql_status_0);
        $total_disable =  $result_status_0->fetch();
        // Captar los datos en variables
       /*  echo "<br>----------------------------------Preguntas frecuentes<br>";
        echo "----------------------------------Total: ".$total_enable['total_status_1']+$total_disable['total_status_0']. "<br>";
        echo "----------------------------------Enable: ".$total_enable['total_status_1']."<br>";
        echo "----------------------------------Disable: ".$total_disable['total_status_0']. "<br>";
         */
        return array(
            "faq" => $total_enable['total_status_1']+$total_disable['total_status_0'],
            "faqEnable" => $total_enable['total_status_1'],
            "faqDisable" => $total_disable['total_status_0']
        );
    }

    public function pubSpecialsCounting(){
        // Consulta SQL para contar registros con status = 1
        $sql_status_1 = "SELECT COUNT(*) AS total_status_1 FROM pubSpecials WHERE status = 1";
        $result_status_1 = $this->conection->query($sql_status_1);
        $total_enable = $result_status_1->fetch();
        // Consulta SQL para contar registros con status = 0
        $sql_status_0 = "SELECT COUNT(*) AS total_status_0 FROM pubSpecials WHERE status = 0";
        $result_status_0 = $this->conection->query($sql_status_0);
        $total_disable =  $result_status_0->fetch();
        // Captar los datos en variables
       /*  echo "<br>----------------------------------Publicaciones especiales<br>";
        echo "----------------------------------Total: ".$total_enable['total_status_1']+$total_disable['total_status_0']. "<br>";
        echo "----------------------------------Enable: ".$total_enable['total_status_1']."<br>";
        echo "----------------------------------Disable: ".$total_disable['total_status_0']. "<br>";
         */
        return array(
            "pubSpecials" => $total_enable['total_status_1']+$total_disable['total_status_0'],
            "pubSpecialsEnable" => $total_enable['total_status_1'],
            "pubSpecialsDisable" => $total_disable['total_status_0']
        );

    }

    /* public function tripCounting(){
        // Consulta SQL para contar registros con status = 1
        $sql_status_1 = "SELECT COUNT(*) AS total_status_1 FROM trip WHERE status = 1";
        $result_status_1 = $this->conection->query($sql_status_1);
        $total_enable = $result_status_1->fetch();
        // Consulta SQL para contar registros con status = 0
        $sql_status_0 = "SELECT COUNT(*) AS total_status_0 FROM trip WHERE status = 0";
        $result_status_0 = $this->conection->query($sql_status_0);
        $total_disable =  $result_status_0->fetch();
        // Captar los datos en variables
        echo "<br>----------------------------------Viajes<br>";
        echo "----------------------------------Total: ".$total_enable['total_status_1']+$total_disable['total_status_0']. "<br>";
        echo "----------------------------------Enable: ".$total_enable['total_status_1']."<br>";
        echo "----------------------------------Disable: ".$total_disable['total_status_0']. "<br>";
        
        return array(
            "trip" => $total_enable['total_status_1']+$total_disable['total_status_0'],
            "tripEnable" => $total_enable['total_status_1'],
            "tripDisable" => $total_disable['total_status_0']
        );
    } */


    public function userTouristCounting(){
         // Consulta SQL para contar registros con status = 1
         $sql_status_1 = "SELECT COUNT(*) AS total_status_1 FROM user WHERE privilege = 'turista' AND status = 1";
         $result_status_1 = $this->conection->query($sql_status_1);
         $total_enable = $result_status_1->fetch();
         // Consulta SQL para contar registros con status = 0
         $sql_status_0 = "SELECT COUNT(*) AS total_status_0 FROM user WHERE privilege = 'turista' AND status = 0";
         $result_status_0 = $this->conection->query($sql_status_0);
         $total_disable =  $result_status_0->fetch();
         // Captar los datos en variables
        /*  echo "<br>----------------------------------Usuarios turista<br>";
         echo "----------------------------------Total: ".$total_enable['total_status_1']+$total_disable['total_status_0']. "<br>";
         echo "----------------------------------Enable: ".$total_enable['total_status_1']."<br>";
         echo "----------------------------------Disable: ".$total_disable['total_status_0']. "<br>";
          */
         return array(
             "userTourist" => $total_enable['total_status_1']+$total_disable['total_status_0'],
             "userTouristEnable" => $total_enable['total_status_1'],
             "userTouristDisable" => $total_disable['total_status_0']
         );
   
        
        }

        
        public function userPublicistCounting(){
            $sql_status_1 = "SELECT COUNT(*) AS total_status_1 FROM user WHERE privilege = 'publicista' AND status = 1";
            $result_status_1 = $this->conection->query($sql_status_1);
            $total_enable = $result_status_1->fetch();
            // Consulta SQL para contar registros con status = 0
            $sql_status_0 = "SELECT COUNT(*) AS total_status_0 FROM user WHERE privilege = 'publicista' AND status = 0";
            $result_status_0 = $this->conection->query($sql_status_0);
            $total_disable =  $result_status_0->fetch();
            return array(
                "userPublicist" => $total_enable['total_status_1']+$total_disable['total_status_0'],
                "userPublicistEnable" => $total_enable['total_status_1'],
                "userPublicistDisable" => $total_disable['total_status_0']
            );

    }
    /*retorna un viaje si esta serca de cumplirce en un plazo establecido*/
    public function nearbyTrip(){
        $this->getConection();
        $date = TRAVEL_NOTIFICATION_PERIOD;
        $sql = "SELECT t.title, t.departureDate 
                FROM traveloffer p 
                JOIN trip t ON p.idTrip = t.idTrip 
                WHERE p.status = 1 
                AND ABS(DATEDIFF(t.departureDate, CURDATE())) <= $date
                ORDER BY ABS(DATEDIFF(t.departureDate, CURDATE())) 
                LIMIT 1;";
        $stmt = $this->conection->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
            
    }

    /*Funcion para contar el numero de notoficaciones */
    public function numberNotification(){
        $i = 0;//se puede agregar mas logica para contar mas notificaciones
        if($this->nearbyTrip() !== false) $i++;
        return $i;
    }
    /*Retorna las primeras 5 ofertas de viaje mas proximas a la fecha en orden asendente(mas secana hasta mas lejana) */
    public function traveloffer(){
        $this->getConection();
        
        $sql = "WITH UniqueTrips AS (
            SELECT traveloffer.id, trip.title, trip.departureDate, trip.numberSlots,
            ROW_NUMBER() OVER (PARTITION BY trip.idTrip ORDER BY trip.departureDate ASC) AS rn
            FROM traveloffer JOIN trip ON traveloffer.idTrip = trip.idTrip WHERE traveloffer.status = 1)
        SELECT id,  title,  departureDate, numberSlots
        FROM  UniqueTrips WHERE rn = 1 ORDER BY  departureDate ASC LIMIT 5;";
        $stmt = $this->conection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();     
        
    }
    

}//////////////////////////////////////////////////////////////////////
?>