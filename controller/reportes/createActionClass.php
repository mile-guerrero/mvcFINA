<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
//use mvc\validator\lotetValidatorClass as validator;
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

//      $id = session::getInstance()->getAttribute('idRegistro');
//      foreach ($id as $value) {
////      echo $value;
//      }
//      session::getInstance()->setAttribute('idGrafica', $value);
      
       $value = session::getInstance()->getAttribute('idGrafica');
      $where = null;
      if ($value == 1) {
        if (((request::getInstance()->hasPost(registroLoteTableClass::getNameField(registroLoteTableClass::CREATED_AT, true) . '_1') and empty(mvc\request\requestClass::getInstance()->getPost(registroLoteTableClass::getNameField(registroLoteTableClass::CREATED_AT, true) . '_1')) === false) and ( (request::getInstance()->hasPost(registroLoteTableClass::getNameField(registroLoteTableClass::CREATED_AT, true) . '_2') and empty(mvc\request\requestClass::getInstance()->getPost(registroLoteTableClass::getNameField(registroLoteTableClass::CREATED_AT, true) . '_2')) === false)) and empty(mvc\request\requestClass::getInstance()->getPost(registroLoteTableClass::getNameField(registroLoteTableClass::CREATED_AT, true) . '_1')) === false) and ( (request::getInstance()->hasPost(registroLoteTableClass::getNameField(registroLoteTableClass::UBICACION, true)) and empty(mvc\request\requestClass::getInstance()->getPost(registroLoteTableClass::getNameField(registroLoteTableClass::UBICACION, true))) === false))) {

          if (request::getInstance()->isMethod('POST')) {

            $fechaInicial = request::getInstance()->getPost(registroLoteTableClass::getNameField(registroLoteTableClass::CREATED_AT, true) . '_1');
            $fechaFin = request::getInstance()->getPost(registroLoteTableClass::getNameField(registroLoteTableClass::CREATED_AT, true) . '_2');
            $ubicacion = request::getInstance()->getPost(registroLoteTableClass::getNameField(registroLoteTableClass::UBICACION, true));

            if (strtotime($fechaFin) < strtotime($fechaInicial)) {
              session::getInstance()->setError('La fecha final no puede ser menor a la actual', 'inputFecha');
              session::getInstance()->setFlash('modalFilters', true);
              routing::getInstance()->forward('reportes', 'insert');
            }


            session::getInstance()->setAttribute('graficaUbicacion', $ubicacion);
            session::getInstance()->setAttribute('graficaRFecha1', $fechaInicial);
            session::getInstance()->setAttribute('graficaRFecha2', $fechaFin);

            $where[] = '(' . registroLoteTableClass::getNameField(registroLoteTableClass::UBICACION) . ' LIKE ' . '\'' . $ubicacion . '%\'  '
                    . 'OR ' . registroLoteTableClass::getNameField(registroLoteTableClass::UBICACION) . ' LIKE ' . '\'%' . $ubicacion . '%\' '
                    . 'OR ' . registroLoteTableClass::getNameField(registroLoteTableClass::UBICACION) . ' LIKE ' . '\'%' . $ubicacion . '\') '
                    . ' AND ' . '(' . registroLoteTableClass::getNameField(registroLoteTableClass::CREATED_AT) . ' BETWEEN ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaInicial . ' 00:00:00')) . "'" . ' AND ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaFin . ' 23:59:59')) . "'" . ' ) ';
//             $where[] = '(' . registroLoteTableClass::getNameField(registroLoteTableClass::CREATED_AT) . ' BETWEEN ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaInicial . ' 00:00:00')) . "'" . ' AND ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaFin . ' 23:59:59')) . "'" . ' ) ';
            session::getInstance()->setAttribute('graficaWhere', $where);
//              print_r($where);  
//          echo $fechaInicial.' '. $fechaFin . ' ' . $ubicacion;
//          exit();
            // }
          }
        }
      }

      if ($value == 2) {

        if (((request::getInstance()->hasPost(registroLoteTableClass::getNameField(registroLoteTableClass::CREATED_AT, true) . '_1') and empty(mvc\request\requestClass::getInstance()->getPost(registroLoteTableClass::getNameField(registroLoteTableClass::CREATED_AT, true) . '_1')) === false) and ( (request::getInstance()->hasPost(registroLoteTableClass::getNameField(registroLoteTableClass::CREATED_AT, true) . '_2') and empty(mvc\request\requestClass::getInstance()->getPost(registroLoteTableClass::getNameField(registroLoteTableClass::CREATED_AT, true) . '_2')) === false)) and empty(mvc\request\requestClass::getInstance()->getPost(registroLoteTableClass::getNameField(registroLoteTableClass::CREATED_AT, true) . '_1')) === false) and ( (request::getInstance()->hasPost(registroLoteTableClass::getNameField(registroLoteTableClass::UBICACION, true)) and empty(mvc\request\requestClass::getInstance()->getPost(registroLoteTableClass::getNameField(registroLoteTableClass::UBICACION, true))) === false))) {

          if (request::getInstance()->isMethod('POST')) {

            $fechaInicial = request::getInstance()->getPost(registroLoteTableClass::getNameField(registroLoteTableClass::CREATED_AT, true) . '_1');
            $fechaFin = request::getInstance()->getPost(registroLoteTableClass::getNameField(registroLoteTableClass::CREATED_AT, true) . '_2');
            $ubicacion = request::getInstance()->getPost(registroLoteTableClass::getNameField(registroLoteTableClass::UBICACION, true));

            if (strtotime($fechaFin) < strtotime($fechaInicial)) {
              session::getInstance()->setError('La fecha final no puede ser menor a la actual', 'inputFecha');
              session::getInstance()->setFlash('modalFilters', true);
              routing::getInstance()->forward('reportes', 'insert');
            }


            session::getInstance()->setAttribute('graficaUbicacion', $ubicacion);
            session::getInstance()->setAttribute('graficaRFecha1', $fechaInicial);
            session::getInstance()->setAttribute('graficaRFecha2', $fechaFin);

            $where[] = '(' . registroLoteTableClass::getNameField(registroLoteTableClass::UBICACION) . ' LIKE ' . '\'' . $ubicacion . '%\'  '
                    . 'OR ' . registroLoteTableClass::getNameField(registroLoteTableClass::UBICACION) . ' LIKE ' . '\'%' . $ubicacion . '%\' '
                    . 'OR ' . registroLoteTableClass::getNameField(registroLoteTableClass::UBICACION) . ' LIKE ' . '\'%' . $ubicacion . '\') '
                    . ' AND ' . '(' . registroLoteTableClass::getNameField(registroLoteTableClass::CREATED_AT) . ' BETWEEN ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaInicial . ' 00:00:00')) . "'" . ' AND ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaFin . ' 23:59:59')) . "'" . ' ) ';
//             $where[] = '(' . registroLoteTableClass::getNameField(registroLoteTableClass::CREATED_AT) . ' BETWEEN ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaInicial . ' 00:00:00')) . "'" . ' AND ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaFin . ' 23:59:59')) . "'" . ' ) ';
            session::getInstance()->setAttribute('graficaWhere', $where);
//              print_r($where);  
//          echo $fechaInicial.' '. $fechaFin;
//          exit();
            // }
          }
        }
      }
       
      if ($value == 3) {
        
        if ((request::getInstance()->hasPost(pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::FECHA_INICIAL, true) . '_1') and empty(mvc\request\requestClass::getInstance()->getPost(pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::FECHA_INICIAL, true) . '_1')) === false) and ( (request::getInstance()->hasPost(pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::FECHA_FINAL, true) . '_2') and empty(mvc\request\requestClass::getInstance()->getPost(pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::FECHA_FINAL, true) . '_2')) === false))) {

          if (request::getInstance()->isMethod('POST')) {

            $fechaInicial = request::getInstance()->getPost(pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::FECHA_INICIAL, true) . '_1');
            $fechaFin = request::getInstance()->getPost(pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::FECHA_FINAL, true) . '_2');
            $nombre = request::getInstance()->getPost(pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::TRABAJADOR_ID, true));
            session::getInstance()->setAttribute('TrabajadorFechaInicial', $fechaInicial); 
            session::getInstance()->setAttribute('TrabajadorFechaFin', $fechaFin);
            session::getInstance()->setAttribute('Trabajador', $nombre);
       
            if (strtotime($fechaFin) < strtotime($fechaInicial)) {
              session::getInstance()->setError('La fecha final no puede ser menor a la actual', 'inputFecha');
              session::getInstance()->setFlash('modalFilters', true);
              routing::getInstance()->forward('reportes', 'insert');
            }


          

            $where[] = '(' . pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::TRABAJADOR_ID) . ' = ' . $nombre . ' ) '
                    . ' AND ' . '(' . pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::FECHA_INICIAL) . ' BETWEEN ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaInicial . ' 00:00:00')) . "'" . ' AND ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaFin . ' 23:59:59')) . "'" . ' ) ';
          
            session::getInstance()->setAttribute('graficaWhere', $where);

          }
        }
      }

      
      if ($value == 4) {
        if ((request::getInstance()->hasPost(presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::CREATED_AT, true) . '_1') and empty(mvc\request\requestClass::getInstance()->getPost(presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::CREATED_AT, true) . '_1')) === false) and ( (request::getInstance()->hasPost(presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::CREATED_AT, true) . '_2') and empty(mvc\request\requestClass::getInstance()->getPost(presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::CREATED_AT, true) . '_2')) === false))) {

          if (request::getInstance()->isMethod('POST')) {

            $fechaInicial1 = request::getInstance()->getPost(presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::CREATED_AT, true) . '_1');
            $fechaFin1 = request::getInstance()->getPost(presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::CREATED_AT, true) . '_2');
            
            
            $fechaInicial2 = request::getInstance()->getPost(presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::CREATED_AT, true) . '_3');
            $fechaFin2 = request::getInstance()->getPost(presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::CREATED_AT, true) . '_4');
            $lote = request::getInstance()->getPost(presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::LOTE_ID, true));
             session::getInstance()->setAttribute('Lote', $lote);
        
       
//            if (strtotime($fechaFin) < strtotime($fechaInicial)) {
//              session::getInstance()->setError('La fecha final no puede ser menor a la actual', 'inputFecha');
//              session::getInstance()->setFlash('modalFilters', true);
//              routing::getInstance()->forward('reportes', 'insert');
//            }

          $whereAno[] = '(' . presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::LOTE_ID) . ' = ' . $lote . ' ) '
                    . ' AND ' . '(' . presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::CREATED_AT) . ' BETWEEN ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaInicial1 . ' 00:00:00')) . "'" . ' AND ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaFin1 . ' 23:59:59')) . "'" . ' ) ';
          
            session::getInstance()->setAttribute('graficaWhereAno', $whereAno);
          

            $where[] = '(' . presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::LOTE_ID) . ' = ' . $lote . ' ) '
                    . ' AND ' . '(' . presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::CREATED_AT) . ' BETWEEN ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaInicial2 . ' 00:00:00')) . "'" . ' AND ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaFin2 . ' 23:59:59')) . "'" . ' ) ';
          
            session::getInstance()->setAttribute('graficaWhere', $where);

          }
        }
      }
      if ($value == 5) {
        if (((request::getInstance()->hasPost(registroLoteTableClass::getNameField(registroLoteTableClass::CREATED_AT, true) . '_1') and empty(mvc\request\requestClass::getInstance()->getPost(registroLoteTableClass::getNameField(registroLoteTableClass::CREATED_AT, true) . '_1')) === false) and ( (request::getInstance()->hasPost(registroLoteTableClass::getNameField(registroLoteTableClass::CREATED_AT, true) . '_2') and empty(mvc\request\requestClass::getInstance()->getPost(registroLoteTableClass::getNameField(registroLoteTableClass::CREATED_AT, true) . '_2')) === false)) and empty(mvc\request\requestClass::getInstance()->getPost(registroLoteTableClass::getNameField(registroLoteTableClass::CREATED_AT, true) . '_1')) === false) and ( (request::getInstance()->hasPost(registroLoteTableClass::getNameField(registroLoteTableClass::UBICACION, true)) and empty(mvc\request\requestClass::getInstance()->getPost(registroLoteTableClass::getNameField(registroLoteTableClass::UBICACION, true))) === false))) {

          if (request::getInstance()->isMethod('POST')) {

            $fechaInicial = request::getInstance()->getPost(registroLoteTableClass::getNameField(registroLoteTableClass::CREATED_AT, true) . '_1');
            $fechaFin = request::getInstance()->getPost(registroLoteTableClass::getNameField(registroLoteTableClass::CREATED_AT, true) . '_2');
            $ubicacion = request::getInstance()->getPost(registroLoteTableClass::getNameField(registroLoteTableClass::UBICACION, true));

            if (strtotime($fechaFin) < strtotime($fechaInicial)) {
              session::getInstance()->setError('La fecha final no puede ser menor a la actual', 'inputFecha');
              session::getInstance()->setFlash('modalFilters', true);
              routing::getInstance()->forward('reportes', 'insert');
            }


            session::getInstance()->setAttribute('totalUbicacion', $ubicacion);
            session::getInstance()->setAttribute('totalRFecha1', $fechaInicial);
            session::getInstance()->setAttribute('totalRFecha2', $fechaFin);

            $where[] = '(' . registroLoteTableClass::getNameField(registroLoteTableClass::UBICACION) . ' LIKE ' . '\'' . $ubicacion . '%\'  '
                    . 'OR ' . registroLoteTableClass::getNameField(registroLoteTableClass::UBICACION) . ' LIKE ' . '\'%' . $ubicacion . '%\' '
                    . 'OR ' . registroLoteTableClass::getNameField(registroLoteTableClass::UBICACION) . ' LIKE ' . '\'%' . $ubicacion . '\') '
                    . ' AND ' . '(' . registroLoteTableClass::getNameField(registroLoteTableClass::CREATED_AT) . ' BETWEEN ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaInicial . ' 00:00:00')) . "'" . ' AND ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaFin . ' 23:59:59')) . "'" . ' ) ';
//             $where[] = '(' . registroLoteTableClass::getNameField(registroLoteTableClass::CREATED_AT) . ' BETWEEN ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaInicial . ' 00:00:00')) . "'" . ' AND ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaFin . ' 23:59:59')) . "'" . ' ) ';
            session::getInstance()->setAttribute('totalWhere', $where);
//              print_r($where);  
//          echo $fechaInicial.' '. $fechaFin;
//          exit();
            // }
          }
        }
      }
      routing::getInstance()->redirect('reportes', 'grafica');
      $this->defineView('grafica', 'reportes', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }//cierre del catch
  }

//cierre de la funcion execute
}
