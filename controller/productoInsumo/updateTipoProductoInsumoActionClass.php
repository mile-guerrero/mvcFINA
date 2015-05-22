
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
class updateTipoProductoInsumoActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {
        $id = request::getInstance()->getPost(tipoProductoInsumoTableClass::getNameField(tipoProductoInsumoTableClass::ID, true));
        $descripcion = request::getInstance()->getPost(tipoProductoInsumoTableClass::getNameField(tipoProductoInsumoTableClass::DESCRIPCION, true));
        
         validator::validateEdit();
//          $this->validate($descripcion);
           $ids = array(
            tipoProductoInsumoTableClass::ID => $id
        );
        $data = array(
            tipoProductoInsumoTableClass::DESCRIPCION => $descripcion,
        );
        tipoProductoInsumoTableClass::update($ids, $data);
        session::getInstance()->setSuccess('La Actualizacion Fue Exitoso');
        routing::getInstance()->redirect('productoInsumo', 'indexTipoProductoInsumo');
      }

    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
     
    }
  }
//public function validate($descripcion){
//
//    $flag = false;  
//
////-----------------validaciones de numero---------------------------------------
//          if (strlen($descripcion) > tipoProductoInsumoTableClass::DESCRIPCION_LENGTH) {
//      session::getInstance()->setError(i18n::__(00004, null, 'errors', array(':longitud' =>tipoProductoInsumoTableClass::DESCRIPCION_LENGTH)), 00004);
//      $flag = true;
//      } 
//      
//      $patron = "/^[a-z]+$/i";
//  
//  if (!preg_match($patron, $descripcion)) {
//      session::getInstance()->setError(i18n::__(00012, null, 'errors', array(':no permite letras' => tipoProductoInsumoTableClass::DESCRIPCION)), 00012);
//      $flag = true;
//       }
//      
////-----------------confirmacion de validacion-----------------------------------    
//     if ($flag === true){
//    request::getInstance()->setMethod('GET');
//    request::getInstance()->addParamGet(array(tipoProductoInsumoTableClass::ID => request::getInstance()->getPost(tipoProductoInsumoTableClass::getNameField(tipoProductoInsumoTableClass::ID, true))));
//    routing::getInstance()->forward('productoInsumo', 'editTipoProductoInsumo');
//    
//  }
//}
}
