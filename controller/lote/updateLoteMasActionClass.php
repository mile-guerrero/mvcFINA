
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
class updateLoteMasActionClass extends controllerClass implements controllerActionInterface {

  
  /**
* @author: Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon .
* @date: fecha de inicio del desarrollo.
* @return   loteTableClass::NUMERO_PLANTULAS retorna $nombre (integer),
            loteTableClass::PRODUCTO_INSUMO_ID retorna $apellido (integer),
            loteTableClass::PRESUPUESTO retorna $documento (integer),            
 * estos datos retornan en la variable $data y el $id retorna en la variable $ids
*/
  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {
        $id = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::ID, true));
        $ubicacion = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::UBICACION, true));
        $tamano = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::TAMANO, true));
        $unidadDistancia = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::UNIDAD_DISTANCIA_ID, true));
        $unidadMedida = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::UNIDAD_MEDIDA_ID, true));
        $descripcion = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::DESCRIPCION, true));
        $fechaSiembra = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::FECHA_INICIO_SIEMBRA, true));
        $idCiudad = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::ID_CIUDAD, true));
        $numero = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::NUMERO_PLANTULAS, true));
        $produccion = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::PRODUCCION, true));
        $insumo = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::PRODUCTO_INSUMO_ID, true));
        $presupuesto = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::PRESUPUESTO, true));
        $fechaRiego = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::FECHA_RIEGO, true));
        
        
//        if (strlen($fechaSiembra) == null or $fechaSiembra =='') {
//           $fechaSiembra = 'null';
//        }//cierre de validacin de nulo
        
        if (strlen($produccion) == null or $produccion =='') {
           $produccion = 'null';
        }//cierre de validacin de nulo
        
         if (strlen($unidadMedida) == null or $unidadMedida =='') {
           $unidadMedida = 'null';
        }//cierre de validacin de nulo
        
        if (strlen($numero) == null or $numero =='') {
           $numero = 'null';
        }//cierre de validacin de nulo
        
        if (strlen($insumo) == null or $insumo =='') {
           $insumo = 'null';
        }//cierre de validacin de nulo
         
         if (strlen($presupuesto) == null or $presupuesto =='') {
           $presupuesto = 'null';
        }//cierre de validacin de nulo
        
        validator::validateEditMas();
//        $this->validate($numero, $presupuesto);
        
        loteTableClass::loteupdateMas($id,$fechaSiembra,$fechaRiego,$numero,$insumo,$presupuesto,$produccion, $unidadMedida);
        session::getInstance()->setSuccess('La actualizacion fue correcta');
        $observacion ='se ha modificado el lote mas';
        log::register('Modificar', loteTableClass::getNameTable(),$observacion,$id);
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
//  public function validate($numero, $presupuesto){
//
//    $flag = false;
//    $patron = "/^[[:digit:]]+$/";
//
////-----------------validaciones de numero---------------------------------------
//      if (strlen($numero) > loteTableClass::NUMERO_PLANTULAS_LENGTH) {
//      session::getInstance()->setError(i18n::__(00001, null, 'errors', array(':longitud' =>loteTableClass::NUMERO_PLANTULAS_LENGTH)), 00001);
//      $flag = true;
//      } 
//      
////      if (!preg_match($patron, $numero)) {
////      session::getInstance()->setError(i18n::__(00010, null, 'errors', array(':no permite letras' => loteTableClass::NUMERO_PLANTULAS)), 00010);
////      $flag = true;
////       }
////-----------------validaciones de presupuesto----------------------------------      
//      if (strlen($presupuesto) > loteTableClass::PRESUPUESTO_LENGTH) {
//         session::getInstance()->setError(i18n::__(00006, null, 'errors', array(':longitud' => loteTableClass::PRESUPUESTO_LENGTH)), 00006);
//        $flag = true;
//        }
//        
////      if (!preg_match($patron, $presupuesto)) {
////      session::getInstance()->setError(i18n::__(00010, null, 'errors', array(':no permite letras' => loteTableClass::PRESUPUESTO)), 00010);
////      $flag = true;
////       }
//    
////-----------------confirmacion de validacion-----------------------------------    
//     if ($flag === true){
//    request::getInstance()->setMethod('GET');
//    request::getInstance()->addParamGet(array(loteTableClass::ID => request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::ID, true))));
//    routing::getInstance()->forward('lote', 'editLoteMas');
//    
//  }
//}

