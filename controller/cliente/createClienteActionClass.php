<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\clienteValidatorClass as validator;

/**
 * Description of ejemploClass
 *
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon 
 */
class createClienteActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $nombre = trim(request::getInstance()->getPost(clienteTableClass::getNameField(clienteTableClass::NOMBRE, true)));
        $apellido = trim(request::getInstance()->getPost(clienteTableClass::getNameField(clienteTableClass::APELLIDO, true)));
        $documento = trim(request::getInstance()->getPost(clienteTableClass::getNameField(clienteTableClass::DOCUMENTO, true)));
        $direccion = trim(request::getInstance()->getPost(clienteTableClass::getNameField(clienteTableClass::DIRECCION, true)));
        $telefono = trim(request::getInstance()->getPost(clienteTableClass::getNameField(clienteTableClass::TELEFONO, true)));
        $idTipo = trim(request::getInstance()->getPost(clienteTableClass::getNameField(clienteTableClass::ID_TIPO_ID, true)));
        $idCiudad = trim(request::getInstance()->getPost(clienteTableClass::getNameField(clienteTableClass::ID_CIUDAD, true)));

        
        validator::validateInsert();
//        $this->validate($nombre, $apellido, $documento, $direccion, $telefono);

        $data = array(
            clienteTableClass::NOMBRE => $nombre,
            clienteTableClass::APELLIDO => $apellido,
            clienteTableClass::DOCUMENTO => $documento,
            clienteTableClass::DIRECCION => $direccion,
            clienteTableClass::TELEFONO => $telefono,
            clienteTableClass::ID_TIPO_ID => $idTipo,
            clienteTableClass::ID_CIUDAD => $idCiudad,
        );
        clienteTableClass::insert($data);
        session::getInstance()->setSuccess('El registro fue exitoso');
        routing::getInstance()->redirect('cliente', 'indexCliente');
      } else {
        routing::getInstance()->redirect('cliente', 'indexCliente');
      }
    } catch (PDOException $exc) {
      routing::getInstance()->redirect('cliente', 'insertCliente');
      session::getInstance()->setFlash('exc', $exc);
    }
  }
}

//  public function validate($nombre, $apellido, $documento, $direccion, $telefono) {
//
//    $flag = false;
//    $soloNumeros = "/^[[:digit:]]+$/";
//    $soloLetras = "/^[a-z]+$/i";
//    $soloTelefono = "/[0-9](9)$/";
//    $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';
// 
////---------------------validacion documento-------------------------------------
// if (strlen($documento) > clienteTableClass::DOCUMENTO_LENGTH) {
//      session::getInstance()->setError(i18n::__(00015, null, 'errors', array(':longitud' => clienteTableClass::DOCUMENTO_LENGTH)), 00015);
//      $flag = true;
//     }
// if (strlen($documento) == null or $documento === "") {
//      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => clienteTableClass::DOCUMENTO)), 00009);
//      $flag = true;
//     }
//if (!preg_match($soloNumeros, $documento)) {
//      session::getInstance()->setError(i18n::__(00010, null, 'errors', array(':no permite letras' => clienteTableClass::DOCUMENTO)), 00010);
//      $flag = true;
//       }      
//    
////---------------------validacion nombre----------------------------------------     
//    if (strlen($nombre) > clienteTableClass::NOMBRE_LENGTH) {
//      session::getInstance()->setError(i18n::__(00001, null, 'errors', array(':longitud' => clienteTableClass::NOMBRE_LENGTH)), 00001);
//      $flag = true;
//      }
//
//    if (strlen($nombre)  == null or $nombre === "") {
//      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => clienteTableClass::NOMBRE)), 00009);
//      $flag = true;
//     }
//     
//    
//    if (!preg_match($soloLetras, $nombre)) {
//       session::getInstance()->setError(i18n::__(00012, null, 'errors', array(':no permite letras' => clienteTableClass::NOMBRE)), 00012);
//       $flag = true;
//       }
//      
////---------------------validacion apellido--------------------------------------  
//    if (strlen($apellido) > clienteTableClass::APELLIDO_LENGTH) {
//      session::getInstance()->setError(i18n::__(00002, null, 'errors', array(':longitud' => clienteTableClass::APELLIDO_LENGTH)), 00002);
//      $flag = true;
//     }
//    
//     if (strlen($apellido) == null or $apellido === "") {
//      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => clienteTableClass::APELLIDO)), 00009);
//      $flag = true;
//     }
//     
//    if (!preg_match($soloLetras, $apellido)) {
//       session::getInstance()->setError(i18n::__(00012, null, 'errors', array(':no permite letras' => clienteTableClass::APELLIDO)), 00012);
//       $flag = true;
//       }
////---------------------validacion direccion-------------------------------------
//     if (strlen($direccion) > clienteTableClass::DIRECCION_LENGTH) {
//      session::getInstance()->setError(i18n::__(00002, null, 'errors', array(':longitud' => clienteTableClass::DIRECCION_LENGTH)), 00002);
//      $flag = true;
//     }
//     
//     if (strlen($direccion)  == null or $direccion === "") {
//      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => clienteTableClass::DIRECCION)), 00009);
//      $flag = true;
//     }
// 
////-------------------validacion de telefono-------------------------------------
//  if (strlen($telefono) > clienteTableClass::TELEFONO_LENGTH) {
//      session::getInstance()->setError(i18n::__(00019, null, 'errors', array(':longitud' => clienteTableClass::TELEFONO_LENGTH)), 00019);
//      $flag = true;
//     }
//  if (strlen($telefono) == null or $telefono === "") {
//      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => clienteTableClass::TELEFONO)), 00009);
//      $flag = true;
//     }
// if (!preg_match($soloNumeros, $telefono)) {
//      session::getInstance()->setError(i18n::__(00016, null, 'errors', array(':no permite letras' => clienteTableClass::TELEFONO)), 00016);
//      $flag = true;
//       }
//
////-------------------validacion ------------------------------------------------
//    if ($flag === true){
//    request::getInstance()->setMethod('GET');
//    routing::getInstance()->forward('cliente', 'insertCliente');
//  }
//  }
//
//}

