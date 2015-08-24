<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\pagoTrabajadorValidatorClass as validator;

/**
 * Description of ejemploClass
 *
 * @author 
 */
class indexActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      
       $where = null;
      if (request::getInstance()->hasPost('filter')) {
        $filter = request::getInstance()->getPost('filter');
        //Validar datos
        
        
        if ((isset($filter[pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::CREATED_AT, true) . '_1']) and empty($filter[pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::CREATED_AT, true) . '_1']) === false) and ( isset($filter[pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::CREATED_AT, true) . '_2']) and empty($filter[pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::CREATED_AT, true) . '_2']) === false)) {
          if (request::getInstance()->isMethod('POST')) {

            $fechaInicial = $filter[pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::CREATED_AT, true) . '_1'];
            $fechaFin = $filter[pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::CREATED_AT, true) . '_2'];

            validator::validateFiltroFecha($fechaInicial, $fechaFin);

            if ((isset($fechaInicial) and $fechaInicial !== null and $fechaInicial !== "") and ( isset($fechaFin) and $fechaFin !== null and $fechaFin !== "" )) {
              $where[] = '(' . pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::CREATED_AT) . ' BETWEEN ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaInicial . ' 00:00:00')) . "'" . ' AND ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaFin . ' 23:59:59')) . "'" . ' ) ';
            }
          }
        }
        
       
        if(isset($filter['empresa']) and $filter['empresa'] !== null and $filter['empresa'] !== ""){
        $where[pagoTrabajadorTableClass::EMPRESA_ID] = $filter['empresa'];
        }
        
//       session::getInstance()->setAttribute('pagoTrabajadorIndexFilters', $where);
//       }else if(session::getInstance()->hasAttribute('pagoTrabajadorIndexFilters')){
//        $where = session::getInstance()->getAttribute('pagoTrabajadorIndexFilters');
//    
        }
      
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
       $page = 0;
      if (request::getInstance()->hasGet('page')) {
        $this->page = request::getInstance()->getGet('page');
        $page = request::getInstance()->getGet('page') - 1;
        $page = $page * config::getRowGrid();
      }//cierre del if del paguinado

      $this->cntPages = pagoTrabajadorTableClass::getTotalPages(config::getRowGrid(), $where);
      
      $this->objPT = pagoTrabajadorTableClass::getAll($fields, false, $orderBy, 'ASC',  config::getRowGrid(), $page, $where);
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
      routing::getInstance()->redirect('pagoTrabajador', 'index');
//      echo $exc->getMessage();
//      echo '<br>';
//      echo $exc->getTraceAsString();
    }
}

}

