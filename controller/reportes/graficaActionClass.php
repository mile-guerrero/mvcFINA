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
            registroLoteTableClass::UBICACION,
            registroLoteTableClass::ID,
            registroLoteTableClass::PRODUCTO_INSUMO_ID,
            registroLoteTableClass::CREATED_AT,
        );
        $orderBy = array(
            registroLoteTableClass::PRODUCCION,
            registroLoteTableClass::CREATED_AT,
            registroLoteTableClass::UBICACION,
            registroLoteTableClass::PRODUCTO_INSUMO_ID
        );
        $objLote = registroLoteTableClass::getAll($fields, false, $orderBy, 'ASC', null, null, $where);

//        echo '<pre>';
//        print_r($objLote);
//        echo '</pre>';
//        exit();
         
        
        $cosPoints = array();
        //el 1 dato
        foreach ($objLote as $objeto) {
          $cosPoints[] = array($objeto->id . ' ' . $objeto->ubicacion . ' ' , $objeto->produccion . ' ' . 'Kg' . ' ' . productoInsumoTableClass::getNameProductoInsumo($objeto->producto_insumo_id));
        }
        $this->cosPoints = $cosPoints;
       
        
      }
      
      
      if ($value == 2) {
        $where = session::getInstance()->getAttribute('graficaWhere');
        $fields = array(
            registroLoteTableClass::NUMERO_PLANTULAS,
            registroLoteTableClass::UBICACION,
            registroLoteTableClass::ID,
        );
        $orderBy = array(
            registroLoteTableClass::NUMERO_PLANTULAS,
        );
        $objLote = registroLoteTableClass::getAll($fields, false, $orderBy, 'ASC', null, null, $where);

        $cosPoints = array();
        foreach ($objLote as $objeto) {
          $cosPoints[] = array($objeto->id . ' ' . $objeto->ubicacion . ' ', $objeto->numero_plantulas,
              array(
                  'id' => $objLote->id,
                  'numeroPlantulas' => $objeto->numero_plantulas 
              ));
//         print_r($cosPoints);
//         exit();
        }
//       $cosPoints[] = array(1, 2);
        $this->cosPoints2 = $cosPoints;
      }


      if ($value == 3) {
         $where = session::getInstance()->getAttribute('graficaWhere');
        $fields = array(
            pagoTrabajadorTableClass::TRABAJADOR_ID,
            pagoTrabajadorTableClass::TOTAL_PAGAR,
            pagoTrabajadorTableClass::ID,
        );
        $orderBy = array(
            pagoTrabajadorTableClass::TOTAL_PAGAR,
        );
        $objTabajador = pagoTrabajadorTableClass::getAll($fields, false, $orderBy, 'ASC', null, null, $where);

        $cosPoints = array();
        foreach ($objTabajador as $objeto) {
          $cosPoints[] = array($objeto->id . ' ' .trabajadorTableClass::getNameTrabajador($objeto->trabajador_id). ' ' . trabajadorTableClass::getNameApellido($objeto->trabajador_id). ' ' .  ' CC: ' . ' ' . trabajadorTableClass::getNameDocumento($objeto->trabajador_id) , $objeto->total_pagar);
//         print_r($cosPoints);
//         exit();
        }
//       $cosPoints[] = array(1, 2);
        $this->cosPoints3 = $cosPoints;
      }
      if ($value == 4) {
        
      }
      if ($value == 5) {
        
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
