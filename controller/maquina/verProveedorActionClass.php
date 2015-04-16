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
class verProveedorActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      $fields = array(
          proveedorTableClass::ID,
          proveedorTableClass::NOMBREP,
          proveedorTableClass::APELLIDO,
          proveedorTableClass::DOCUMENTO,
          proveedorTableClass::DIRECCION,
          proveedorTableClass::TELEFONO,
          proveedorTableClass::EMAIL,
          proveedorTableClass::ID_CIUDAD,
          proveedorTableClass::CREATED_AT,
          proveedorTableClass::UPDATED_AT
      );
      
       $where = array(
            proveedorTableClass::ID => request::getInstance()->getRequest(proveedorTableClass::ID)
        );
      $this->objProveedor = proveedorTableClass::getAll($fields, true, null, null, null, null, $where);
      
     
      $this->defineView('verProveedor', 'maquina', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
}

}
