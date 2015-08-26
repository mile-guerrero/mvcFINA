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
 * @author 
 */
class reportActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      
         $where = null;
      if (request::getInstance()->hasPost('report')) {
        $report = request::getInstance()->getPost('report');
        //Validar datos
        if(isset($report['empresa']) and $report['empresa'] !== null and $report['empresa'] !== ""){
        $where[pagoTrabajadorTableClass::EMPRESA_ID] = $report['empresa'];
        }
        if (isset($report['fecha1']) and $report['fecha1'] !== null and $report['fecha1'] !== '' and (isset($report['fecha2']) and $report['fecha2'] !== null and $report['fecha2'] !== '')) {
          $where[pagoTrabajadorTableClass::FECHA_INICIAL] = array(
          date(config::getFormatTimestamp(), strtotime($report['fecha1'] . ' 00:00:00')),
          date(config::getFormatTimestamp(), strtotime($report['fecha2'] . ' 23:59:59'))
          );
        }
      }
      
      $this->mensaje = 'Informacion del pago trabajador';
      $fields = array(
          pagoTrabajadorTableClass::ID,
          pagoTrabajadorTableClass::FECHA_INICIAL,
          pagoTrabajadorTableClass::FECHA_FINAL,
          pagoTrabajadorTableClass::EMPRESA_ID,
          pagoTrabajadorTableClass::TRABAJADOR_ID,
          pagoTrabajadorTableClass::VALOR_SALARIO,
          pagoTrabajadorTableClass::CANTIDAD_HORAS_EXTRAS,
          pagoTrabajadorTableClass::VALOR_HORAS_EXTRAS,
          pagoTrabajadorTableClass::HORAS_PERDIDAS,
          pagoTrabajadorTableClass::TOTAL_PAGAR,
          pagoTrabajadorTableClass::CREATED_AT,
          pagoTrabajadorTableClass::UPDATED_AT
      );
      $orderBy = array(
          pagoTrabajadorTableClass::ID
      );
      $this->objPT = pagoTrabajadorTableClass::getAll($fields, false, $orderBy, 'ASC', null, null, $where);
 
       $fields = array(
          empresaTableClass::ID,
          empresaTableClass::NOMBRE
      );
      $orderBy = array(
         empresaTableClass::NOMBRE
      );
      $this->objEmpresa = empresaTableClass::getAll($fields, true, $orderBy, 'ASC');
 
      $fields = array(
          trabajadorTableClass::ID,
          trabajadorTableClass::NOMBRET
      );
      $orderBy = array(
         trabajadorTableClass::NOMBRET
      );
      
      $this->objT = trabajadorTableClass::getAll($fields, true, $orderBy, 'ASC');
 
      $this->defineView('index', 'pagoTrabajador', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo '<pre>';
      print_r($exc->getTrace());
      echo '</pre>';
    }
  }

}
