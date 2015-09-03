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
class verProductoInsumoActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      $fields = array(
          productoInsumoTableClass::ID,
          productoInsumoTableClass::DESCRIPCION,
          productoInsumoTableClass::NOMBRE_IMAGEN,
          productoInsumoTableClass::EXTENCION_IMAGEN,
          productoInsumoTableClass::HASH_IMAGEN,
          productoInsumoTableClass::TIPO_PRODUCTO_INSUMO_ID,
          productoInsumoTableClass::INFORMACION,
          productoInsumoTableClass::CREATED_AT,
          productoInsumoTableClass::UPDATED_AT
      );
      
       $where = array(
            productoInsumoTableClass::ID => request::getInstance()->getRequest(productoInsumoTableClass::ID)
        );
      $this->objPI = productoInsumoTableClass::getAll($fields, true, null, null, null, null, $where);
 
     
      $this->defineView('verProductoInsumo', 'productoInsumo', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
}

}
