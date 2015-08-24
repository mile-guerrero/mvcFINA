<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\ordenServicioValidatorClass as validator;

/**
 * Description of ejemploClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class indexActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
        $where = null;
      if (request::getInstance()->hasPost('filter')) {
        $filter = request::getInstance()->getPost('filter');
        //Validar datos
if ((isset($filter[ordenServicioTableClass::getNameField(ordenServicioTableClass::CREATED_AT, true) . '_1']) and empty($filter[ordenServicioTableClass::getNameField(ordenServicioTableClass::CREATED_AT, true) . '_1']) === false) and ( isset($filter[ordenServicioTableClass::getNameField(ordenServicioTableClass::CREATED_AT, true) . '_2']) and empty($filter[ordenServicioTableClass::getNameField(ordenServicioTableClass::CREATED_AT, true) . '_2']) === false)) {
          if (request::getInstance()->isMethod('POST')) {

            $fechaInicial = $filter[ordenServicioTableClass::getNameField(ordenServicioTableClass::CREATED_AT, true) . '_1'];
            $fechaFin = $filter[ordenServicioTableClass::getNameField(ordenServicioTableClass::CREATED_AT, true) . '_2'];

            validator::validateFiltroFecha($fechaInicial, $fechaFin);

            if ((isset($fechaInicial) and $fechaInicial !== null and $fechaInicial !== "") and ( isset($fechaFin) and $fechaFin !== null and $fechaFin !== "" )) {
              $where[] = '(' . ordenServicioTableClass::getNameField(ordenServicioTableClass::CREATED_AT) . ' BETWEEN ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaInicial . ' 00:00:00')) . "'" . ' AND ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaFin . ' 23:59:59')) . "'" . ' ) ';
            }
          }
        }
      
        if (isset($filter['trabajador']) and $filter['trabajador'] !== null and $filter['trabajador'] !== '') {
          $where[ordenServicioTableClass::TRABAJADOR_ID] = $filter['trabajador'];
        }
        
//      session::getInstance()->setAttribute('ordenServicioIndexFilters', $where);
//       }else if(session::getInstance()->hasAttribute('ordenServicioIndexFilters')){
//        $where = session::getInstance()->getAttribute('ordenServicioIndexFilters');
//    
        }
      $fields = array(
          ordenServicioTableClass::ID,
          ordenServicioTableClass::FECHA_MANTENIMIENTO,
          ordenServicioTableClass::TRABAJADOR_ID,
          ordenServicioTableClass::PRODUCTO_INSUMO_ID,
          ordenServicioTableClass::CANTIDAD,
          ordenServicioTableClass::VALOR,
          ordenServicioTableClass::MAQUINA_ID,
          ordenServicioTableClass::CREATED_AT,
          ordenServicioTableClass::UPDATED_AT
      );
      $orderBy = array(
         ordenServicioTableClass::ID
      );
       $page = 0;
      if (request::getInstance()->hasGet('page')) {
        $this->page = request::getInstance()->getGet('page');
        $page = request::getInstance()->getGet('page') - 1;
        $page = $page * config::getRowGrid();
      }
      $this->cntPages = ordenServicioTableClass::getTotalPages(config::getRowGrid(), $where);
      $this->objOS = ordenServicioTableClass::getAll($fields, false, $orderBy, 'ASC', config::getRowGrid(), $page, $where);
      $fields = array(
      trabajadorTableClass::ID,
      trabajadorTableClass::NOMBRET
      );
      $orderBy = array(
      trabajadorTableClass::NOMBRET   
      );      
      $this->objOST = trabajadorTableClass::getAll($fields, true, $orderBy, 'ASC');
       
      $this->defineView('index', 'ordenServicio', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      routing::getInstance()->redirect('ordenServicio', 'index');
//      echo $exc->getMessage();
//      echo '<br>';
//      echo $exc->getTraceAsString();
    }
}

}
