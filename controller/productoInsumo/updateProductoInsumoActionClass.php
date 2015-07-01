  
<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\productoInsumoValidatorClass as validator;
use hook\log\logHookClass as log;

/**
 * Description of ejemploClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class updateProductoInsumoActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {
        $id = request::getInstance()->getPost(productoInsumoTableClass::getNameField(productoInsumoTableClass::ID, true));
        $descripcion = request::getInstance()->getPost(productoInsumoTableClass::getNameField(productoInsumoTableClass::DESCRIPCION, true));
        $iva = request::getInstance()->getPost(productoInsumoTableClass::getNameField(productoInsumoTableClass::IVA, true));
        $cantidad = request::getInstance()->getPost(productoInsumoTableClass::getNameField(productoInsumoTableClass::CANTIDAD, true));
        $unidad = request::getInstance()->getPost(productoInsumoTableClass::getNameField(productoInsumoTableClass::UNIDAD_MEDIDA_ID, true));
        $tipo = request::getInstance()->getPost(productoInsumoTableClass::getNameField(productoInsumoTableClass::TIPO_PRODUCTO_INSUMO_ID, true));
        
         validator::validateEdit();
//        $this->validate($descripcion, $iva);
        $ids = array(
            productoInsumoTableClass::ID => $id
        );
        $data = array(
            productoInsumoTableClass::DESCRIPCION => $descripcion,
            productoInsumoTableClass::IVA => $iva,
            productoInsumoTableClass::CANTIDAD => $cantidad,
            productoInsumoTableClass::UNIDAD_MEDIDA_ID => $unidad,
            productoInsumoTableClass::TIPO_PRODUCTO_INSUMO_ID => $tipo
        );
        productoInsumoTableClass::update($ids, $data);
        session::getInstance()->setSuccess('La Actualizacion Fue Exitoso');
        $observacion ='se ha modificado el producto insumo';
        log::register('Modificar', productoInsumoTableClass::getNameTable(),$observacion,$id);
        routing::getInstance()->redirect('productoInsumo', 'indexProductoInsumo');
        
      }
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }
  
  
//  public function validate($descripcion, $iva) {
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
//     if ($flag === true){
//    request::getInstance()->setMethod('GET');
//    request::getInstance()->addParamGet(array(productoInsumoTableClass::ID => request::getInstance()->getPost(productoInsumoTableClass::getNameField(productoInsumoTableClass::ID, true))));
//    routing::getInstance()->forward('productoInsumo', 'editProductoInsumo');
//    
//  }
//}

}
