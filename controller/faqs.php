<?php
require_once  'model/faq.php';

class faqsController{

    public $view;
    public $objFaq;
    public $objUserSession;
    public function __construct(){
     
        $this->view= 'faq/listFaq';
        $this->objFaq = new faq ;
        $this->objUserSession = new userSession;
        //$this->objUserSession->sessionAccessAdmin();
    }

    
    public function listFaq(){
      return $this->objFaq->getFaq();
    }

    /*Listar paquetes deshabilitados*/
    public function listFaqDisable(){
      $this->view= 'faq/listFaqDisable';
      return $this->objFaq->getFaqByStatus('disable');
  }


  public function addFaq(){
    $this->view= 'faq/addFaq';
    $_GET['response'] = false ;
    
    if( isset($_POST['query']) ){
      $_GET['response'] = true ;
      $this->objFaq->insertFaq($_POST);
    }
    
  }


  public function editFaq($id=null){
    $this->view='faq/editFaq';
		
    if(isset($_GET["id"])){

      $id = $_GET["id"];
		  return $this->objFaq->getFaqById($id);
      
    } 
  }


  public function saveFaq(){
    $this->view = 'faq/editFaq';
    if(isset($_POST['send'])){ 
      $this->objFaq->saveFaq($_POST);
    }
    return $this->objFaq->getFaqById($_POST['id']);  //------------Retorna el objeto modificado
	}

   /*habilitar e inhabilitar paqutes */
  public function status($id=null){
    
    if(isset($_GET['id']) /* && isset($_GET['opc']) */){
      $id = $_GET['id'];
      $opc  = $_GET['opc'];
  
      /*$_GET['opc'] es una variable que controla que opcion e una condicional se va a realizar */
      $this->objFaq->statusControl($id, $opc);
        
    }
    
    if($_GET['opc'] === 'enable'){
      $this->view = 'faq/listFaqDisable';
      return $this->objFaq->getFaqByStatus('disable');
    }else{
      return $this->objFaq->getFaqByStatus('enable');
    }
  }
}