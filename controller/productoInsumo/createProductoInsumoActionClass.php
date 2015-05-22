<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\productoInsumoValidatorClass as validator;
/**
 * Description of ejemploClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class createProductoInsumoActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $descripcion = request::getInstance()->getPost(productoInsumoTableClass::getNameField(productoInsumoTableClass::DESCRIPCION, true));
        $iva = request::getInstance()->getPost(productoInsumoTableClass::getNameField(productoInsumoTableClass::IVA, true));
        $unidad = request::getInstance()->getPost(productoInsumoTableClass::getNameField(productoInsumoTableClass::UNIDAD_MEDIDA_ID, true));
        $tipo = request::getInstance()->getPost(productoInsumoTableClass::getNameField(productoInsumoTableClass::TIPO_PRODUCTO_INSUMO_ID, true));

        
        validator::validateInsert();
//        $this->validate($descripcion, $iva);

        $data = array(
             productoInsumoTableClass::DESCRIPCION => $descripcion,
             productoInsumoTableClass::IVA => $iva,
             productoInsumoTableClass::UNIDAD_MEDIDA_ID => $unidad,
             productoInsumoTableClass::TIPO_PRODUCTO_INSUMO_ID => $tipo
        );
         productoInsumoTableClass::insert($data);
         session::getInstance()->setSuccess('El Registro Fue Exitoso ');
        routing::getInstance()->redirect('productoInsumo', 'indexProductoInsumo');
      } else {
        routing::getInstance()->redirect('productoInsumo', 'indexProductoInsumo');
      }
    } catch (PDOException $exc) {
      routing::getInstance()->redirect('productoInsumo', 'insertProductoInsumo');
      session::getInstance()->setFlash('exc', $exc);
    }
  }
  
//public function validate($descripcion, $iva) {
//
//    $flag = false;
//    $patron = "/^[[:digit:]]+$/";
////---------------------validacion descripcion----------------------------------- 
//    
//    if (strlen($descripcion) > productoInsumoTableClass::DESCRIPCION_LENGTH) {
//      session::getInstance()->setError(i18n::__(00004, null, 'errors', array(':longitud' => productoInsumoTableClass::DESCRIPCION_LENGTH)), 00004);
//      $flag = true;
//    }   
//    
//
//    if (strlen($descripcion) == "" or $iva === null) {
//      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => productoInsumoTableClass::DESCRIPCION)), 00009);
//      $flag = true;
//    }
////-----------------------validacion iva-----------------------------------------    
//     if (!is_numeric($iva) === "" or $iva === null) {
//      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => productoInsumoTableClass::IVA)), 00009);
//      $flag = true;
//    }
//    
//    if (strlen($iva) > productoInsumoTableClass::IVA_LENGTH) {
//      session::getInstance()->setError(i18n::__(00014, null, 'errors', array(':longitud' => productoInsumoTableClass::IVA_LENGTH)), 00014);
//      $flag = true;
//    } 
//
//    if (!preg_match($patron, $iva)) {
//      session::getInstance()->setError(i18n::__(00010, null, 'errors', array(':no permite letras' => productoInsumoTableClass::IVA)), 00010);
//      $flag = true;
//       }
////-----------------------validacion --------------------------------------------    
//    if ($flag === true){
//      request::getInstance()->setMethod('GET');
//      routing::getInstance()->forward('productoInsumo', 'insertProductoInsumo');
//    }
//  }

}
