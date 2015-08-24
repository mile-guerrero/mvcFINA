<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
/**
 * Description of ejemploClass
 *
 * @author Andres Bahamon
 */

class graficaActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      $ubicacion = session::getInstance()->getAttribute('graficaUbicacion');
      //$ubicacion = request::getInstance()->getPost($param);
//      $objLote = loteTableClass::getProduccion($where);
      
      $objLote =  loteTableClass::getProduccion($ubicacion);
//      $this->cosPoints = hola($objLote);
      
     // echo $objLote;
      $this->cosPoints = array(array($objLote,4), array($objLote, 12));
      
//      $respuesta = array();
//      foreach ($objLote as $objeto) {
//        $respuesta[] = array(date('Y-m-d', strtotime($objeto->fecha)), $objeto->cantidad);
//      }
//      
//      $this->respuesta = $respuesta;

//       $this->cosPoints = array([0,0],[0,$objLote],[2,$objLote]);

      
      
//      $this->cosPoints = array(
//          rand(0, $objLote),
//          rand(1, $objLote),
//          rand(1, $objLote)
//      );
      
      
      
      $this->defineView('grafica', 'reportes', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}
