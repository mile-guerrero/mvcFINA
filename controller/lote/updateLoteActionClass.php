
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
class updateLoteActionClass extends controllerClass implements controllerActionInterface {

  /**
* @author: Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon .
* @date: fecha de inicio del desarrollo.
* @return   loteTableClass::UBICACION retorna $ubicacion (string),
            loteTableClass::TAMANO retorna $tamano (string),
            loteTableClass::UNIDAD_DISTANCIA_ID retorna $unidadDistancia (integer),
            loteTableClass::ID_CIUDAD retorna $idCiudad (integer),
            loteTableClass::ID retorna $id (integer),
 * estos datos retornan en la variable $data y el $id retorna en la variable $ids
*/
  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {
        $id = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::ID, true));
        $ubicacion = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::UBICACION, true));
        $tamano = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::TAMANO, true));
        $unidadDistancia = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::UNIDAD_DISTANCIA_ID, true));
        $descripcion = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::DESCRIPCION, true));
        $idCiudad = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::ID_CIUDAD, true));

        
        validator::validateEdit();
//        $this->validate($ubicacion, $tamano, $descripcion);


        $ids = array(
            loteTableClass::ID => $id
        );
        $data = array(
            loteTableClass::UBICACION => $ubicacion,
            loteTableClass::TAMANO => $tamano,
            loteTableClass::UNIDAD_DISTANCIA_ID => $unidadDistancia,
            loteTableClass::DESCRIPCION => $descripcion,
            loteTableClass::ID_CIUDAD => $idCiudad
        );
        loteTableClass::update($ids, $data);
        session::getInstance()->setSuccess('La actualizacion fue correcta');
        $observacion ='se ha modificado el lote';
        log::register('Modificar', loteTableClass::getNameTable(),$observacion,$id);
        routing::getInstance()->redirect('lote', 'indexLote');
      }//cierre de POTS 
    }//cierre del try
      catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
      }//cierre del catch
}//cierre de la funcion execute

}//cierre de la clase

//  public function validate($ubicacion, $tamano, $descripcion) {
//
//    $flag = false;
////------------------validaciones de ubicacion-----------------------------------
//    if (strlen($ubicacion) > loteTableClass::UBICACION_LENGTH) {
//      session::getInstance()->setError(i18n::__(00005, null, 'errors', array(':longitud' => loteTableClass::UBICACION_LENGTH)), 00005);
//      $flag = true;
//    }
//    
//    if (strlen($ubicacion) == null) {
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
//    if (strlen($tamano) == null) {
//      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => loteTableClass::TAMANO)), 00009);
//      $flag = true;
//       }
//       
//  $patron = "/^[[:digit:]]+$/";
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
//    if (strlen($descripcion) == null) {
//      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => loteTableClass::DESCRIPCION)), 00009);
//      $flag = true;
//  }
//
////-----------------respuesta a error--------------------------------------------
//    if ($flag === true) {
//      request::getInstance()->setMethod('GET');
//      request::getInstance()->addParamGet(array(loteTableClass::ID => request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::ID, true))));
//      routing::getInstance()->forward('lote', 'editLote');
//    }
//  }
//
//}
