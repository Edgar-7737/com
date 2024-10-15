<?php if(!isset($_SESSION['user']))header("location:". DEFAULT_ADDRESS_LOGOUT);?>  
                <main>
                    <div class="header">
                        <div class="left">
                            <h2>Paquetes</h2>
                        </div>
                    </div>

                <div class="bottom-data">
                    <div>
                        <div class="rift">
                            <a class="enlaces" href="index.php?controller=packages&action=listDisable" title="Visualizar Paquetes Inhabilitados"><button class="button-Rev2" >Inhabilitados</button></a>
                            <a class="enlaces" href="index.php?controller=packages&action=insert" ><button class="button-Rev2" >Añadir</button></a>
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
                                    <th>Opciones</th>
                                </tr>
                              </thead>
                              <tbody>
                                    <?php foreach($dataToView["data"] as $data){ ?>
                                        <tr>
                                            <td><?php echo $data['title']; ?></td>
                                            <td><?php echo $data['description']; ?></td>
                                            <td><?php echo $data['transport']; ?></td>
                                            <td><?php echo $data['food']; ?></td>
                                            <td><?php echo $data['lodging']; ?></td>
                                            <td><?php echo $data['price']; ?></td>
                                            <td><a href="index.php?controller=packages&action=edit&id=<?php echo $data['idPackages'] ?>" title="Editar">
                                            <img src="asset/icon/edit.png" width=30px ></a>
                                            <a href="index.php?controller=packages&action=status&opc=disable&id=<?php echo $data['idPackages'] ?>" title="Inhabilitar">
                                            <img src="asset/icon/disable.png" width=30px></a></td>
                                                
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

 
    



