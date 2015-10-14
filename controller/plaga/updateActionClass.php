
<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\plagaValidatorClass as validator;
use hook\log\logHookClass as log;
/**
* @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon 
* @date: fecha de inicio del desarrollo.
* @category: modulo de cliente.
*/
class updateActionClass extends controllerClass implements controllerActionInterface {

  /**
* @author: Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon .
* @date: fecha de inicio del desarrollo.
* @return   plagaTableClass::NOMBRE retorna $nombre (string),
            plagaTableClass::APELLIDO retorna $apellido (string),
            plagaTableClass::DOCUMENTO retorna $documento (integer)
 * estos datos retornan en la variable $data y el $id retorna en la variable $ids
*/
  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {
        $id = request::getInstance()->getPost(plagaTableClass::getNameField(plagaTableClass::ID, true));
        $nombre = request::getInstance()->getPost(plagaTableClass::getNameField(plagaTableClass::NOMBRE, true));
        $descripcion = request::getInstance()->getPost(plagaTableClass::getNameField(plagaTableClass::DESCRIPCION, true));
        $tratamiento = request::getInstance()->getPost(plagaTableClass::getNameField(plagaTableClass::TRATAMIENTO, true));
        
        validator::validateEdit();
         
        $ids = array(
            plagaTableClass::ID => $id
        );
        $data = array(
            plagaTableClass::NOMBRE => $nombre,
            plagaTableClass::DESCRIPCION => $descripcion,
            plagaTableClass::TRATAMIENTO => $tratamiento
        );
          plagaTableClass::update($ids, $data);
        
         session::getInstance()->setSuccess('La actualizacion fue correcta');
         $observacion ='se ha modificado la plaga';
        log::register('Modificar', plagaTableClass::getNameTable(),$observacion,$id);
        routing::getInstance()->redirect('plaga', 'index');
      }//cierre del if

    }//cierre del try
     catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
     }//cierre del catch
  }//cierre de la funcion execute
}//cierre de la clase
//public function validate($nombre, $apellido, $documento, $direccion, $telefono) {
//
//    $flag = false;
//    $soloNumeros = "/^[[:digit:]]+$/";
//    $soloLetras = "/^[a-z]+$/i";
//    $soloTelefono = "/[0-9](9)$/";
//    $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';
// 
////---------------------validacion documento-------------------------------------
// if (strlen($documento) > plagaTableClass::DOCUMENTO_LENGTH) {
//      session::getInstance()->setError(i18n::__(00015, null, 'errors', array(':longitud' => plagaTableClass::DOCUMENTO_LENGTH)), 00015);
//      $flag = true;
//     }
// if (strlen($documento) == null or $documento === "") {
//      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => plagaTableClass::DOCUMENTO)), 00009);
//      $flag = true;
//     }
//if (!preg_match($soloNumeros, $documento)) {
//      session::getInstance()->setError(i18n::__(00010, null, 'errors', array(':no permite letras' => plagaTableClass::DOCUMENTO)), 00010);
//      $flag = true;
//       }      
//    
////---------------------validacion nombre----------------------------------------     
//    if (strlen($nombre) > plagaTableClass::NOMBRE_LENGTH) {
//      session::getInstance()->setError(i18n::__(00001, null, 'errors', array(':longitud' => plagaTableClass::NOMBRE_LENGTH)), 00001);
//      $flag = true;
//      }
//
//    if (strlen($nombre)  == null or $nombre === "") {
//      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => plagaTableClass::NOMBRE)), 00009);
//      $flag = true;
//     }
//     
//    
//    if (!preg_match($soloLetras, $nombre)) {
//       session::getInstance()->setError(i18n::__(00012, null, 'errors', array(':no permite letras' => plagaTableClass::NOMBRE)), 00012);
//       $flag = true;
//       }
//      
////---------------------validacion apellido--------------------------------------  
//    if (strlen($apellido) > plagaTableClass::APELLIDO_LENGTH) {
//      session::getInstance()->setError(i18n::__(00002, null, 'errors', array(':longitud' => plagaTableClass::APELLIDO_LENGTH)), 00002);
//      $flag = true;
//     }
//    
//     if (strlen($apellido) == null or $apellido === "") {
//      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => plagaTableClass::APELLIDO)), 00009);
//      $flag = true;
//     }
//     
//    if (!preg_match($soloLetras, $apellido)) {
//       session::getInstance()->setError(i18n::__(00012, null, 'errors', array(':no permite letras' => plagaTableClass::APELLIDO)), 00012);
//       $flag = true;
//       }
////---------------------validacion direccion-------------------------------------
//     if (strlen($direccion) > plagaTableClass::DIRECCION_LENGTH) {
//      session::getInstance()->setError(i18n::__(00002, null, 'errors', array(':longitud' => plagaTableClass::DIRECCION_LENGTH)), 00002);
//      $flag = true;
//     }
//     
//     if (strlen($direccion)  == null or $direccion === "") {
//      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => plagaTableClass::DIRECCION)), 00009);
//      $flag = true;
//     }
// 
////-------------------validacion de telefono-------------------------------------
//  if (strlen($telefono) > plagaTableClass::TELEFONO_LENGTH) {
//      session::getInstance()->setError(i18n::__(00014, null, 'errors', array(':longitud' => plagaTableClass::TELEFONO_LENGTH)), 00014);
//      $flag = true;
//     }
//  if (strlen($telefono) == null or $telefono === "") {
//      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => plagaTableClass::TELEFONO)), 00009);
//      $flag = true;
//     }
// if (!preg_match($soloNumeros, $telefono)) {
//      session::getInstance()->setError(i18n::__(00016, null, 'errors', array(':no permite letras' => plagaTableClass::TELEFONO)), 00016);
//      $flag = true;
//       }
//
////-------------------validacion ------------------------------------------------
//    if ($flag === true){
//    request::getInstance()->setMethod('GET');
//    request::getInstance()->addParamGet(array(plagaTableClass::ID => request::getInstance()->getPost(plagaTableClass::getNameField(plagaTableClass::ID, true))));
//    routing::getInstance()->forward('cliente', 'editCliente');
//  }
//  }

