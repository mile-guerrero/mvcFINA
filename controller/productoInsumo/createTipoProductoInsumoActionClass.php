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
               
        $this->validate($descripcion);

        $data = array(
            tipoProductoInsumoTableClass::DESCRIPCION=> $descripcion
            );
       tipoProductoInsumoTableClass::insert($data);
        routing::getInstance()->redirect('productoInsumo', 'indexTipoProductoInsumo');
      } else {
        routing::getInstance()->redirect('productoInsumo', 'indexTipoProductoInsumo');
      }
    } catch (PDOException $exc) {
      routing::getInstance()->redirect('productoInsumo', 'insertTipoProductoInsumo');
      session::getInstance()->setFlash('exc', $exc);
    }
  }

public function validate($descripcion) {

    $flag = false;
    if (strlen($descripcion) > tipoProductoInsumoTableClass::DESCRIPCION_LENGTH) {
      session::getInstance()->setError(i18n::__(00001, null, 'errors', array(':longitud' => tipoProductoInsumoTableClass::DESCRIPCION_LENGTH)), 00001);
      session::getInstance()->setFlash(tipoProductoInsumoTableClass::getNameField(tipoProductoInsumoTableClass::DESCRIPCION_LENGTH, true), true);
      
    }
    
    if (!preg_match("/^[a-z]+$/i", $descripcion)) {
      session::getInstance()->setError(i18n::__(00012, null, 'errors', array(':letras' => $descripcion)), 00012);
      $flag = true;
      session::getInstance()->setFlash(tipoProductoInsumoTableClass::getNameField(tipoProductoInsumoTableClass::DESCRIPCION, true), true);
      
    }

    if (strlen($descripcion) == "") {
      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => productoInsumoTableClass::DESCRIPCION)), 00009);
      $flag = true;
      session::getInstance()->setFlash(tipoProductoInsumoTableClass::getNameField(tipoProductoInsumoTableClass::DESCRIPCION, true), true);
      
    }
    
    if ($flag === true){
      request::getInstance()->setMethod('GET');
      routing::getInstance()->forward('productoInsumo', 'insertTipoProductoInsumo');
    }
  }

}
