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
class indexActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {

      $where = null;
      $where[detallePagoTrabajadorTableClass::PAGO_TRABAJADOR_ID] = request::getInstance()->getGet(detallePagoTrabajadorTableClass::getNameField(detallePagoTrabajadorTableClass::PAGO_TRABAJADOR_ID, true));
      if (request::getInstance()->hasPost('filter')) {
        $filter = request::getInstance()->getPost('filter');
        //Validar datos

        if (isset($filter['empresa']) and $filter['empresa'] !== null and $filter['empresa'] !== '') {
          $where[pagoTrabajadorTableClass::EMPRESA_ID] = $filter['empresa'];
        }
        if (isset($filter['fechaIni']) and $filter['fechaIni'] !== null and $filter['fechaIni'] !== '' and ( isset($filter['fechaFin']) and $filter['fechaFin'] !== null and $filter['fechaFin'] !== '')) {
          $where[trabajadorTableClass::CREATED_AT] = array(
              date(config::getFormatTimestamp(), strtotime($filter['fechaIni'] . ' 00:00:00')),
              date(config::getFormatTimestamp(), strtotime($filter['fechaFin'] . ' 23:59:59'))
          );
        }
      }

      $fields = array(
          detallePagoTrabajadorTableClass::ID,
          detallePagoTrabajadorTableClass::VALOR_SALARIO,
          detallePagoTrabajadorTableClass::CANTIDAD_HORAS_EXTRAS,
          detallePagoTrabajadorTableClass::VALOR_HORAS_EXTRAS,
          detallePagoTrabajadorTableClass::HORAS_PERDIDAS,
          detallePagoTrabajadorTableClass::TOTAL_PAGAR,
          detallePagoTrabajadorTableClass::PAGO_TRABAJADOR_ID,
          detallePagoTrabajadorTableClass::TRABAJADOR_ID,
          detallePagoTrabajadorTableClass::CREATED_AT,
          detallePagoTrabajadorTableClass::UPDATED_AT
      );
      $orderBy = array(
          detallePagoTrabajadorTableClass::ID
      );
      $page = 0;
      if (request::getInstance()->hasGet('page')) {
        $this->page = request::getInstance()->getGet('page');
        $page = request::getInstance()->getGet('page') - 1;
        $page = $page * 3;
      }

      $this->cntPages = detallePagoTrabajadorTableClass::getTotalPages(3);
      
      if(request::getInstance()->hasGet(detallePagoTrabajadorTableClass::getNameField(detallePagoTrabajadorTableClass::PAGO_TRABAJADOR_ID, true))){
        
        $pagoTrabajadorTd = request::getInstance()->getGet(detallePagoTrabajadorTableClass::getNameField(detallePagoTrabajadorTableClass::PAGO_TRABAJADOR_ID, true));
      }
      

      $this->objDPT = detallePagoTrabajadorTableClass::getAll($fields, false, $orderBy, 'ASC', 3, $page, $where);
      
       $fields = array(
            pagoTrabajadorTableClass::ID,
            pagoTrabajadorTableClass::FECHA_INICIAL
        );
        $orderBy = array(
            pagoTrabajadorTableClass::FECHA_INICIAL
        );
        $this->objPT = pagoTrabajadorTableClass::getAll($fields, false, $orderBy, 'ASC');

      $fields = array(
          trabajadorTableClass::ID,
          trabajadorTableClass::NOMBRET
      );
      $orderBy = array(
          trabajadorTableClass::NOMBRET
      );
      $this->objTrabajador = trabajadorTableClass::getAll($fields, true, $orderBy, 'ASC');
      $this->defineView('index', 'detallePagoTrabajador', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}
