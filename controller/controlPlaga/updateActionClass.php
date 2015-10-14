
<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\controlPlagaValidatorUpdateClass as validator;
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
* @return   controlPlagaTableClass::NOMBRE retorna $nombre (string),
            controlPlagaTableClass::APELLIDO retorna $apellido (string),
            controlPlagaTableClass::DOCUMENTO retorna $documento (integer),
            controlPlagaTableClass::DIRECCION retorna $direccion (string),
            controlPlagaTableClass::TELEFONO retorna $telefono (integer),
            controlPlagaTableClass::ID_TIPO_ID retorna $idTipo (integer),
            controlPlagaTableClass::ID_CIUDAD retorna $idCiudad (integer),
            controlPlagaTableClass::ID retorna $id (integer),
 * estos datos retornan en la variable $data y el $id retorna en la variable $ids
*/
  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {
        $lote = trim(request::getInstance()->getPost(controlPlagaTableClass::getNameField(controlPlagaTableClass::LOTE_ID, true)));
        $plaga = trim(request::getInstance()->getPost(controlPlagaTableClass::getNameField(controlPlagaTableClass::PLAGA_ID, true)));
        $insumo = trim(request::getInstance()->getPost(controlPlagaTableClass::getNameField(controlPlagaTableClass::PRODUCTO_INSUMO_ID, true)));
        $cantidad = trim(request::getInstance()->getPost(controlPlagaTableClass::getNameField(controlPlagaTableClass::CANTIDAD, true)));
        $id = request::getInstance()->getPost(controlPlagaTableClass::getNameField(controlPlagaTableClass::ID, true));
        $unidadMedida = request::getInstance()->getPost(controlPlagaTableClass::getNameField(controlPlagaTableClass::UNIDAD_MEDIDA_ID, true));
        
        validator::validateUpdate();
         
        $ids = array(
            controlPlagaTableClass::ID => $id
        );
        $data = array(
            controlPlagaTableClass::LOTE_ID => $lote,
            controlPlagaTableClass::PLAGA_ID => $plaga,
            controlPlagaTableClass::PRODUCTO_INSUMO_ID => $insumo,
            controlPlagaTableClass::CANTIDAD => $cantidad,
            controlPlagaTableClass::UNIDAD_MEDIDA_ID => $unidadMedida
        );
          controlPlagaTableClass::update($ids, $data);
        
         session::getInstance()->setSuccess('La actualizacion fue correcta');
         $observacion ='se ha modificado el controlPlaga';
        log::register('Modificar', controlPlagaTableClass::getNameTable(),$observacion,$id);
        routing::getInstance()->redirect('controlPlaga', 'index');
      }//cierre del if

     } catch (PDOException $exc) {
      routing::getInstance()->redirect('controlPlaga', 'edit');
      session::getInstance()->setFlash('exc', $exc);
    }
  }

}
//public function validate($nombre, $apellido, $documento, $direccion, $telefono) {
//
//    $flag = false;
//    $soloNumeros = "/^[[:digit:]]+$/";
//    $soloLetras = "/^[a-z]+$/i";
//    $soloTelefono = "/[0-9](9)$/";
//    $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';
// 
////---------------------validacion documento-------------------------------------
// if (strlen($documento) > controlPlagaTableClass::DOCUMENTO_LENGTH) {
//      session::getInstance()->setError(i18n::__(00015, null, 'errors', array(':longitud' => controlPlagaTableClass::DOCUMENTO_LENGTH)), 00015);
//      $flag = true;
//     }
// if (strlen($documento) == null or $documento === "") {
//      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => controlPlagaTableClass::DOCUMENTO)), 00009);
//      $flag = true;
//     }
//if (!preg_match($soloNumeros, $documento)) {
//      session::getInstance()->setError(i18n::__(00010, null, 'errors', array(':no permite letras' => controlPlagaTableClass::DOCUMENTO)), 00010);
//      $flag = true;
//       }      
//    
////---------------------validacion nombre----------------------------------------     
//    if (strlen($nombre) > controlPlagaTableClass::NOMBRE_LENGTH) {
//      session::getInstance()->setError(i18n::__(00001, null, 'errors', array(':longitud' => controlPlagaTableClass::NOMBRE_LENGTH)), 00001);
//      $flag = true;
//      }
//
//    if (strlen($nombre)  == null or $nombre === "") {
//      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => controlPlagaTableClass::NOMBRE)), 00009);
//      $flag = true;
//     }
//     
//    
//    if (!preg_match($soloLetras, $nombre)) {
//       session::getInstance()->setError(i18n::__(00012, null, 'errors', array(':no permite letras' => controlPlagaTableClass::NOMBRE)), 00012);
//       $flag = true;
//       }
//      
////---------------------validacion apellido--------------------------------------  
//    if (strlen($apellido) > controlPlagaTableClass::APELLIDO_LENGTH) {
//      session::getInstance()->setError(i18n::__(00002, null, 'errors', array(':longitud' => controlPlagaTableClass::APELLIDO_LENGTH)), 00002);
//      $flag = true;
//     }
//    
//     if (strlen($apellido) == null or $apellido === "") {
//      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => controlPlagaTableClass::APELLIDO)), 00009);
//      $flag = true;
//     }
//     
//    if (!preg_match($soloLetras, $apellido)) {
//       session::getInstance()->setError(i18n::__(00012, null, 'errors', array(':no permite letras' => controlPlagaTableClass::APELLIDO)), 00012);
//       $flag = true;
//       }
////---------------------validacion direccion-------------------------------------
//     if (strlen($direccion) > controlPlagaTableClass::DIRECCION_LENGTH) {
//      session::getInstance()->setError(i18n::__(00002, null, 'errors', array(':longitud' => controlPlagaTableClass::DIRECCION_LENGTH)), 00002);
//      $flag = true;
//     }
//     
//     if (strlen($direccion)  == null or $direccion === "") {
//      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => controlPlagaTableClass::DIRECCION)), 00009);
//      $flag = true;
//     }
// 
////-------------------validacion de telefono-------------------------------------
//  if (strlen($telefono) > controlPlagaTableClass::TELEFONO_LENGTH) {
//      session::getInstance()->setError(i18n::__(00014, null, 'errors', array(':longitud' => controlPlagaTableClass::TELEFONO_LENGTH)), 00014);
//      $flag = true;
//     }
//  if (strlen($telefono) == null or $telefono === "") {
//      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => controlPlagaTableClass::TELEFONO)), 00009);
//      $flag = true;
//     }
// if (!preg_match($soloNumeros, $telefono)) {
//      session::getInstance()->setError(i18n::__(00016, null, 'errors', array(':no permite letras' => controlPlagaTableClass::TELEFONO)), 00016);
//      $flag = true;
//       }
//
////-------------------validacion ------------------------------------------------
//    if ($flag === true){
//    request::getInstance()->setMethod('GET');
//    request::getInstance()->addParamGet(array(controlPlagaTableClass::ID => request::getInstance()->getPost(controlPlagaTableClass::getNameField(controlPlagaTableClass::ID, true))));
//    routing::getInstance()->forward('cliente', 'editCliente');
//  }
//  }

