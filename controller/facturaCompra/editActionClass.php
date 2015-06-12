
<?php
use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of ejemploClass
 *
 * @author 
 */
class editActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
   
      if (request::getInstance()->hasRequest(facturaCompraTableClass::ID)) {
        $fields = array(
            facturaCompraTableClass::ID,
            facturaCompraTableClass::FECHA
            
        );
        $where = array(
            facturaCompraTableClass::ID => request::getInstance()->getRequest(facturaCompraTableClass::ID)
        );
        $this->objFactura = facturaCompraTableClass::getAll($fields, false, null, null, null, null, $where);
        
//        $fields = array(
//            empresaTableClass::ID,
//            empresaTableClass::NOMBRE
//        );
//        $orderBy = array(
//            empresaTableClass::NOMBRE
//        );
//        $this->objEmpresa = empresaTableClass::getAll($fields, false, $orderBy, 'ASC');
        $this->defineView('edit', 'facturaCompra', session::getInstance()->getFormatOutput());
     
      }else{
        routing::getInstance()->redirect('facturaCompra', 'index');
      }

    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}

