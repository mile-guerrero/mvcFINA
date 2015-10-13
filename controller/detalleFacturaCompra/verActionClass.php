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
class verActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
        
        $where = null;
      //$where[detalleFacturaCompraTableClass::FACTURA_ID] = request::getInstance()->getGet(detalleFacturaCompraTableClass::getNameField(detalleFacturaCompraTableClass::FACTURA_ID, true));
      if (request::getInstance()->hasPost('filter')) {
        $filter = request::getInstance()->getPost('filter');
        //Validar datos

//        if (isset($filter['empresa']) and $filter['empresa'] !== null and $filter['empresa'] !== '') {
//          $where[pagoTrabajadorTableClass::EMPRESA_ID] = $filter['empresa'];
//        }
        if (isset($filter['fechaIni']) and $filter['fechaIni'] !== null and $filter['fechaIni'] !== '' and ( isset($filter['fechaFin']) and $filter['fechaFin'] !== null and $filter['fechaFin'] !== '')) {
          $where[detalleFacturaCompraTableClass::CREATED_AT] = array(
              date(config::getFormatTimestamp(), strtotime($filter['fechaIni'] . ' 00:00:00')),
              date(config::getFormatTimestamp(), strtotime($filter['fechaFin'] . ' 23:59:59'))
          );
        }
      session::getInstance()->setAttribute('detalleFacturaCompraIndexFilters', $where);
       } else if(session::getInstance()->hasAttribute('detalleFacturaCompraIndexFilters')){
        $where = session::getInstance()->getAttribute('detalleFacturaCompraIndexFilters');
      session::getInstance()->setAttribute('facturaCompraIndexFilters', $where);
       }else if(session::getInstance()->hasAttribute('facturaCompraIndexFilters')){
        $where = session::getInstance()->getAttribute('facturaCompraIndexFilters');
     }
        
        $idFactura = request::getInstance()->getRequest(facturaCompraTableClass::ID, true);
        $fieldsFactura = array(
          facturaCompraTableClass::ID,
          facturaCompraTableClass::FECHA,
          facturaCompraTableClass::PROVEEDOR_ID
      );

      $whereFactura = array(
          facturaCompraTableClass::ID => request::getInstance()->getRequest(facturaCompraTableClass::ID)
              
        );
      
      $page = 0;
      if (request::getInstance()->hasGet('page')) {
        $this->page = request::getInstance()->getGet('page');
        $page = request::getInstance()->getGet('page') - 1;
        $page = $page * config::getRowGrid();
      }//cierre del if del paguinado
      $this->cntPages = facturaCompraTableClass::getTotalPages(config::getRowGrid(), $where);
      
      
     
      
       $this->objFactura = facturaCompraTableClass::getAll($fieldsFactura, false, null, null, config::getRowGrid(), $page, $whereFactura);
      
      $idDetalle = request::getInstance()->getRequest(detalleFacturaCompraTableClass::ID, true);
      $fields = array(
          detalleFacturaCompraTableClass::ID,
          detalleFacturaCompraTableClass::DESCRIPCION,
          detalleFacturaCompraTableClass::CANTIDAD,
          detalleFacturaCompraTableClass::VALOR_UNIDAD,
          detalleFacturaCompraTableClass::VALOR_TOTAL,
          detalleFacturaCompraTableClass::FACTURA_COMPRA_ID,
          detalleFacturaCompraTableClass::UNIDAD_MEDIDA_ID,
          detalleFacturaCompraTableClass::CREATED_AT,
          detalleFacturaCompraTableClass::UPDATED_AT
      );

      $where = array(
          detalleFacturaCompraTableClass::FACTURA_COMPRA_ID =>$idDetalle 
      );
       $page = 0;
      if (request::getInstance()->hasGet('page')) {
        $this->page = request::getInstance()->getGet('page');
        $page = request::getInstance()->getGet('page') - 1;
        $page = $page * config::getRowGrid();
      }//cierre del if del paguinado
      $this->cntPages = detalleFacturaCompraTableClass::getTotalPages(config::getRowGrid(), $where);
      $this->objDetalleFactura = detalleFacturaCompraTableClass::getAll($fields, false, null, null, config::getRowGrid(), $page, $where);
//      $this->detalleFacturaId = request::getInstance()->getGet(detalleFacturaCompraTableClass::getNameField(detalleFacturaCompraTableClass::FACTURA_COMPRA_ID, true));
      
      
      
      $this->defineView('ver', 'detalleFacturaCompra', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}
