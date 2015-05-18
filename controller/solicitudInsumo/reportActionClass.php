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
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
 */
class reportActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      $where = null;

      if (request::getInstance()->hasPost('report')) {
        $report = request::getInstance()->getPost('report');
        //Validar datos
       
//        if (isset($report['trabajador']) and $report['trabajador'] !== null and $report['trabajador'] !== '') {
//          $where[manoObraTableClass::TRABAJADOR_ID] = $report['trabajador'];
//        }
        if (isset($report['cantidad']) and $report['cantidad'] !== null and $report['cantidad'] !== '') {
          $where[solicitudInsumoTableClass::CANTIDAD] = $report['cantidad'];
        }
  
        if (isset($report['fecha1']) and $report['fecha1'] !== null and $report['fecha1'] !== '' and (isset($report['fecha2']) and $report['fecha2'] !== null and $report['fecha2'] !== '')) {
          $where[solicitudInsumoTableClass::CREATED_AT] = array(
          date(config::getFormatTimestamp(), strtotime($report['fecha1'] . ' 00:00:00')),
          date(config::getFormatTimestamp(), strtotime($report['fecha2'] . ' 23:59:59'))
          );
        }
      }
      $this->mensaje = 'Informacion de la Solicitudes de los Insumos';
      $fields = array(
          solicitudInsumoTableClass::ID,
          solicitudInsumoTableClass::FECHA_HORA,
          solicitudInsumoTableClass::TRABAJADOR_ID,
          solicitudInsumoTableClass::CANTIDAD,
          solicitudInsumoTableClass::PRODUCTO_INSUMO_ID,
          solicitudInsumoTableClass::LOTE_ID,
          solicitudInsumoTableClass::CREATED_AT,
          solicitudInsumoTableClass::UPDATED_AT,
          solicitudInsumoTableClass::DELETED_AT
      );
      $orderBy = array(
         solicitudInsumoTableClass::ID
      );
      $this->objS = solicitudInsumoTableClass::getAll($fields, true, $orderBy, 'ASC', null, null,$where);
 
      $fields = array(
      trabajadorTableClass::ID,
      trabajadorTableClass::NOMBRET
      );
      $orderBy = array(
      trabajadorTableClass::NOMBRET   
      );      
      $this->objT = trabajadorTableClass::getAll($fields, true, $orderBy, 'ASC');
 
      $this->defineView('index', 'solicitudInsumo', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo '<pre>';
      print_r($exc->getTrace());
      echo '</pre>';
    }
  }
}