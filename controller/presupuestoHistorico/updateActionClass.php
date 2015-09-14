
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
* @return   presupuestoHistoricoTableClass::NOMBRE retorna $nombre (string),
            presupuestoHistoricoTableClass::APELLIDO retorna $apellido (string),
            presupuestoHistoricoTableClass::DOCUMENTO retorna $documento (integer),
            presupuestoHistoricoTableClass::DIRECCION retorna $direccion (string),
            presupuestoHistoricoTableClass::TELEFONO retorna $telefono (integer),
            presupuestoHistoricoTableClass::ID_TIPO_ID retorna $idTipo (integer),
            presupuestoHistoricoTableClass::ID_CIUDAD retorna $idCiudad (integer),
            presupuestoHistoricoTableClass::ID retorna $id (integer),
 * estos datos retornan en la variable $data y el $id retorna en la variable $ids
*/
  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {
        $lote = trim(request::getInstance()->getPost(presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::LOTE_ID, true)));
        $insumo = trim(request::getInstance()->getPost(presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::PRODUCTO_INSUMO_ID, true)));
        $presupuesto = trim(request::getInstance()->getPost(presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::PRESUPUESTO, true)));
        $totalProduccion = trim(request::getInstance()->getPost(presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::TOTAL_PRODUCCION, true)));
        $totalPago = trim(request::getInstance()->getPost(presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::TOTAL_PAGO_TRABAJADOR, true)));
        $id = request::getInstance()->getPost(presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::ID, true));
//        validator::validateEdit();
         
        $ids = array(
            presupuestoHistoricoTableClass::ID => $id
        );
        $data = array(
            presupuestoHistoricoTableClass::LOTE_ID => $lote,
            presupuestoHistoricoTableClass::PRESUPUESTO => $presupuesto,
            presupuestoHistoricoTableClass::PRODUCTO_INSUMO_ID => $insumo,
            presupuestoHistoricoTableClass::TOTAL_PAGO_TRABAJADOR => $totalProduccion,
            presupuestoHistoricoTableClass::TOTAL_PRODUCCION => $totalPago
        );
          presupuestoHistoricoTableClass::update($ids, $data);
        
         session::getInstance()->setSuccess('La actualizacion fue correcta');
         $observacion ='se ha modificado el presupuestoHistorico';
        log::register('Modificar', presupuestoHistoricoTableClass::getNameTable(),$observacion,$id);
        routing::getInstance()->redirect('presupuestoHistorico', 'index');
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
// if (strlen($documento) > presupuestoHistoricoTableClass::DOCUMENTO_LENGTH) {
//      session::getInstance()->setError(i18n::__(00015, null, 'errors', array(':longitud' => presupuestoHistoricoTableClass::DOCUMENTO_LENGTH)), 00015);
//      $flag = true;
//     }
// if (strlen($documento) == null or $documento === "") {
//      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => presupuestoHistoricoTableClass::DOCUMENTO)), 00009);
//      $flag = true;
//     }
//if (!preg_match($soloNumeros, $documento)) {
//      session::getInstance()->setError(i18n::__(00010, null, 'errors', array(':no permite letras' => presupuestoHistoricoTableClass::DOCUMENTO)), 00010);
//      $flag = true;
//       }      
//    
////---------------------validacion nombre----------------------------------------     
//    if (strlen($nombre) > presupuestoHistoricoTableClass::NOMBRE_LENGTH) {
//      session::getInstance()->setError(i18n::__(00001, null, 'errors', array(':longitud' => presupuestoHistoricoTableClass::NOMBRE_LENGTH)), 00001);
//      $flag = true;
//      }
//
//    if (strlen($nombre)  == null or $nombre === "") {
//      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => presupuestoHistoricoTableClass::NOMBRE)), 00009);
//      $flag = true;
//     }
//     
//    
//    if (!preg_match($soloLetras, $nombre)) {
//       session::getInstance()->setError(i18n::__(00012, null, 'errors', array(':no permite letras' => presupuestoHistoricoTableClass::NOMBRE)), 00012);
//       $flag = true;
//       }
//      
////---------------------validacion apellido--------------------------------------  
//    if (strlen($apellido) > presupuestoHistoricoTableClass::APELLIDO_LENGTH) {
//      session::getInstance()->setError(i18n::__(00002, null, 'errors', array(':longitud' => presupuestoHistoricoTableClass::APELLIDO_LENGTH)), 00002);
//      $flag = true;
//     }
//    
//     if (strlen($apellido) == null or $apellido === "") {
//      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => presupuestoHistoricoTableClass::APELLIDO)), 00009);
//      $flag = true;
//     }
//     
//    if (!preg_match($soloLetras, $apellido)) {
//       session::getInstance()->setError(i18n::__(00012, null, 'errors', array(':no permite letras' => presupuestoHistoricoTableClass::APELLIDO)), 00012);
//       $flag = true;
//       }
////---------------------validacion direccion-------------------------------------
//     if (strlen($direccion) > presupuestoHistoricoTableClass::DIRECCION_LENGTH) {
//      session::getInstance()->setError(i18n::__(00002, null, 'errors', array(':longitud' => presupuestoHistoricoTableClass::DIRECCION_LENGTH)), 00002);
//      $flag = true;
//     }
//     
//     if (strlen($direccion)  == null or $direccion === "") {
//      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => presupuestoHistoricoTableClass::DIRECCION)), 00009);
//      $flag = true;
//     }
// 
////-------------------validacion de telefono-------------------------------------
//  if (strlen($telefono) > presupuestoHistoricoTableClass::TELEFONO_LENGTH) {
//      session::getInstance()->setError(i18n::__(00014, null, 'errors', array(':longitud' => presupuestoHistoricoTableClass::TELEFONO_LENGTH)), 00014);
//      $flag = true;
//     }
//  if (strlen($telefono) == null or $telefono === "") {
//      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => presupuestoHistoricoTableClass::TELEFONO)), 00009);
//      $flag = true;
//     }
// if (!preg_match($soloNumeros, $telefono)) {
//      session::getInstance()->setError(i18n::__(00016, null, 'errors', array(':no permite letras' => presupuestoHistoricoTableClass::TELEFONO)), 00016);
//      $flag = true;
//       }
//
////-------------------validacion ------------------------------------------------
//    if ($flag === true){
//    request::getInstance()->setMethod('GET');
//    request::getInstance()->addParamGet(array(presupuestoHistoricoTableClass::ID => request::getInstance()->getPost(presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::ID, true))));
//    routing::getInstance()->forward('cliente', 'editCliente');
//  }
//  }

