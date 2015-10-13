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
            registroLoteTableClass::FECHA_RIEGO
        );
        $orderBy = array(
            registroLoteTableClass::FECHA_RIEGO
        );
        $objLote = registroLoteTableClass::getAll($fields, false, $orderBy, 'ASC', null, null, $where);

//        echo '<pre>';
//        print_r($objLote);
//        echo '</pre>';
//        exit();
         
        
        $cosPoints = array();
        //el 1 dato
        foreach ($objLote as $objeto) {
          $cosPoints[] = array($objeto->produccion . 'Kg' . ' ' . productoInsumoTableClass::getNameProductoInsumo($objeto->producto_insumo_id),date('Y-m-d', strtotime($objeto->fecha_riego)) . ' ' . $objeto->ubicacion . ' ' );
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
       $wherePresupuesto1 = session::getInstance()->getAttribute('graficaWhereAno');
        $fields = array(
            registroLoteTableClass::ID,
            registroLoteTableClass::PRODUCTO_INSUMO_ID,
            registroLoteTableClass::PRODUCCION,
            registroLoteTableClass::FECHA_RIEGO,
            registroLoteTableClass::PRESUPUESTO,
            registroLoteTableClass::CREATED_AT
        );
        $orderBy = array(
//            presupuestoHistoricoTableClass::ID,
            registroLoteTableClass::PRESUPUESTO
        );
        $objPresupuesto = registroLoteTableClass::getAll($fields, false, $orderBy, 'ASC', null, null, $wherePresupuesto1);

        $cosPoints = array();
        foreach ($objPresupuesto as $objeto) {
          $cosPoints[] = array($objeto->presupuesto,date('Y-m-d', strtotime($objeto->created_at)));
        }
        $this->cosPoints = $cosPoints;
        
        
        
        
         $wherePresupuesto2 = session::getInstance()->getAttribute('graficaWhere');
        $fields = array(
            registroLoteTableClass::ID,
            registroLoteTableClass::PRODUCTO_INSUMO_ID,
            registroLoteTableClass::PRODUCCION,
            registroLoteTableClass::FECHA_RIEGO,
            registroLoteTableClass::PRESUPUESTO,
            registroLoteTableClass::CREATED_AT
        );
        $orderBy = array(
//            presupuestoHistoricoTableClass::ID,
            registroLoteTableClass::PRESUPUESTO
        );
        $objPresupuesto2 = registroLoteTableClass::getAll($fields, false, $orderBy, 'ASC', null, null, $wherePresupuesto2);

         $sinPoints = array();
        foreach ($objPresupuesto2 as $objeto) {
          $sinPoints[] = array($objeto->presupuesto,date('Y-m-d', strtotime($objeto->created_at)));
        }
        
        $this->sinPoints = $sinPoints;
       
        
        //---------------------------------------------------------------------
        //---------------------------------------------------------------------
        
         
            
        $whereTrabajador1 = session::getInstance()->getAttribute('graficaWhereTrabajadorAno');
         $fields = array(
            pagoTrabajadorTableClass::TRABAJADOR_ID,
            pagoTrabajadorTableClass::TOTAL_PAGAR,
            pagoTrabajadorTableClass::ID,
            pagoTrabajadorTableClass::FECHA_INICIAL,
            pagoTrabajadorTableClass::FECHA_INICIAL
        );
        $orderBy = array(
            pagoTrabajadorTableClass::TOTAL_PAGAR,
        );
        $objPresupuesto = pagoTrabajadorTableClass::getAll($fields, false, $orderBy, 'ASC', null, null, $whereTrabajador1);

        $pago1 = array();
        foreach ($objPresupuesto as $objeto) {
          $pago1[] = array($objeto->total_pagar,date('Y-m-d', strtotime($objeto->fecha_inicial)));
        }
        $this->pago1 = $pago1;
        
        
        
        
         $whereTrabajador2 = session::getInstance()->getAttribute('graficaWhereTrabajador');
         $fields = array(
            pagoTrabajadorTableClass::TRABAJADOR_ID,
            pagoTrabajadorTableClass::TOTAL_PAGAR,
            pagoTrabajadorTableClass::ID,
            pagoTrabajadorTableClass::FECHA_INICIAL,
            pagoTrabajadorTableClass::FECHA_INICIAL
        );
        $orderBy = array(
            pagoTrabajadorTableClass::TOTAL_PAGAR,
        );
        $objPresupuesto = pagoTrabajadorTableClass::getAll($fields, false, $orderBy, 'ASC', null, null, $whereTrabajador2);

        $pago2 = array();
        foreach ($objPresupuesto as $objeto) {
          $pago2[] = array($objeto->total_pagar,date('Y-m-d', strtotime($objeto->fecha_inicial)));
        }
        $this->pago2 = $pago2;
        
        
        //---------------------------------------------------------------------
        //---------------------------------------------------------------------
        $whereProduccion1 = session::getInstance()->getAttribute('graficaWhereLoteAno');
        $fields = array(
            registroLoteTableClass::PRODUCTO_INSUMO_ID,
            registroLoteTableClass::PRODUCCION,
            registroLoteTableClass::FECHA_RIEGO,
            registroLoteTableClass::CREATED_AT
        );
        $orderBy = array(
//            presupuestoHistoricoTableClass::ID,
            registroLoteTableClass::PRODUCCION
        );
        $objPresupuesto = registroLoteTableClass::getAll($fields, false, $orderBy, 'ASC', null, null, $whereProduccion1);

        $produccion1 = array();
        foreach ($objPresupuesto as $objeto) {
          $produccion1[] = array($objeto->produccion,date('Y-m-d', strtotime($objeto->fecha_riego)));
        }
        $this->produccion1 = $produccion1;
        
        
        
        
         $whereProduccion2 = session::getInstance()->getAttribute('graficaWhereLote');
        $fields = array(
            registroLoteTableClass::PRODUCTO_INSUMO_ID,
            registroLoteTableClass::PRODUCCION,
            registroLoteTableClass::FECHA_RIEGO,
            registroLoteTableClass::CREATED_AT
        );
        $orderBy = array(
//            presupuestoHistoricoTableClass::ID,
            registroLoteTableClass::PRODUCCION
        );
        $objPresupuesto2 = registroLoteTableClass::getAll($fields, false, $orderBy, 'ASC', null, null, $whereProduccion2);

         $produccion2 = array();
        foreach ($objPresupuesto2 as $objeto) {
          $produccion2[] = array($objeto->produccion,date('Y-m-d', strtotime($objeto->fecha_riego)));
        }
        
        $this->produccion2 = $produccion2;
        
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
        
       $plaga = detalleFacturaCompraTableClass::getPlagaGanancia(); 
       
       
       
       $enfermedad = detalleFacturaCompraTableClass::getEnfermedadGanancia() ;
       $trabajador = detalleFacturaCompraTableClass::getTrabajadorGanancia();
       $manoObra = detalleFacturaCompraTableClass::getManoObra();
       $orden = detalleFacturaCompraTableClass::getOrdenServicio();
       
        $gastos = ($plaga + $enfermedad + $trabajador + $manoObra + $orden );       
        
        $ventas = detalleFacturaCompraTableClass::getVentaGanancia();
        $ganacias = ($ventas - $gastos);
        $fechaInicial = session::getInstance()->getAttribute('totalRFecha1');
        $fechaFin = session::getInstance()->getAttribute('totalRFecha2');
        $cosPoints = array();
        //el 1 dato
        foreach ($objLote as $objeto) {
          $cosPoints[] = array($ganacias,date('Y-m-d', strtotime($fechaInicial)) . ' ' . ' al '. ' ' . date('Y-m-d', strtotime($fechaFin)). ' ' . ($objeto->ubicacion));
        }
        $this->cosPoints = $cosPoints;
         $this->ventas = detalleFacturaCompraTableClass::getVentaGanancia();
      $this->gastos = (detalleFacturaCompraTableClass::getPlagaGanancia() + detalleFacturaCompraTableClass::getEnfermedadGanancia() + detalleFacturaCompraTableClass::getTrabajadorGanancia() + detalleFacturaCompraTableClass::getManoObra()+ detalleFacturaCompraTableClass::getOrdenServicio()  );       
      $this->ganacias = ($ventas - $gastos);
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
