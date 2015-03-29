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
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
 */
class insertProductoInsumoActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {      
      $fields = array(
      unidadMedidaTableClass::ID,
      unidadMedidaTableClass::DESCRIPCION
      );
      $orderBy = array(
      unidadMedidaTableClass::DESCRIPCION   
      );      
      $this->objPIUM = unidadMedidaTableClass::getAll($fields,true, $orderBy, 'ASC');
      
      $fields = array(     
      tipoProductoInsumoTableClass::ID, 
      tipoProductoInsumoTableClass::DESCRIPCION
      );
      $orderBy = array(
      tipoProductoInsumoTableClass::DESCRIPCION    
      ); 
      $this->objPITPI = tipoProductoInsumoTableClass::getAll($fields, true, $orderBy, 'ASC');

      $this->defineView('insertProductoInsumo', 'productoInsumo', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
}

}
