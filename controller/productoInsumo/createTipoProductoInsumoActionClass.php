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
class createTipoProductoInsumoActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $descripcion = request::getInstance()->getPost(tipoProductoInsumoTableClass::getNameField(tipoProductoInsumoTableClass::DESCRIPCION, true));
        
    if (strlen($descripcion) > tipoProductoInsumoTableClass::DESCRIPCION_LENGTH) {
         session::getInstance()->setError(i18n::__(00004, null, 'errors', array(':longitud' => tipoProductoInsumoTableClass::DESCRIPCION_LENGTH)), 00004);
        routing::getInstance()->redirect('productoInsumo', 'insertTipoProductoInsumo');
         
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
