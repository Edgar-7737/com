<hr>
<!-- barra de enlaces -->
<nav  >
    <div>
        <img src="asset\img\IconoBitacoraO\IconoBitacoraO.png" alt="" width=100px>
        <h1>Bitácora Oriental</h1>
     </div>
 <table>
    <tr>
        <td>Inico</a>&nbsp</td>
        <td>Rutas</a>&nbsp</td>
        <td>Paquetes</a>&nbsp</td>
        <td>Bitacoras</a>&nbsp</td>
        <td>Preguntas&nbspFrecuetes</a>&nbsp</td>
        <td>Sobre Nosotros</td>  
        <td> <?php
            if(isset($_SESSION['user'])){ 
        ?> 
        <a href="index.php?controller=users&action=logout" title="Salir">Salir</a></td>
        <?php }?>
    </tr>

 </table>
</nav>
<hr>   

