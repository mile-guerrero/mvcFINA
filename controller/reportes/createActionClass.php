<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
//use mvc\validator\defaultValidatorClass as validator;
use hook\log\logHookClass as log;

/**
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon 
 * @date: fecha de inicio del desarrollo.
 * @category: modulo de defautl.
 */
class createActionClass extends controllerClass implements controllerActionInterface {

 
  /**
   * @author: Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon .
   * @date: fecha de inicio del desarrollo.
   * @return   usuarioTableClass::USUARIO retorna $usuario (string),
               usuarioTableClass::PASSWORD retorna $usuario (string),
   * estos datos retornan en la variable $data
   */
  public function execute() {
    try {

    $where = null;
//        if ((request::getInstance()->hasPost(loteTableClass::getNameField(loteTableClass::CREATED_AT, true) . '_1') and empty(mvc\request\requestClass::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::CREATED_AT, true) . '_1')) === false) and ( (request::getInstance()->hasPost(loteTableClass::getNameField(loteTableClass::CREATED_AT, true) . '_2') and empty(mvc\request\requestClass::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::CREATED_AT, true) . '_2')) === false))) {
//
//          if (request::getInstance()->isMethod('POST')) {
//           
//            $fechaInicial = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::CREATED_AT, true) . '_1');
//            $fechaFin = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::CREATED_AT, true) . '_2');
//     
//            validator::validateFiltroFecha($fechaInicial,$fechaFin);
//           
//            if ((isset($fechaInicial) and $fechaInicial !== null and $fechaInicial !== "") and ( isset($fechaFin) and $fechaFin !== null and $fechaFin !== "" )) {
//              $where[] = '(' . loteTableClass::getNameField(loteTableClass::CREATED_AT) . ' BETWEEN ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaInicial . ' 00:00:00')) . "'" . ' AND ' . "'" .  date(config::getFormatTimestamp(), strtotime($fechaFin . ' 23:59:59')) . "'" . ' ) ';             
//            }
//          }
//        }

        if (request::getInstance()->hasPost(loteTableClass::getNameField(loteTableClass::UBICACION, true)) and empty(mvc\request\requestClass::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::UBICACION, true))) === false) {

          if (request::getInstance()->isMethod('POST')) {
            $ubicacion = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::UBICACION, true));
            $objLote = loteTableClass::getProduccion($ubicacion);
            session::getInstance()->setAttribute('graficaUbicacion', $ubicacion);
//          print_r($where);  
//          echo $ubicacion;
//          exit();
//            }
          }
        }
        

       routing::getInstance()->redirect('reportes', 'grafica');
      
      $this->defineView('grafica', 'reportes', session::getInstance()->getFormatOutput());
    
        }catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }//cierre del catch
}//cierre de la funcion execute

}

