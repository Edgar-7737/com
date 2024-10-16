<?php
/*empezando a modifixar */
    require_once("model/pubEspecial.php");
    

    class pubEspecialController{

        public $view;
        public $ObjpubEspecial;
        public $objUserSession;
        public function __construct(){
            $this->view='pubSpecial\pubEspecialList';
            $this->ObjpubEspecial = new pubEspecial;
            $this->objUserSession = new userSession;
            
        }

        public function list(){
            return $this->ObjpubEspecial->getPubEspecialByStatus('enable');
        }
        /*Listar paquetes deshabilitados*/
        public function listDisable(){
            $this->view= 'pubSpecial\listPubEspecialDisable';
            return $this->ObjpubEspecial->getPubEspecialByStatus('disable');
        }

        public function View(){
            $this->view= 'pubSpecial\viewPubEspecial';
            return $this->ObjpubEspecial->getPubEspecialByStatus('enable');
        }

        /*Insertar publicaciones especiales */

        public function insert() {
            $this->view = 'pubSpecial\insertPubEspecial';
            $_GET['response'] = false;
        
            if (isset($_POST['send'])) {
                $_GET['response'] = true;
        
                try {
                    $param = array(
                        'title' => $_POST['title'],
                        'description' => $_POST['description'],
                        'image' => $_FILES['image']
                    );
        
                    $id = $this->ObjpubEspecial->insertPubEspecial($param);
                    if ($id) {
                        //$this->view = "pubSpecial\pubEspecialList";
                        return $this->list();
                    } else {
                        echo "Error al insertar la publicación.";
                    }
                } catch (PDOException $e) {
                    echo "Error al insertar la publicación: " . $e->getMessage();
                }
            }
        }

         /*editar publicacion */
         public function edit($id = null) {
            $this->view = 'pubSpecial\editPubEspecial';
            $_GET['response'] = false;
        
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $pubEspecial = $this->ObjpubEspecial->getPubEspecialById($id);
        
                if (isset($_POST['send'])) {
                    $_GET['response'] = true;
        
                    try {
                        $param = array();
        
                        if (isset($_POST['title'])) {
                            $param['title'] = $_POST['title'];
                        }
        
                        if (isset($_POST['description'])) {
                            $param['description'] = $_POST['description'];
                        }
        
                        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                            $param['image'] = $_FILES['image'];
                        }
        
                        if ($this->ObjpubEspecial->editPubEspecial($param, $id)) {
                            echo "Publicación actualizada correctamente.\n";
                            $this->view = "pubSpecial\pubEspecialList";
                            return $this->list();
                        } else {
                            echo "Error al actualizar la publicación.\n";
                        }
                    } catch (PDOException $e) {
                        echo "Error al actualizar la publicación: " . $e->getMessage() . "\n";
                    }
                }
        
                return $pubEspecial;
            }
        }

        public function status($id=null){

            if(isset($_GET['id'])){
                $id=$_GET['id'];
                /*$_GET['opc'] es una variable que controla que opcion e una condicional se va a realizar */
                $this->ObjpubEspecial->statusControl($id,$_GET['opc']);
                
            }
            
            if($_GET['opc'] === 'enable'){
                $this->view = 'pubSpecial/listPubEspecialDisable';
                return $this->ObjpubEspecial->getPubEspecialByStatus('disable');
            }else{
                return $this->ObjpubEspecial->getPubEspecialByStatus('enable');
            }
        }

    }

?>