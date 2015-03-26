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
class createTipoProductoInsumoActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $descripcion = request::getInstance()->getPost(tipoProductoInsumoTableClass::getNameField(tipoProductoInsumoTableClass::DESCRIPCION, true));
        
        if (strlen($descripcion) > tipoProductoInsumoTableClass::DESCRIPCION_LENGTH) {
          throw new PDOException(i18n::__(00001, null, 'errors', array(':longitud' => tipoProductoInsumoTableClass::DESCRIPCION_LENGTH)), 00001);
        }

        $data = array(
            tipoProductoInsumoTableClass::DESCRIPCION=> $descripcion
            );
       tipoProductoInsumoTableClass::insert($data);
        routing::getInstance()->redirect('productoInsumo', 'indexTipoProductoInsumo');
      } else {
        routing::getInstance()->redirect('productoInsumo', 'indexTipoProductoInsumo');
      }
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}
