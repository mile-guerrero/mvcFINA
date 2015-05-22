<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\tipoProductoInsumoValidatorClass as validator;
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
               
        validator::validateInsert();
//        $this->validate($descripcion);

        $data = array(
            tipoProductoInsumoTableClass::DESCRIPCION=> $descripcion
            );
       tipoProductoInsumoTableClass::insert($data);
       session::getInstance()->setSuccess('El Registro Fue Exitoso ');
        routing::getInstance()->redirect('productoInsumo', 'indexTipoProductoInsumo');
      } else {
        routing::getInstance()->redirect('productoInsumo', 'indexTipoProductoInsumo');
      }
    } catch (PDOException $exc) {
      routing::getInstance()->redirect('productoInsumo', 'insertTipoProductoInsumo');
      session::getInstance()->setFlash('exc', $exc);
    }
  }

//public function validate($descripcion) {
//
//    $flag = false;
//    if (strlen($descripcion) > tipoProductoInsumoTableClass::DESCRIPCION_LENGTH) {
//      session::getInstance()->setError(i18n::__(00004, null, 'errors', array(':longitud' => tipoProductoInsumoTableClass::DESCRIPCION_LENGTH)), 00004);
//      $flag = true;
//    }
//    
//    $patron = "/^[a-z]+$/i";
//  
//  if (!preg_match($patron, $descripcion)) {
//      session::getInstance()->setError(i18n::__(00012, null, 'errors', array(':no permite letras' => tipoProductoInsumoTableClass::DESCRIPCION)), 00012);
//      $flag = true;
//       }
//
//    if (strlen($descripcion) == "" or $descripcion === null) {
//      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => productoInsumoTableClass::DESCRIPCION)), 00009);
//      $flag = true;
//      }
//    
//    if ($flag === true){
//      request::getInstance()->setMethod('GET');
//      routing::getInstance()->forward('productoInsumo', 'insertTipoProductoInsumo');
//    }
//  }

}
