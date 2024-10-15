<?php if(!isset($_SESSION['user']))header("location:". DEFAULT_ADDRESS_LOGOUT);?>  

   
                <main>
                    <div class="header">
                        <div class="left">
                            <h2>Paquetes</h2>
                        </div>
                    </div>

                    <div class="bottom-data">
                        <div >
                        <div class="left">
                            <a class="enlaces" href="index.php?controller=packages&action=list" title="Visualizar Paquetes Habilitados"><button class="button-Rev2" >Habilitados</button></a>
                        </div>
                            
                           
                            <table id="packgesTable" class="display" style="width:100%">
                                <?php   if(count($dataToView["data"])>0){ ?>
                              <thead>
                                <tr>
                                    <th>Título</th>
                                    <th>Descripción</th>
                                    <th>Transporte</th>
                                    <th>Comida</th>
                                    <th>Hospedaje</th>
                                    <th>Precio</th>
                                    <th>Habilitar</th>
                                </tr>
                              </thead>
                              <tbody>
                                    <?php
                                    foreach($dataToView["data"] as $data){ 
                                    ?>
                                            <tr>
                                                <td><?php echo $data['title']; ?></td>
                                                <td><?php echo $data['description']; ?></td>
                                                <td><?php echo $data['transport']; ?></td>
                                                <td><?php echo $data['food']; ?></td>
                                                <td><?php echo $data['lodging']; ?></td>
                                                <td><?php echo $data['price']; ?></td>
                                                <td><a href="index.php?controller=packages&action=status&opc=enable&id=<?php echo $data['idPackages'] ?>" title="habilitar">
                                                <img src="asset/icon/enable.png" width=30px></a></td>
                                                    
                                            </tr>
                                        <?php
                                            }// foreach
                                            }
                                        ?>
                                        
                                </tbody>
                            </table>
                        </div>
                    </div>
                </main>
            <!--////////////////////////////////// Switc alert //////////////////////////////////-->    
            <div id="alert" nameAlert=<?php echo json_encode($_GET['response']) ?> modelAlert="packages"></div>
            <script src="asset\js\scripts\alert.js"></script>
            <!--////////////////////////////////// Data Table //////////////////////////////////-->
            <script src="asset\js\scripts\dataTableDynamic.js"></script>
    





                