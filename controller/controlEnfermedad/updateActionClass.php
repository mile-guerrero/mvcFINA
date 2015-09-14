
<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\clienteValidatorClass as validator;
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
* @return   controlEnfermedadTableClass::NOMBRE retorna $nombre (string),
            controlEnfermedadTableClass::APELLIDO retorna $apellido (string),
            controlEnfermedadTableClass::DOCUMENTO retorna $documento (integer),
            controlEnfermedadTableClass::DIRECCION retorna $direccion (string),
            controlEnfermedadTableClass::TELEFONO retorna $telefono (integer),
            controlEnfermedadTableClass::ID_TIPO_ID retorna $idTipo (integer),
            controlEnfermedadTableClass::ID_CIUDAD retorna $idCiudad (integer),
            controlEnfermedadTableClass::ID retorna $id (integer),
 * estos datos retornan en la variable $data y el $id retorna en la variable $ids
*/
  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {
        $lote = trim(request::getInstance()->getPost(controlEnfermedadTableClass::getNameField(controlEnfermedadTableClass::LOTE_ID, true)));
        $enfermedad = trim(request::getInstance()->getPost(controlEnfermedadTableClass::getNameField(controlEnfermedadTableClass::ENFERMEDAD_ID, true)));
        $insumo = trim(request::getInstance()->getPost(controlEnfermedadTableClass::getNameField(controlEnfermedadTableClass::PRODUCTO_INSUMO_ID, true)));
        $cantidad = trim(request::getInstance()->getPost(controlEnfermedadTableClass::getNameField(controlEnfermedadTableClass::CANTIDAD, true)));
        $id = request::getInstance()->getPost(controlEnfermedadTableClass::getNameField(controlEnfermedadTableClass::ID, true));
//        validator::validateEdit();
         
        $ids = array(
            controlEnfermedadTableClass::ID => $id
        );
        $data = array(
            controlEnfermedadTableClass::LOTE_ID => $lote,
            controlEnfermedadTableClass::ENFERMEDAD_ID => $enfermedad,
            controlEnfermedadTableClass::PRODUCTO_INSUMO_ID => $insumo,
            controlEnfermedadTableClass::CANTIDAD => $cantidad
        );
          controlEnfermedadTableClass::update($ids, $data);
        
         session::getInstance()->setSuccess('La actualizacion fue correcta');
         $observacion ='se ha modificado el controlEnfermedad';
        log::register('Modificar', controlEnfermedadTableClass::getNameTable(),$observacion,$id);
        routing::getInstance()->redirect('controlEnfermedad', 'index');
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
// if (strlen($documento) > controlEnfermedadTableClass::DOCUMENTO_LENGTH) {
//      session::getInstance()->setError(i18n::__(00015, null, 'errors', array(':longitud' => controlEnfermedadTableClass::DOCUMENTO_LENGTH)), 00015);
//      $flag = true;
//     }
// if (strlen($documento) == null or $documento === "") {
//      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => controlEnfermedadTableClass::DOCUMENTO)), 00009);
//      $flag = true;
//     }
//if (!preg_match($soloNumeros, $documento)) {
//      session::getInstance()->setError(i18n::__(00010, null, 'errors', array(':no permite letras' => controlEnfermedadTableClass::DOCUMENTO)), 00010);
//      $flag = true;
//       }      
//    
////---------------------validacion nombre----------------------------------------     
//    if (strlen($nombre) > controlEnfermedadTableClass::NOMBRE_LENGTH) {
//      session::getInstance()->setError(i18n::__(00001, null, 'errors', array(':longitud' => controlEnfermedadTableClass::NOMBRE_LENGTH)), 00001);
//      $flag = true;
//      }
//
//    if (strlen($nombre)  == null or $nombre === "") {
//      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => controlEnfermedadTableClass::NOMBRE)), 00009);
//      $flag = true;
//     }
//     
//    
//    if (!preg_match($soloLetras, $nombre)) {
//       session::getInstance()->setError(i18n::__(00012, null, 'errors', array(':no permite letras' => controlEnfermedadTableClass::NOMBRE)), 00012);
//       $flag = true;
//       }
//      
////---------------------validacion apellido--------------------------------------  
//    if (strlen($apellido) > controlEnfermedadTableClass::APELLIDO_LENGTH) {
//      session::getInstance()->setError(i18n::__(00002, null, 'errors', array(':longitud' => controlEnfermedadTableClass::APELLIDO_LENGTH)), 00002);
//      $flag = true;
//     }
//    
//     if (strlen($apellido) == null or $apellido === "") {
//      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => controlEnfermedadTableClass::APELLIDO)), 00009);
//      $flag = true;
//     }
//     
//    if (!preg_match($soloLetras, $apellido)) {
//       session::getInstance()->setError(i18n::__(00012, null, 'errors', array(':no permite letras' => controlEnfermedadTableClass::APELLIDO)), 00012);
//       $flag = true;
//       }
////---------------------validacion direccion-------------------------------------
//     if (strlen($direccion) > controlEnfermedadTableClass::DIRECCION_LENGTH) {
//      session::getInstance()->setError(i18n::__(00002, null, 'errors', array(':longitud' => controlEnfermedadTableClass::DIRECCION_LENGTH)), 00002);
//      $flag = true;
//     }
//     
//     if (strlen($direccion)  == null or $direccion === "") {
//      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => controlEnfermedadTableClass::DIRECCION)), 00009);
//      $flag = true;
//     }
// 
////-------------------validacion de telefono-------------------------------------
//  if (strlen($telefono) > controlEnfermedadTableClass::TELEFONO_LENGTH) {
//      session::getInstance()->setError(i18n::__(00014, null, 'errors', array(':longitud' => controlEnfermedadTableClass::TELEFONO_LENGTH)), 00014);
//      $flag = true;
//     }
//  if (strlen($telefono) == null or $telefono === "") {
//      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => controlEnfermedadTableClass::TELEFONO)), 00009);
//      $flag = true;
//     }
// if (!preg_match($soloNumeros, $telefono)) {
//      session::getInstance()->setError(i18n::__(00016, null, 'errors', array(':no permite letras' => controlEnfermedadTableClass::TELEFONO)), 00016);
//      $flag = true;
//       }
//
////-------------------validacion ------------------------------------------------
//    if ($flag === true){
//    request::getInstance()->setMethod('GET');
//    request::getInstance()->addParamGet(array(controlEnfermedadTableClass::ID => request::getInstance()->getPost(controlEnfermedadTableClass::getNameField(controlEnfermedadTableClass::ID, true))));
//    routing::getInstance()->forward('cliente', 'editCliente');
//  }
//  }

