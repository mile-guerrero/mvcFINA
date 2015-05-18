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
class insertActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      $fields = array(
            empresaTableClass::ID,
            empresaTableClass::NOMBRE
        );
        $orderBy = array(
            empresaTableClass::NOMBRE
        );
        $this->objEmpresa = empresaTableClass::getAll($fields, false, $orderBy, 'ASC');
        
        $fields = array(
            proveedorTableClass::ID,
            proveedorTableClass::NOMBREP
        );
        $orderBy = array(
            proveedorTableClass::NOMBREP
        );
        $this->objProveedor = proveedorTableClass::getAll($fields, true, $orderBy, 'ASC');
        
        $fields = array(
            productoInsumoTableClass::ID,
            productoInsumoTableClass::DESCRIPCION
        );
        $orderBy = array(
            productoInsumoTableClass::DESCRIPCION
        );
        $this->objProducto = productoInsumoTableClass::getAll($fields, false, $orderBy, 'ASC');
      $this->defineView('insert', 'pedido', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
}

}
