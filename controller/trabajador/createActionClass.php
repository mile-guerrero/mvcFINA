<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\trabajadorValidatorClass as validator;

/**
 * Description of ejemploClass
 *
 * @author Andres Eduardo Bahamon, Elcy Milena Gerrero, Gonzalo Andres Bejarano
 */
class createActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        
        $documento = request::getInstance()->getPost(trabajadorTableClass::getNameField(trabajadorTableClass::DOCUMENTO, true));
        $nombre = request::getInstance()->getPost(trabajadorTableClass::getNameField(trabajadorTableClass::NOMBRET, true));
        $apellido = request::getInstance()->getPost(trabajadorTableClass::getNameField(trabajadorTableClass::APELLIDO, true));
        $direccion = request::getInstance()->getPost(trabajadorTableClass::getNameField(trabajadorTableClass::DIRECCION, true));
        $telefono = request::getInstance()->getPost(trabajadorTableClass::getNameField(trabajadorTableClass::TELEFONO, true));
        $email = request::getInstance()->getPost(trabajadorTableClass::getNameField(trabajadorTableClass::EMAIL, true));
        $idTipo = request::getInstance()->getPost(trabajadorTableClass::getNameField(trabajadorTableClass::ID_TIPO_ID, true));
        $idCiudad = request::getInstance()->getPost(trabajadorTableClass::getNameField(trabajadorTableClass::ID_CIUDAD, true));
        $idCredencial = request::getInstance()->getPost(trabajadorTableClass::getNameField(trabajadorTableClass::ID_CREDENCIAL, true));
        
        validator::validateInsert();
//        $this->validate($documento, $nombre, $apellido, $direccion, $telefono, $email);


        $data = array(
            trabajadorTableClass::DOCUMENTO => $documento,
            trabajadorTableClass::NOMBRET => $nombre,
            trabajadorTableClass::APELLIDO => $apellido,
            trabajadorTableClass::DIRECCION => $direccion,
            trabajadorTableClass::TELEFONO => $telefono,
            trabajadorTableClass::EMAIL => $email,
            trabajadorTableClass::ID_TIPO_ID => $idTipo,
            trabajadorTableClass::ID_CIUDAD => $idCiudad,
            trabajadorTableClass::ID_CREDENCIAL => $idCredencial
        );
        trabajadorTableClass::insert($data);
        session::getInstance()->setSuccess('El registro fue Exitoso');
        routing::getInstance()->redirect('trabajador', 'index');
      } else {
        routing::getInstance()->redirect('trabajador', 'index');
      }
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }
//public function validate($documento, $nombre, $apellido, $direccion, $telefono, $email){
//
//    $flag = false;
//    $soloNumeros = "/^[[:digit:]]+$/";
//    $soloLetras = "/^[a-z]+$/i";
//    $soloTelefono = "/[0-9](9)$/";
//    $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';
////------------------validaciones de documento-----------------------------------
//    if (strlen($documento) > trabajadorTableClass::DOCUMENTO_LENGTH) {
//      session::getInstance()->setError(i18n::__(00005, null, 'errors', array(':longitud' => trabajadorTableClass::DOCUMENTO_LENGTH)), 00005);
//      $flag = true;
//    }
//    
//    if (strlen($documento) == null or $documento === "") {
//      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => trabajadorTableClass::DOCUMENTO)), 00009);
//      $flag = true;
//       }
//       
//    if (!preg_match($soloNumeros, $documento)) {
//      session::getInstance()->setError(i18n::__(00010, null, 'errors', array(':no permite letras' => trabajadorTableClass::DOCUMENTO)), 00010);
//      $flag = true;
//       }   
//     
////-----------------validaciones de nombre---------------------------------------
//    if (strlen($nombre) > trabajadorTableClass::NOMBRET_LENGTH) {
//      session::getInstance()->setError(i18n::__(00006, null, 'errors', array(':longitud' => trabajadorTableClass::NOMBRET_LENGTH)), 00006);
//      $flag = true;
//    }
//    
//    if (strlen($nombre) == null or $nombre === "") {
//      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => trabajadorTableClass::NOMBRET)), 00009);
//      $flag = true;
//       }
//       
//     if (!preg_match($soloLetras, $nombre)) {
//       session::getInstance()->setError(i18n::__(00012, null, 'errors', array(':no permite letras' => trabajadorTableClass::NOMBRET)), 00012);
//       $flag = true;
//       }
////-----------------validaciones de apellido----------------------------------
//    if (strlen($apellido) > trabajadorTableClass::APELLIDO_LENGTH) {
//      session::getInstance()->setError(i18n::__(00004, null, 'errors', array(':longitud' => trabajadorTableClass::APELLIDO_LENGTH)), 00004);
//      $flag = true;
//    }
//    
//    if (strlen($apellido) == null or $apellido === "") {
//      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => trabajadorTableClass::APELLIDO)), 00009);
//      $flag = true;
//  }
//  
//  if (!preg_match($soloLetras, $apellido)) {
//       session::getInstance()->setError(i18n::__(00012, null, 'errors', array(':no permite letras' => trabajadorTableClass::APELLIDO)), 00012);
//       $flag = true;
//       }
//  
////-----------------validaciones de direccion----------------------------------
//    if (strlen($direccion) > trabajadorTableClass::DIRECCION_LENGTH) {
//      session::getInstance()->setError(i18n::__(00004, null, 'errors', array(':longitud' => trabajadorTableClass::DIRECCION_LENGTH)), 00004);
//      $flag = true;
//    }
//    
//    if (strlen($direccion) == null or $direccion === "") {
//      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => trabajadorTableClass::DIRECCION)), 00009);
//      $flag = true;
//  }
//  
////-----------------validaciones de telefono----------------------------------
//    if (strlen($telefono) > trabajadorTableClass::TELEFONO_LENGTH) {
//      session::getInstance()->setError(i18n::__(00004, null, 'errors', array(':longitud' => trabajadorTableClass::TELEFONO_LENGTH)), 00004);
//      $flag = true;
//    }
//    
//    if (strlen($telefono) == null or $telefono === "") {
//      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => trabajadorTableClass::TELEFONO)), 00009);
//      $flag = true;
//  }
//  
//  if (!preg_match($soloNumeros, $telefono)) {
//      session::getInstance()->setError(i18n::__(00016, null, 'errors', array(':no permite letras' => trabajadorTableClass::TELEFONO)), 00016);
//      $flag = true;
//       } 
//  
////-----------------validaciones de email----------------------------------
//    if (strlen($email) > trabajadorTableClass::EMAIL_LENGTH) {
//      session::getInstance()->setError(i18n::__(00004, null, 'errors', array(':longitud' => trabajadorTableClass::EMAIL_LENGTH)), 00004);
//      $flag = true;
//    }
//    
//    if (strlen($email) == null or $email === "") {
//      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => trabajadorTableClass::EMAIL)), 00009);
//      $flag = true;
//    }  
//    
//    if (!preg_match($emailcorrecto, $email)) {
//      session::getInstance()->setError(i18n::__(00017, null, 'errors', array(':no permite letras' => trabajadorTableClass::EMAIL)), 00017);
//      $flag = true;
//       }
//
////-----------------respuesta a error--------------------------------------------
//   
//     if ($flag === true){
//    request::getInstance()->setMethod('GET');
//    routing::getInstance()->forward('trabajador', 'insert');
//  }
//}
}
