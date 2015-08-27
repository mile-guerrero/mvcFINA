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
      $where = null;
      $value = session::getInstance()->getAttribute('idGrafica');
       if ($value == 1) {
      $where = session::getInstance()->getAttribute('graficaWhere');
      $fields = array(
          registroLoteTableClass::PRODUCCION,
          registroLoteTableClass::CREATED_AT,
      );
      $orderBy = array(
          registroLoteTableClass::PRODUCCION
      );
      $objLote = registroLoteTableClass::getAll($fields, false, $orderBy, 'ASC', null, null, $where);

      $cosPoints = array();
      foreach ($objLote as $objeto) {
        $cosPoints[] = array($objeto->produccion, (date('Y-m-d', strtotime($objeto->created_at))));
      }
      $this->cosPoints = $cosPoints;
       }
       
        if ($value == 2) {
          $where = session::getInstance()->getAttribute('graficaWhere');
      $fields = array(
          registroLoteTableClass::NUMERO_PLANTULAS,
          registroLoteTableClass::UBICACION,
      );
      $orderBy = array(
          registroLoteTableClass::NUMERO_PLANTULAS
      );
      $objLote = registroLoteTableClass::getAll($fields, false, $orderBy, 'ASC', null, null, $where);

      $cosPoints = array();
      foreach ($objLote as $objeto) {
        $cosPoints[] = array($objeto->numero_plantulas, $objeto->ubicacion);
//         print_r($cosPoints);
//         exit();
      }
//       $cosPoints[] = array(1, 2);
      $this->cosPoints2 = $cosPoints;
      
         
        }










      
      

//      print_r($cosPoints);
//      exit();
//      $fechaInicial = session::getInstance()->getAttribute('graficaRFecha1');
//      $fechaFin = session::getInstance()->getAttribute('graficaRFecha2');
//      $ubicacion = session::getInstance()->getAttribute('graficaUbicacion');
//      $objLoteProduccion = registroLoteTableClass::getProduccion($ubicacion, $fechaInicial, $fechaFin);
//      $objLoteFecha = registroLoteTableClass::getFecha($ubicacion, $fechaInicial, $fechaFin);
//      $this->cosPoints = array(array($objLoteProduccion,$objLoteFecha));
//        $this->cosPoints = array(array($objLote[1]->produccion,$objLote[1]->created_at));
//     $this->cosPoints = array(array($objLoteProduccion,$objLoteFecha));
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
