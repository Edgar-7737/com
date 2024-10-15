<?php if(!isset($_SESSION['user']))header("location:". DEFAULT_ADDRESS_LOGOUT);?>

<link rel="stylesheet" href="asset\css\adashboard.css">

            <main>
                    <div class="header">
                        <div class="left">
                            <h2>Lista de Usuarios <?php echo $_GET['userType']?>s <?php if( $_GET['status'] === '1'){ echo ' habilitados';}else{echo ' Inhabilitados';} ?> </h2>
                        </div>
                    </div>

                    <script type="text/javascript">
                            function redirigir(select) {
                                var url = select.value;
                                if (url) {
                                    window.location.href = url;
                                }
                            }
                    </script>

                    <style>
                        select.custom-select {
                                background-color: #D9EAD3; /* Fondo verde claro */
                                color: #5B5B5B; /* Texto gris oscuro */
                                border: 1px solid #A9C4A0; /* Borde verde */
                                padding: 5px;
                                font-size: 16px;
                                border-radius: 4px; /* Bordes redondeados */
                                width: 100%; /* Ancho completo */
                            }

                            /* Estilo para las opciones del select */
                            select.custom-select option {
                                background-color: #A9C4A0; /* Verde más oscuro para las opciones */
                                color: white; /* Texto blanco */
                            }

                            /* Alternar colores para las opciones */
                            select.custom-select option:nth-child(odd) {
                                background-color: #8DAF8D; /* Verde aún más oscuro para las opciones impares */
                            }
                    </style>
                


                

                <div class="bottom-data">                
                  <div>

                    <br>
                    <div class="rift">
                        <select class="custom-select" id="menu-listUser" name="menu-listUser" onchange="redirigir(this)">
                            <option value="#"><a href="#">Tipo de usuario...</a></option>
                            <option value="index.php?controller=users&action=list&userType=publicista&status=1"><a href="">Usurios Publicistas Habilitados</a></option>
                            <option value="index.php?controller=users&action=list&userType=turista&status=1"><a href="#">Usurios Turistas Habilitados</a></option>
                            <option value="index.php?controller=users&action=list&userType=publicista&status=0"><a href="#">Usurios Publicistas Inhabilitados</a></option>
                            <option value="index.php?controller=users&action=list&userType=turista&status=0"><a href="#">Usurios Turistas Inhabilitados</a></option>
                        </select>
                    </div> 
                        
                    <a class="enlaces" href="index.php?controller=users&action=registerPublicist"><button class="button-Rev2" >Registrar usuario publicista</button></a>
                    
                  
                            <table id="userTable" class="display" style="width:100%">
                                <?php  if(count($dataToView["data"])>0){ ?>
                                <thead>
                                      <tr>
                                          <th>Nombre</th>
                                          <th>Apellido</th>
                                          <th>Telefono</th>
                                          <th>Email</th>
                                          <th>Privilegio</th>
                                          <?php  if($_GET['status'] === '1'){?><th>Inhabilitar</th> 
                                          <?php }else{?><th>Habilitar</th><?php }?>
                                        
                                      </tr> 
                              </thead>
                              <tbody>
                                    <?php foreach($dataToView["data"] as $data){ ?>
                                        <tr>
                                          <td><?php echo $data['name']; ?></td>
                                          <td><?php echo $data['lastName'];?></td>
                                          <td><?php echo $data['phone']; ?></td>
                                          <td><?php echo $data['email']; ?></td>
                                          <td><?php echo $data['privilege']; ?></td>  
                                          <?php  if($_GET['status'] === '1'){?>
                                          <td>
                                          <?php if($_GET['userType'] === 'publicista'){ ?><a class="enlaces" href="index.php?controller=users&action=editEmployee&id=<?php echo $data['idUser']?>"><img src="asset/icon/edit.png" width=30px ></a><?php }?>
                                          <a href="index.php?controller=users&action=status&opc=disable&id=<?php echo $data['idUser'] ?>&userType=<?php echo $_GET['userType'] ?>&status=<?php echo $_GET['status']?>" title="inhabilitar">
                                          <img src="asset/icon/disable.png" width=30px></a>
                                          </td> 
                                          <?php }else{?><td><a href="index.php?controller=users&action=status&opc=enable&id=<?php echo $data['idUser'] ?>&userType=<?php echo $_GET['userType'] ?>&status=<?php echo $_GET['status']?>" title="habilitar">
                                          <img src="asset/icon/enable.png" width=30px></a></td><?php }?>
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

            <!--////////////////////////////////// Data Table //////////////////////////////////-->
            <script src="asset\js\scripts\dataTableDynamic.js"></script>
            <!--////////////////////////////////// Switc alert //////////////////////////////////-->
            <div id="alert" nameAlert=<?php echo json_encode($_GET['response']); ?> modelAlert="dashboard"></div>
            <script src="asset\js\scripts\alert.js"></script>
       
        

 