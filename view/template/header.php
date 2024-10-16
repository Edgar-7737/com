<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="uft8_spanish2_ci">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bitacora Oriental</title>
    <link rel="stylesheet" href="asset\css\styleModel.css">
    <link rel="stylesheet" href="asset\css\datatables.min.css">
    <link rel="stylesheet" href="asset\css\lightbox.min.css">
    <link rel="stylesheet" href="asset\css\cropperStyle.css">

    <link rel="stylesheet" href="asset\css\styleNew.css">
    <!-- <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>  -->
    
    
    
    <!-- Libreria de Data Tabla -->
    <script src="asset\js\app\jquery-3.6.0.min.js"></script>
    <script src="asset\js\app\datatables.min.js"></script>
    <script src="asset\js\app\sweetAlert.js"></script>
    
    
  
</head>


<body id="body">
    
    
<!-- membrete, llama a menu -->
    
<!-- cabezera menbrete --> 
    
        <?php 
        if( (isset($_SESSION['user']['name'])) && ($_SESSION['user']['privilege'] === "admin" || $_SESSION['user']['privilege'] === "publicista" )){?>

        <div class="icon__menu">
            <i class="fas fa-bars" id="btn_open"></i>
        </div>
        <?php 
            require_once 'view\template\sidebar.php';
        } else { 
            require_once 'view/template/menuTourist.php';
        }?>
        
    
    
        <?php if(!isset($_SESSION['user']['name'])){ ?>
            <!-- Boton para iniciar sesion -->     
        <a href="index.php?controller=users&action=login" title="Iniciar Sesion"><button class="button-Rev2" >Iniciar sesion</button></a></td>
                <!-- Boton para Registrarte-->   
        <a href="index.php?controller=users&action=register" title="Registrate"><button class="button-Rev2" >Registrate</button></a>
        <?php }else   require_once 'view\template\sidebarPerfil.php'; ?>
    
 <!-- Inicio, Usuario -->

   




   
 
 


