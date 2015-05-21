<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\proveedorValidatorClass as validator;
/**
 * Description of ejemploClass
 *
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
 */
class createProveedorActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $nombre = trim(request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::NOMBREP, true)));
        $apellido = trim(request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::APELLIDO, true)));
        $documento = trim(request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::DOCUMENTO, true)));
        $direccion = trim(request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::DIRECCION, true)));
        $telefono = trim(request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::TELEFONO, true)));
        $email = trim(request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::EMAIL, true)));
        $idCiudad = trim(request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::ID_CIUDAD, true)));
        
         validator::validateInsert();
//        $this->validate($documento,$nombre, $apellido, $direccion, $telefono, $email);
        
        $data = array(
            proveedorTableClass::NOMBREP => $nombre,
            proveedorTableClass::APELLIDO => $apellido,
            proveedorTableClass::DOCUMENTO => $documento,
            proveedorTableClass::DIRECCION => $direccion,
            proveedorTableClass::TELEFONO => $telefono,
            proveedorTableClass::EMAIL => $email,
            proveedorTableClass::ID_CIUDAD => $idCiudad
            
        );
        proveedorTableClass::insert($data);
        session::getInstance()->setSuccess('El registro fue exitoso');
        routing::getInstance()->redirect('maquina', 'indexProveedor');
      } else {
        routing::getInstance()->redirect('maquina', 'indexProveedor');
      }
    } catch (PDOException $exc) {
      routing::getInstance()->redirect('maquina', 'insertProveedor');
      session::getInstance()->setFlash('exc', $exc);
    }
  }

//public function validate($documento,$nombre, $apellido, $direccion, $telefono, $email) {
//
//    $flag = false;
//    $soloNumeros = "/^[[:digit:]]+$/";
//    $soloLetras = "/^[a-z]+$/i";
//    $soloTelefono = "/[0-9](9)$/";
//    $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';
// //---------------------validacion documento-------------------------------------
//  if (strlen($documento) > proveedorTableClass::DOCUMENTO_LENGTH) {
//      session::getInstance()->setError(i18n::__(00015, null, 'errors', array(':longitud' => proveedorTableClass::DOCUMENTO_LENGTH)), 00015);
//      $flag = true;
//     }
// if (strlen($documento) == null or $documento === "") {
//      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => proveedorTableClass::DOCUMENTO)), 00009);
//      $flag = true;
//     }
//if (!preg_match($soloNumeros, $documento)) {
//      session::getInstance()->setError(i18n::__(00010, null, 'errors', array(':no permite letras' => proveedorTableClass::DOCUMENTO)), 00010);
//      $flag = true;
//       }      
//    
////---------------------validacion nombre----------------------------------------     
//    if (strlen($nombre) > proveedorTableClass::NOMBREP_LENGTH) {
//      session::getInstance()->setError(i18n::__(00001, null, 'errors', array(':longitud' => proveedorTableClass::NOMBREP_LENGTH)), 00001);
//      $flag = true;
//      }
//
//    if (strlen($nombre)  == null or $nombre === "") {
//      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => proveedorTableClass::NOMBREP)), 00009);
//      $flag = true;
//     }
//     
//    
//    if (!preg_match($soloLetras, $nombre)) {
//       session::getInstance()->setError(i18n::__(00012, null, 'errors', array(':no permite letras' => proveedorTableClass::NOMBREP)), 00012);
//       $flag = true;
//       }
//      
////---------------------validacion apellido--------------------------------------  
//    if (strlen($apellido) > proveedorTableClass::APELLIDO_LENGTH) {
//      session::getInstance()->setError(i18n::__(00002, null, 'errors', array(':longitud' => proveedorTableClass::APELLIDO_LENGTH)), 00002);
//      $flag = true;
//     }
//    
//     if (strlen($apellido) == null or $apellido === "") {
//      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => proveedorTableClass::APELLIDO)), 00009);
//      $flag = true;
//     }
//     
//    if (!preg_match($soloLetras, $apellido)) {
//       session::getInstance()->setError(i18n::__(00012, null, 'errors', array(':no permite letras' => proveedorTableClass::APELLIDO)), 00012);
//       $flag = true;
//       }
////---------------------validacion direccion-------------------------------------
//     if (strlen($direccion) > proveedorTableClass::DIRECCION_LENGTH) {
//      session::getInstance()->setError(i18n::__(00002, null, 'errors', array(':longitud' => proveedorTableClass::DIRECCION_LENGTH)), 00002);
//      $flag = true;
//     }
//     
//     if (strlen($direccion)  == null or $direccion === "") {
//      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => proveedorTableClass::DIRECCION)), 00009);
//      $flag = true;
//     }
// 
////-------------------validacion de telefono-------------------------------------
//  if (strlen($telefono) > proveedorTableClass::TELEFONO_LENGTH) {
//      session::getInstance()->setError(i18n::__(00019, null, 'errors', array(':longitud' => proveedorTableClass::TELEFONO_LENGTH)), 00019);
//      $flag = true;
//     }
//  if (strlen($telefono) == null or $telefono === "") {
//      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => proveedorTableClass::TELEFONO)), 00009);
//      $flag = true;
//     }
// if (!preg_match($soloNumeros, $telefono)) {
//      session::getInstance()->setError(i18n::__(00016, null, 'errors', array(':no permite letras' => proveedorTableClass::TELEFONO)), 00016);
//      $flag = true;
//       }
//       
// //-------------------validacion email------------------------------------------ 
//       
// if (strlen($email) > proveedorTableClass::EMAIL_LENGTH) {
//      session::getInstance()->setError(i18n::__(00014, null, 'errors', array(':longitud' => proveedorTableClass::EMAIL_LENGTH)), 00014);
//      $flag = true;
//     }
//  if (strlen($email) == null or $email === "") {
//      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => proveedorTableClass::EMAIL)), 00009);
//      $flag = true;
//     }      
// if (!preg_match($emailcorrecto, $email)) {
//        session::getInstance()->setError(i18n::__(00011, null, 'errors', array(':correo' => $email), 00011));
//        $flag = true; 
//    }
////-------------------validacion ------------------------------------------------  
//   
//    if ($flag === true){
//      request::getInstance()->setMethod('GET');
//      routing::getInstance()->forward('maquina', 'insertProveedor');
//    }
//  }

}