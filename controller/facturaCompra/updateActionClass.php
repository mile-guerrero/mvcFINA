
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
class updateActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {
        $id = request::getInstance()->getPost(facturaCompraTableClass::getNameField(facturaCompraTableClass::ID, true));
        $fecha = request::getInstance()->getPost(facturaCompraTableClass::getNameField(facturaCompraTableClass::FECHA, true));

        $ids = array(
            facturaCompraTableClass::ID => $id
        );
        $data = array(
            facturaCompraTableClass::FECHA => $fecha
            
            
        );
        facturaCompraTableClass::update($ids, $data);
         
        routing::getInstance()->redirect('facturaCompra', 'index');
      }
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}

