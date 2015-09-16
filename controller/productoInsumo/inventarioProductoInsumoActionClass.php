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
class inventarioProductoInsumoActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      $fields = array(
          productoInsumoTableClass::ID,
          productoInsumoTableClass::DESCRIPCION,
          productoInsumoTableClass::TIPO_PRODUCTO_INSUMO_ID
      );
      
      $where= null;
       $where[] = '(' . productoInsumoTableClass::getNameField(productoInsumoTableClass::TIPO_PRODUCTO_INSUMO_ID) . ' BETWEEN ' . " 2 " . ' AND ' . "3" . ' ) ';             
      $this->objProducto = productoInsumoTableClass::getAll($fields, true, null, null, null, null, $where);
 
     
      $this->defineView('inventarioProductoInsumo', 'productoInsumo', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
}

}
