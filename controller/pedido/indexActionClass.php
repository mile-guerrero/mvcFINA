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
      if(request::getInstance()->hasPost('filter')){
      $filter = request::getInstance()->getPost('filter');
      //validar
      if(isset($filter['empresa']) and $filter['empresa'] !== null and $filter['empresa'] !== ""){
        $where[pedidoTableClass::EMPRESA_ID] = $filter['empresa'];
      }
      if(isset($filter['proveedor']) and $filter['proveedor'] !== null and $filter['proveedor'] !== ""){
        $where[pedidoTableClass::ID_PROVEEDOR] = $filter['proveedor'];
      }
       if((isset($filter['fechaIni']) and $filter['fechaIni'] !== null and $filter['fechaIni'] !== "") and (isset($filter['fechaFin']) and $filter['fechaFin'] !== null and $filter['fechaFin'] !== "" )){
        $where[pedidoTableClass::CREATED_AT] = array(
           date(config::getFormatTimestamp(), strtotime($filter['fechaIni'].' 00:00:00')),
           date(config::getFormatTimestamp(), strtotime($filter['fechaFin'].' 23:59:59'))
            );
      }     
//       session::getInstance()->setAttribute('pedidoIndexFilters', $where);
//       }else if(session::getInstance()->hasAttribute('pedidoIndexFilters')){
//        $where = session::getInstance()->getAttribute('pedidoIndexFilters');
//    
        }
      $fields = array(
          pedidoTableClass::ID,
          pedidoTableClass::EMPRESA_ID,
          pedidoTableClass::PRODUCTO_INSUMO_ID,
          pedidoTableClass::CANTIDAD,
          pedidoTableClass::ID_PROVEEDOR,
	  pedidoTableClass::CREATED_AT,
          pedidoTableClass::UPDATED_AT
      );
      $orderBy = array(
         pedidoTableClass::ID
      );
     $page = 0;
      if (request::getInstance()->hasGet('page')) {
        $this->page = request::getInstance()->getGet('page');
        $page = request::getInstance()->getGet('page') - 1;
        $page = $page * config::getRowGrid();
      }
      $this->cntPages = pedidoTableClass::getTotalPages(config::getRowGrid(), $where);
      
      $this->objPedido = pedidoTableClass::getAll($fields, true, $orderBy, 'ASC',config::getRowGrid(), $page, $where);
      
      $fields = array(
            empresaTableClass::ID,
            empresaTableClass::NOMBRE
        );
        $orderBy = array(
            empresaTableClass::NOMBRE
        );
        
        $this->objEmpresa = empresaTableClass::getAll($fields, true, $orderBy, 'ASC');
        
        $fields = array(
            proveedorTableClass::ID,
            proveedorTableClass::NOMBREP
        );
        $orderBy = array(
            proveedorTableClass::NOMBREP
        );
        $this->objProveedor = proveedorTableClass::getAll($fields, true, $orderBy, 'ASC');
        
      $this->defineView('index', 'pedido', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
       routing::getInstance()->redirect('pedido', 'index');
//      echo $exc->getMessage();
//      echo '<br>';
//      echo $exc->getTraceAsString();
    }
}

}
