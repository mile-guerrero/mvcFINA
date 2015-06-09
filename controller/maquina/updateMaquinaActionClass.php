
<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\maquinaValidatorClass as validator;
use hook\log\logHookClass as log;
/**
 * Description of ejemploClass
 *
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
 */
class updateMaquinaActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {
        $id = request::getInstance()->getPost(maquinaTableClass::getNameField(maquinaTableClass::ID, true));
        $nombre = request::getInstance()->getPost(maquinaTableClass::getNameField(maquinaTableClass::NOMBRE, true));
        $descripcion = request::getInstance()->getPost(maquinaTableClass::getNameField(maquinaTableClass::DESCRIPCION, true));
        $tipo = request::getInstance()->getPost(maquinaTableClass::getNameField(maquinaTableClass::TIPO_USO_ID, true));
        $origen = request::getInstance()->getPost(maquinaTableClass::getNameField(maquinaTableClass::ORIGEN_MAQUINA, true));
        $proveedor = request::getInstance()->getPost(maquinaTableClass::getNameField(maquinaTableClass::PROVEEDOR_ID, true));
      
        validator::validateEdit();
//        $this->validate($nombre, $descripcion, $origen);
        $ids = array(
            maquinaTableClass::ID => $id
        );
        $data = array(
            maquinaTableClass::NOMBRE => $nombre,
            maquinaTableClass::DESCRIPCION => $descripcion,
            maquinaTableClass::ORIGEN_MAQUINA => $origen,
            maquinaTableClass::TIPO_USO_ID => $tipo,
            maquinaTableClass::PROVEEDOR_ID => $proveedor,
        );
        maquinaTableClass::update($ids, $data);
         session::getInstance()->setSuccess('La actualizacion fue correcta'); 
         $observacion ='se ha modificado la maquina';
        log::register('Modificar', maquinaTableClass::getNameTable(),$observacion,$id);
        routing::getInstance()->redirect('maquina', 'indexMaquina');
      }
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

//  public function validate($nombre, $descripcion, $origen){
//
//    $flag = false;
//    $patron1 = "/^[a-z]+$/i";
//
////------------------validaciones de nombre--------------------------------------
//    if (strlen($nombre) > maquinaTableClass::NOMBRE_LENGTH) {
//      session::getInstance()->setError(i18n::__(00007, null, 'errors', array(':longitud' => maquinaTableClass::NOMBRE_LENGTH)), 00007);
//      $flag = true;
//    }
//    
//    if (strlen($nombre) == null or $nombre === "") {
//      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => maquinaTableClass::NOMBRE)), 00009);
//      $flag = true;
//       }
//     
////-----------------validaciones de descripcion----------------------------------
//    if (strlen($descripcion) > maquinaTableClass::DESCRIPCION_LENGTH) {
//      session::getInstance()->setError(i18n::__(00004, null, 'errors', array(':longitud' => maquinaTableClass::DESCRIPCION_LENGTH)), 00004);
//      $flag = true;
//    }
//    
//    if (strlen($descripcion) == null or $descripcion === "") {
//      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => maquinaTableClass::DESCRIPCION)), 00009);
//      $flag = true;
//       }
//  
////-----------------validaciones de origen---------------------------------------
//    if (strlen($origen) > maquinaTableClass::ORIGEN_MAQUINA_LENGTH) {
//      session::getInstance()->setError(i18n::__(00015, null, 'errors', array(':longitud' => maquinaTableClass::ORIGEN_MAQUINA_LENGTH)), 00015);
//      $flag = true;
//    }
//    
//    if (strlen($origen) == null or $origen === "") {
//      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => maquinaTableClass::ORIGEN_MAQUINA)), 00009);
//      $flag = true;
//  }
//  
//  if (!preg_match($patron1, $origen)){         
//      session::getInstance()->setError(i18n::__(00012, null, 'errors', array(':letras' => maquinaTableClass::ORIGEN_MAQUINA)), 00012);
//      $flag = true;
//      }
//
////-----------------respuesta a error--------------------------------------------
//   
//    if ($flag === true) {
//      request::getInstance()->setMethod('GET');
//      request::getInstance()->addParamGet(array(maquinaTableClass::ID => request::getInstance()->getPost(maquinaTableClass::getNameField(maquinaTableClass::ID, true))));
//      routing::getInstance()->forward('maquina', 'editMaquina');
//    }
//}
//  
}