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
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class deleteSelectProveedorActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {
        $idsToDelete = request::getInstance()->getPost('chk');
        foreach ($idsToDelete as $id){
          $ids = array(
              proveedorTableClass::ID => $id
        );
        
        proveedorTableClass::delete($ids, true);
      }
        routing::getInstance()->redirect('maquina', 'indexProveedor');
      } else {
        routing::getInstance()->redirect('maquina', 'indexProveedor');
      }
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
//    switch ($exc->getCode()){
//        case 23503:
//          session::getInstance()->setError('Las Casillas Seleccionadas no se pueden borrar por que esta siendo utilizado');
//          routing::getInstance()->redirect('maquina', 'indexProveedor');
//          break;
//          case 00000:
//          break;
//      }
      
    }
  }

}

