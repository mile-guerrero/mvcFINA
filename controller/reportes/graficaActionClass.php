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
            registroLoteTableClass::CREATED_AT
        );
        $objLote = registroLoteTableClass::getAll($fields, false, $orderBy, 'ASC', null, null, $where);

//        echo '<pre>';
//        print_r($objLote);
//        echo '</pre>';
//        exit();
         
        
        $cosPoints = array();
        //el 1 dato
        foreach ($objLote as $objeto) {
          $cosPoints[] = array($objeto->produccion . 'Kg' . ' ' . productoInsumoTableClass::getNameProductoInsumo($objeto->producto_insumo_id),date('Y-m-d', strtotime($objeto->created_at)) . ' ' . $objeto->ubicacion . ' ' );
        }
        $this->cosPoints = $cosPoints;
       
        
      }
      
      
      if ($value == 2) {
        $where = session::getInstance()->getAttribute('graficaWhere');
        $fields = array(
            registroLoteTableClass::NUMERO_PLANTULAS,
            registroLoteTableClass::UBICACION,
            registroLoteTableClass::ID,
             registroLoteTableClass::CREATED_AT
        );
        $orderBy = array(
//            registroLoteTableClass::CREATED_AT,
            registroLoteTableClass::NUMERO_PLANTULAS
        );
        $objLote = registroLoteTableClass::getAll($fields, false, $orderBy, 'ASC', null, null, $where);

        $cosPoints = array();
        foreach ($objLote as $objeto) {
          $cosPoints[] = array($objeto->numero_plantulas,date('Y-m-d', strtotime($objeto->created_at)) . ' ' . $objeto->ubicacion . ' ');
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
            pagoTrabajadorTableClass::FECHA_INICIAL
        );
        $orderBy = array(
            pagoTrabajadorTableClass::TOTAL_PAGAR,
        );
        $objTabajador = pagoTrabajadorTableClass::getAll($fields, false, $orderBy, 'ASC', null, null, $where);

        $cosPoints = array();
        foreach ($objTabajador as $objeto) {
          $cosPoints[] = array($objeto->total_pagar,date('Y-m-d', strtotime($objeto->fecha_inicial)). ' ' .trabajadorTableClass::getNameTrabajador($objeto->trabajador_id). ' ' . trabajadorTableClass::getNameApellido($objeto->trabajador_id). ' ' .  ' CC: ' . ' ' . trabajadorTableClass::getNameDocumento($objeto->trabajador_id));
//         print_r($cosPoints);
//         exit();
        }
//       $cosPoints[] = array(1, 2);
        $this->cosPoints3 = $cosPoints;
      }
      if ($value == 4) {
        $where = session::getInstance()->getAttribute('graficaWhere');
        $fields = array(
            presupuestoHistoricoTableClass::LOTE_ID,
            presupuestoHistoricoTableClass::PRODUCTO_INSUMO_ID,
            presupuestoHistoricoTableClass::ID,
            presupuestoHistoricoTableClass::TOTAL_PAGO_TRABAJADOR,
            presupuestoHistoricoTableClass::TOTAL_PRODUCCION,
            presupuestoHistoricoTableClass::PRESUPUESTO,
            presupuestoHistoricoTableClass::CREATED_AT
        );
        $orderBy = array(
//            presupuestoHistoricoTableClass::ID,
            presupuestoHistoricoTableClass::TOTAL_PRODUCCION
        );
        $objPresupuesto = presupuestoHistoricoTableClass::getAll($fields, true, $orderBy, 'ASC', null, null, $where);

        $cosPoints = array();
        foreach ($objPresupuesto as $objeto) {
          $cosPoints[] = array($objeto->presupuesto,date('Y-m-d', strtotime($objeto->created_at)));
        }
        $this->cosPoints = $cosPoints;
        
        
        
        
         $whereAno = session::getInstance()->getAttribute('graficaWhereAno');
        $fields = array(
            presupuestoHistoricoTableClass::LOTE_ID,
            presupuestoHistoricoTableClass::PRODUCTO_INSUMO_ID,
            presupuestoHistoricoTableClass::ID,
            presupuestoHistoricoTableClass::TOTAL_PAGO_TRABAJADOR,
            presupuestoHistoricoTableClass::TOTAL_PRODUCCION,
            presupuestoHistoricoTableClass::PRESUPUESTO,
            presupuestoHistoricoTableClass::CREATED_AT
        );
//        $orderBy = array(
////            presupuestoHistoricoTableClass::ID,
//            presupuestoHistoricoTableClass::TOTAL_PRODUCCION
//        );
        $objPresupuesto2 = presupuestoHistoricoTableClass::getAll($fields, true, $orderBy, 'ASC', null, null, $whereAno);

         $cosPoints5 = array();
        foreach ($objPresupuesto2 as $objeto) {
          $cosPoints5[] = array($objeto->presupuesto,date('Y-m-d', strtotime($objeto->created_at)));
        }
        
        $this->sinPoints = $cosPoints5;
        //---------------------------------------------------------------------
        //---------------------------------------------------------------------
        $where = session::getInstance()->getAttribute('graficaWhere');
        $fields = array(
            presupuestoHistoricoTableClass::LOTE_ID,
            presupuestoHistoricoTableClass::PRODUCTO_INSUMO_ID,
            presupuestoHistoricoTableClass::ID,
            presupuestoHistoricoTableClass::TOTAL_PAGO_TRABAJADOR,
            presupuestoHistoricoTableClass::TOTAL_PRODUCCION,
            presupuestoHistoricoTableClass::CREATED_AT
        );
        $orderBy = array(
//            presupuestoHistoricoTableClass::ID,
            presupuestoHistoricoTableClass::TOTAL_PAGO_TRABAJADOR
        );
        $objPresupuesto = presupuestoHistoricoTableClass::getAll($fields, true, $orderBy, 'ASC', null, null, $where);

        $cosPoints = array();
        foreach ($objPresupuesto as $objeto) {
          $cosPoints[] = array($objeto->total_pago_trabajador,date('Y-m-d', strtotime($objeto->created_at)));
        }
        $this->pago1 = $cosPoints;
        
        
        
        
         $whereAno = session::getInstance()->getAttribute('graficaWhereAno');
        $fields = array(
            presupuestoHistoricoTableClass::LOTE_ID,
            presupuestoHistoricoTableClass::PRODUCTO_INSUMO_ID,
            presupuestoHistoricoTableClass::ID,
            presupuestoHistoricoTableClass::TOTAL_PAGO_TRABAJADOR,
            presupuestoHistoricoTableClass::TOTAL_PRODUCCION,
            presupuestoHistoricoTableClass::CREATED_AT
        );
//        $orderBy = array(
////            presupuestoHistoricoTableClass::ID,
//            presupuestoHistoricoTableClass::TOTAL_PRODUCCION
//        );
        $objPresupuesto2 = presupuestoHistoricoTableClass::getAll($fields, true, $orderBy, 'ASC', null, null, $whereAno);

         $cosPoints5 = array();
        foreach ($objPresupuesto2 as $objeto) {
          $cosPoints5[] = array($objeto->total_pago_trabajador,date('Y-m-d', strtotime($objeto->created_at)));
        }
        
        $this->pago2 = $cosPoints5;
        
        
        //---------------------------------------------------------------------
        //---------------------------------------------------------------------
        $where = session::getInstance()->getAttribute('graficaWhere');
        $fields = array(
            presupuestoHistoricoTableClass::LOTE_ID,
            presupuestoHistoricoTableClass::PRODUCTO_INSUMO_ID,
            presupuestoHistoricoTableClass::ID,
            presupuestoHistoricoTableClass::TOTAL_PAGO_TRABAJADOR,
            presupuestoHistoricoTableClass::TOTAL_PRODUCCION,
            presupuestoHistoricoTableClass::CREATED_AT
        );
        $orderBy = array(
//            presupuestoHistoricoTableClass::ID,
            presupuestoHistoricoTableClass::TOTAL_PRODUCCION
        );
        $objPresupuesto = presupuestoHistoricoTableClass::getAll($fields, true, $orderBy, 'ASC', null, null, $where);

        $cosPoints = array();
        foreach ($objPresupuesto as $objeto) {
          $cosPoints[] = array($objeto->total_produccion,date('Y-m-d', strtotime($objeto->created_at)));
        }
        $this->produccion1 = $cosPoints;
        
        
        
        
         $whereAno = session::getInstance()->getAttribute('graficaWhereAno');
        $fields = array(
            presupuestoHistoricoTableClass::LOTE_ID,
            presupuestoHistoricoTableClass::PRODUCTO_INSUMO_ID,
            presupuestoHistoricoTableClass::ID,
            presupuestoHistoricoTableClass::TOTAL_PAGO_TRABAJADOR,
            presupuestoHistoricoTableClass::TOTAL_PRODUCCION,
            presupuestoHistoricoTableClass::CREATED_AT
        );
//        $orderBy = array(
////            presupuestoHistoricoTableClass::ID,
//            presupuestoHistoricoTableClass::TOTAL_PRODUCCION
//        );
        $objPresupuesto2 = presupuestoHistoricoTableClass::getAll($fields, true, $orderBy, 'ASC', null, null, $whereAno);

         $cosPoints5 = array();
        foreach ($objPresupuesto2 as $objeto) {
          $cosPoints5[] = array($objeto->total_produccion,date('Y-m-d', strtotime($objeto->created_at)));
        }
        
        $this->produccion2 = $cosPoints5;
        
      }
      
      
      if ($value == 5) {
        $where = session::getInstance()->getAttribute('totalWhere');
        $fields = array(
            registroLoteTableClass::PRODUCCION,
            registroLoteTableClass::UBICACION,
            registroLoteTableClass::ID,
            registroLoteTableClass::PRODUCTO_INSUMO_ID,
            registroLoteTableClass::CREATED_AT
        );
        $orderBy = array(
            registroLoteTableClass::CREATED_AT
        );
        $objLote = registroLoteTableClass::getAll($fields, false, $orderBy, 'ASC', null, null, $where);

//        echo '<pre>';
//        print_r($objLote);
//        echo '</pre>';
//        exit();
         
         
        echo detalleFacturaCompraTableClass::getPlagaGanancia();
        echo '<br>';
        echo detalleFacturaCompraTableClass::getEnfermedadGanancia();
        echo '<br>';
        echo detalleFacturaCompraTableClass::getTrabajadorGanancia();
        echo '<br>';
        echo detalleFacturaCompraTableClass::getVentaGanancia();
        
        
        $cosPoints = array();
        //el 1 dato
        foreach ($objLote as $objeto) {
          $cosPoints[] = array(productoInsumoTableClass::getNameProductoInsumo($objeto->producto_insumo_id),date('Y-m-d', strtotime($objeto->created_at)) . ' ' . $objeto->ubicacion . ' ' );
        }
        $this->cosPoints = $cosPoints;
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
