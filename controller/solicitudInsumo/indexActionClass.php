<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\solicitudInsumoValidatorClass as validator;

/**
 * Description of ejemploClass
 *
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
 */
class indexActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      
      $where = null;
      if (request::getInstance()->hasPost('filter')) {
        $filter = request::getInstance()->getPost('filter');
        //Validar datos
        
        if ((isset($filter[solicitudInsumoTableClass::getNameField(solicitudInsumoTableClass::CREATED_AT, true) . '_1']) and empty($filter[solicitudInsumoTableClass::getNameField(solicitudInsumoTableClass::CREATED_AT, true) . '_1']) === false) and ( isset($filter[solicitudInsumoTableClass::getNameField(solicitudInsumoTableClass::CREATED_AT, true) . '_2']) and empty($filter[solicitudInsumoTableClass::getNameField(solicitudInsumoTableClass::CREATED_AT, true) . '_2']) === false)) {
          if (request::getInstance()->isMethod('POST')) {

            $fechaInicial = $filter[solicitudInsumoTableClass::getNameField(solicitudInsumoTableClass::CREATED_AT, true) . '_1'];
            $fechaFin = $filter[solicitudInsumoTableClass::getNameField(solicitudInsumoTableClass::CREATED_AT, true) . '_2'];

            validator::validateFiltroFecha($fechaInicial, $fechaFin);

            if ((isset($fechaInicial) and $fechaInicial !== null and $fechaInicial !== "") and ( isset($fechaFin) and $fechaFin !== null and $fechaFin !== "" )) {
              $where[] = '(' . solicitudInsumoTableClass::getNameField(solicitudInsumoTableClass::CREATED_AT) . ' BETWEEN ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaInicial . ' 00:00:00')) . "'" . ' AND ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaFin . ' 23:59:59')) . "'" . ' ) ';
            }
          }
        }
        
        if(isset($filter['lote']) and $filter['lote'] !== null and $filter['lote'] !== ""){
        $where[solicitudInsumoTableClass::LOTE_ID] = $filter['lote'];
        }
      
//      session::getInstance()->setAttribute('solicitudInsumoIndexFilters', $where);
//       }else if(session::getInstance()->hasAttribute('solicitudInsumoIndexFilters')){
//        $where = session::getInstance()->getAttribute('solicitudInsumoIndexFilters');
//     
        
       }
      
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
      
      $page = 0;
      if (request::getInstance()->hasGet('page')) {
        $this->page = request::getInstance()->getGet('page');
        $page = request::getInstance()->getGet('page') - 1;
        $page = $page * config::getRowGrid();
      }
      $this->cntPages = solicitudInsumoTableClass::getTotalPages(config::getRowGrid(), $where);
      $this->objS = solicitudInsumoTableClass::getAll($fields, true, $orderBy, 'ASC', config::getRowGrid(), $page, $where);
      
       $fields = array(
      trabajadorTableClass::ID,
      trabajadorTableClass::NOMBRET
      );
      $orderBy = array(
      trabajadorTableClass::NOMBRET   
      );      
      $this->objT = trabajadorTableClass::getAll($fields, true, $orderBy, 'ASC');
      
      $fields = array(
          productoInsumoTableClass::ID,
          productoInsumoTableClass::DESCRIPCION
      );
      $orderBy = array(
          productoInsumoTableClass::DESCRIPCION
      );
      $this->objP = productoInsumoTableClass::getAll($fields, true, $orderBy, 'ASC');

      $fields = array(
          loteTableClass::ID,
          loteTableClass::UBICACION
      );
      $orderBy = array(
          loteTableClass::UBICACION
      );
      $this->objLote = loteTableClass::getAll($fields, true, $orderBy, 'ASC');
    
      $this->defineView('index', 'solicitudInsumo', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      routing::getInstance()->redirect('solicitudInsumo', 'index');
//      echo $exc->getMessage();
//      echo '<br>';
//      echo $exc->getTraceAsString();
    }
}

}
