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
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class indexProductoInsumoActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      $where = null;
      if(request::getInstance()->hasPost('filter')){
      $filter = request::getInstance()->getPost('filter');
      //validar
      if(isset($filter['descripcion']) and $filter['descripcion'] !== null and $filter['descripcion'] !== ""){
        $where[productoInsumoTableClass::DESCRIPCION] = $filter['descripcion'];
      }
      if(isset($filter['iva']) and $filter['iva'] !== null and $filter['iva'] !== ""){
        $where[productoInsumoTableClass::IVA] = $filter['iva'];
      }
      if((isset($filter['fechaIni']) and $filter['fechaIni'] !== null and $filter['fechaIni'] !== "") and (isset($filter['fechaFin']) and $filter['fechaFin'] !== null and $filter['fechaFin'] !== "" )){
        $where[productoInsumoTableClass::CREATED_AT] = array(
           date(config::getFormatTimestamp(), strtotime($filter['fechaIni'].' 00:00:00')),
           date(config::getFormatTimestamp(), strtotime($filter['fechaFin'].' 23:59:59'))
            );
      }     
      }
      $fields = array(
          productoInsumoTableClass::ID,
          productoInsumoTableClass::DESCRIPCION,
          productoInsumoTableClass::IVA,
          productoInsumoTableClass::UNIDAD_MEDIDA_ID,
          productoInsumoTableClass::TIPO_PRODUCTO_INSUMO_ID,
          productoInsumoTableClass::CREATED_AT,
          productoInsumoTableClass::UPDATED_AT
      );
      $orderBy = array(
         productoInsumoTableClass::ID
      );
      $page = 0;
      if (request::getInstance()->hasGet('page')) {
        $this->page = request::getInstance()->getGet('page');
        $page = request::getInstance()->getGet('page') - 1;
        $page = $page * config::getRowGrid();
      }
      $this->cntPages = productoInsumoTableClass::getTotalPages(config::getRowGrid());
      
      $this->objPI = productoInsumoTableClass::getAll($fields, true, $orderBy, 'ASC',config::getRowGrid(), $page,$where);
      $this->defineView('indexProductoInsumo', 'productoInsumo', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
}

}
