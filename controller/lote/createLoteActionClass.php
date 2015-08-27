<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\loteValidatorClass as validator;
use hook\log\logHookClass as log;

/**
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon 
 * @date: fecha de inicio del desarrollo.
 * @category: modulo de maquina.
 */
class createLoteActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {
       
        $ubicacion = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::UBICACION, true));
        $tamano = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::TAMANO, true));
        $unidadDistancia = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::UNIDAD_DISTANCIA_ID, true));
        $descripcion = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::DESCRIPCION, true));
//        $fechaSiembra = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::FECHA_INICIO_SIEMBRA, true));
//        $numero = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::NUMERO_PLANTULAS, true));
//        $presupuesto = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::PRESUPUESTO, true));
//        $insumo = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::PRODUCTO_INSUMO_ID, true));
        $idCiudad = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::ID_CIUDAD, true));
       
          if($tamano < 0){
                session::getInstance()->setFlash('inputTamano', true);
                session::getInstance()->setError('Los valores numericos no pueden ser negativos', 'inputTamano');
                routing::getInstance()->forward('lote', 'insertLote');
            }
        validator::validateInsert();
//        $this->validate($ubicacion, $tamano, $descripcion);


        loteTableClass::loteInsert($ubicacion,$idCiudad,$tamano,$descripcion,$unidadDistancia);
        session::getInstance()->setSuccess('El registro fue exitoso');
        $observacion ='se ha insertando un nuevo lote';
        log::register('Insertar', loteTableClass::getNameTable(),$observacion,null);
        routing::getInstance()->redirect('lote', 'indexLote');
      } else {
        routing::getInstance()->redirect('lote', 'indexLote');
      }
    }//cierre del try
      catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
     }//cierre del catch
}//cierre de la funcion execute

}//cierre de la clase

// public function validate($ubicacion, $tamano, $descripcion){
//
//    $flag = false;
//    $patron = "/^[[:digit:]]+$/";
////------------------validaciones de ubicacion-----------------------------------
//    if (strlen($ubicacion) > loteTableClass::UBICACION_LENGTH) {
//      session::getInstance()->setError(i18n::__(00005, null, 'errors', array(':longitud' => loteTableClass::UBICACION_LENGTH)), 00005);
//      $flag = true;
//    }
//    
//    if (strlen($ubicacion) == null or $ubicacion === "") {
//      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => loteTableClass::UBICACION)), 00009);
//      $flag = true;
//       }
//     
////-----------------validaciones de tamaño---------------------------------------
//    if (strlen($tamano) > loteTableClass::TAMANO_LENGTH) {
//      session::getInstance()->setError(i18n::__(00006, null, 'errors', array(':longitud' => loteTableClass::TAMANO_LENGTH)), 00006);
//      $flag = true;
//    }
//    
//    if (strlen($tamano) == null or $tamano === "") {
//      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => loteTableClass::TAMANO)), 00009);
//      $flag = true;
//       }
//       
//  
//  
//  if (!preg_match($patron, $tamano)) {
//      session::getInstance()->setError(i18n::__(00010, null, 'errors', array(':no permite letras' => loteTableClass::TAMANO)), 00010);
//      $flag = true;
//       }
//  
////-----------------validaciones de descripcion----------------------------------
//    if (strlen($descripcion) > loteTableClass::DESCRIPCION_LENGTH) {
//      session::getInstance()->setError(i18n::__(00004, null, 'errors', array(':longitud' => loteTableClass::DESCRIPCION_LENGTH)), 00004);
//      $flag = true;
//    }
//    
//    if (strlen($descripcion) == null or $descripcion === "") {
//      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => loteTableClass::DESCRIPCION)), 00009);
//      $flag = true;
//  }
//
////-----------------respuesta a error--------------------------------------------
//   
//     if ($flag === true){
//    request::getInstance()->setMethod('GET');
//    routing::getInstance()->forward('lote', 'insertLote');
//  }
//}
