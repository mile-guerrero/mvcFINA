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
      
      
      //fin validaciones
      if(isset($filter['descripcion']) and $filter['descripcion'] !== null and $filter['descripcion'] !== ""){
        $where[] = '(' . productoInsumoTableClass::getNameField(productoInsumoTableClass::DESCRIPCION) . ' LIKE ' . '\'' . $filter['descripcion'] . '%\'  '
              . 'OR ' . productoInsumoTableClass::getNameField(productoInsumoTableClass::DESCRIPCION) . ' LIKE ' . '\'%' . $filter['descripcion'] . '%\' '
              . 'OR ' . productoInsumoTableClass::getNameField(productoInsumoTableClass::DESCRIPCION) . ' LIKE ' . '\'%' . $filter['descripcion'].'\') ';       
              }              
     
      if((isset($filter['fechaIni']) and $filter['fechaIni'] !== null and $filter['fechaIni'] !== "") and (isset($filter['fechaFin']) and $filter['fechaFin'] !== null and $filter['fechaFin'] !== "" )){
        $where[productoInsumoTableClass::CREATED_AT] = array(
           date(config::getFormatTimestamp(), strtotime($filter['fechaIni'].' 00:00:00')),
           date(config::getFormatTimestamp(), strtotime($filter['fechaFin'].' 23:59:59'))
            );
      }
      
      if(isset($filter['unidadMedida']) and $filter['unidadMedida'] !== null and $filter['unidadMedida'] !== ""){
        $where[productoInsumoTableClass::UNIDAD_MEDIDA_ID] = $filter['unidadMedida'];
      }
      
      if(isset($filter['tipoInsumo']) and $filter['tipoInsumo'] !== null and $filter['tipoInsumo'] !== ""){
        $where[productoInsumoTableClass::TIPO_PRODUCTO_INSUMO_ID] = $filter['tipoInsumo'];
      }
      }
      $fields = array(
          productoInsumoTableClass::ID,
          productoInsumoTableClass::DESCRIPCION,
          productoInsumoTableClass::NOMBRE_IMAGEN,
          productoInsumoTableClass::EXTENCION_IMAGEN,
          productoInsumoTableClass::HASH_IMAGEN,
          productoInsumoTableClass::CANTIDAD,
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
    
      $fields = array(     
      unidadMedidaTableClass::ID, 
      unidadMedidaTableClass::DESCRIPCION
      );
      $orderBy = array(
      unidadMedidaTableClass::DESCRIPCION    
      ); 
      $this->objPIUM = unidadMedidaTableClass::getAll($fields, false, $orderBy, 'ASC');
      
      $fields = array(     
      tipoProductoInsumoTableClass::ID, 
      tipoProductoInsumoTableClass::DESCRIPCION
      );
      $orderBy = array(
      tipoProductoInsumoTableClass::DESCRIPCION    
      ); 
      $this->objPITPI = tipoProductoInsumoTableClass::getAll($fields, true, $orderBy, 'ASC');
     
      
      
      $this->defineView('indexProductoInsumo', 'productoInsumo', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
}

}
