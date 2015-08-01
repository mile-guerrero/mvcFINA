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
class verActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      $fields = array(
          facturaVentaTableClass::ID,
          facturaVentaTableClass::FECHA,
          facturaVentaTableClass::CLIENTE_ID,
          facturaVentaTableClass::TRABAJADOR_ID,
          facturaVentaTableClass::CREATED_AT,
          facturaVentaTableClass::UPDATED_AT
      );
      
       $where = array(
            facturaVentaTableClass::ID => request::getInstance()->getRequest(facturaVentaTableClass::ID)
        );
      $this->objFactura = facturaVentaTableClass::getAll($fields, false, null, null, null, null, $where);
//     $orderBy = array(
//         usuarioTableClass::ID
//      );
//      $this->objUsuarios = usuarioTableClass::getAll($fields, true, $orderBy);

      $this->defineView('ver', 'facturaVenta', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
}

}
