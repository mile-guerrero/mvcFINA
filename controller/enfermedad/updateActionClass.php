
<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\enfermedadValidatorClass as validator;
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
* @return   enfermedadTableClass::NOMBRE retorna $nombre (string),
            enfermedadTableClass::APELLIDO retorna $apellido (string),
            enfermedadTableClass::DOCUMENTO retorna $documento (integer)
 * estos datos retornan en la variable $data y el $id retorna en la variable $ids
*/
  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {
        $id = request::getInstance()->getPost(enfermedadTableClass::getNameField(enfermedadTableClass::ID, true));
        $nombre = request::getInstance()->getPost(enfermedadTableClass::getNameField(enfermedadTableClass::NOMBRE, true));
        $descripcion = request::getInstance()->getPost(enfermedadTableClass::getNameField(enfermedadTableClass::DESCRIPCION, true));
        $tratamiento = request::getInstance()->getPost(enfermedadTableClass::getNameField(enfermedadTableClass::TRATAMIENTO, true));
        
        validator::validateEdit();
         
        $ids = array(
            enfermedadTableClass::ID => $id
        );
        $data = array(
            enfermedadTableClass::NOMBRE => $nombre,
            enfermedadTableClass::DESCRIPCION => $descripcion,
            enfermedadTableClass::TRATAMIENTO => $tratamiento
        );
          enfermedadTableClass::update($ids, $data);
        
         session::getInstance()->setSuccess('La actualizacion fue correcta');
         $observacion ='se ha modificado la enfermedad';
        log::register('Modificar', enfermedadTableClass::getNameTable(),$observacion,$id);
        routing::getInstance()->redirect('enfermedad', 'index');
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
// if (strlen($documento) > enfermedadTableClass::DOCUMENTO_LENGTH) {
//      session::getInstance()->setError(i18n::__(00015, null, 'errors', array(':longitud' => enfermedadTableClass::DOCUMENTO_LENGTH)), 00015);
//      $flag = true;
//     }
// if (strlen($documento) == null or $documento === "") {
//      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => enfermedadTableClass::DOCUMENTO)), 00009);
//      $flag = true;
//     }
//if (!preg_match($soloNumeros, $documento)) {
//      session::getInstance()->setError(i18n::__(00010, null, 'errors', array(':no permite letras' => enfermedadTableClass::DOCUMENTO)), 00010);
//      $flag = true;
//       }      
//    
////---------------------validacion nombre----------------------------------------     
//    if (strlen($nombre) > enfermedadTableClass::NOMBRE_LENGTH) {
//      session::getInstance()->setError(i18n::__(00001, null, 'errors', array(':longitud' => enfermedadTableClass::NOMBRE_LENGTH)), 00001);
//      $flag = true;
//      }
//
//    if (strlen($nombre)  == null or $nombre === "") {
//      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => enfermedadTableClass::NOMBRE)), 00009);
//      $flag = true;
//     }
//     
//    
//    if (!preg_match($soloLetras, $nombre)) {
//       session::getInstance()->setError(i18n::__(00012, null, 'errors', array(':no permite letras' => enfermedadTableClass::NOMBRE)), 00012);
//       $flag = true;
//       }
//      
////---------------------validacion apellido--------------------------------------  
//    if (strlen($apellido) > enfermedadTableClass::APELLIDO_LENGTH) {
//      session::getInstance()->setError(i18n::__(00002, null, 'errors', array(':longitud' => enfermedadTableClass::APELLIDO_LENGTH)), 00002);
//      $flag = true;
//     }
//    
//     if (strlen($apellido) == null or $apellido === "") {
//      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => enfermedadTableClass::APELLIDO)), 00009);
//      $flag = true;
//     }
//     
//    if (!preg_match($soloLetras, $apellido)) {
//       session::getInstance()->setError(i18n::__(00012, null, 'errors', array(':no permite letras' => enfermedadTableClass::APELLIDO)), 00012);
//       $flag = true;
//       }
////---------------------validacion direccion-------------------------------------
//     if (strlen($direccion) > enfermedadTableClass::DIRECCION_LENGTH) {
//      session::getInstance()->setError(i18n::__(00002, null, 'errors', array(':longitud' => enfermedadTableClass::DIRECCION_LENGTH)), 00002);
//      $flag = true;
//     }
//     
//     if (strlen($direccion)  == null or $direccion === "") {
//      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => enfermedadTableClass::DIRECCION)), 00009);
//      $flag = true;
//     }
// 
////-------------------validacion de telefono-------------------------------------
//  if (strlen($telefono) > enfermedadTableClass::TELEFONO_LENGTH) {
//      session::getInstance()->setError(i18n::__(00014, null, 'errors', array(':longitud' => enfermedadTableClass::TELEFONO_LENGTH)), 00014);
//      $flag = true;
//     }
//  if (strlen($telefono) == null or $telefono === "") {
//      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => enfermedadTableClass::TELEFONO)), 00009);
//      $flag = true;
//     }
// if (!preg_match($soloNumeros, $telefono)) {
//      session::getInstance()->setError(i18n::__(00016, null, 'errors', array(':no permite letras' => enfermedadTableClass::TELEFONO)), 00016);
//      $flag = true;
//       }
//
////-------------------validacion ------------------------------------------------
//    if ($flag === true){
//    request::getInstance()->setMethod('GET');
//    request::getInstance()->addParamGet(array(enfermedadTableClass::ID => request::getInstance()->getPost(enfermedadTableClass::getNameField(enfermedadTableClass::ID, true))));
//    routing::getInstance()->forward('cliente', 'editCliente');
//  }
//  }

