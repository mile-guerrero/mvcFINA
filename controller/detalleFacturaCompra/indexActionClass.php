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
      }

      $fields = array(
          detalleFacturaCompraTableClass::ID,
          detalleFacturaCompraTableClass::DESCRIPCION,
          detalleFacturaCompraTableClass::CANTIDAD,
          detalleFacturaCompraTableClass::VALOR_UNIDAD,
          detalleFacturaCompraTableClass::VALOR_TOTAL,
          detalleFacturaCompraTableClass::PROVEEDOR_ID,
          detalleFacturaCompraTableClass::FACTURA_COMPRA_ID,
          detalleFacturaCompraTableClass::CREATED_AT,
          detalleFacturaCompraTableClass::UPDATED_AT
      );
      $orderBy = array(
          detalleFacturaCompraTableClass::ID
      );
      $page = 0;
      if (request::getInstance()->hasGet('page')) {
        $this->page = request::getInstance()->getGet('page');
        $page = request::getInstance()->getGet('page') - 1;
        $page = $page * 3;
      }

      $this->cntPages = detalleFacturaCompraTableClass::getTotalPages(3);
      
      if(request::getInstance()->hasGet(detalleFacturaCompraTableClass::getNameField(detalleFacturaCompraTableClass::FACTURA_ID, true))){
        
        $pagoTrabajadorTd = request::getInstance()->getGet(detalleFacturaCompraTableClass::getNameField(detalleFacturaCompraTableClass::FACTURA_ID, true));
      }
      

      $this->objDetalleFactura = detalleFacturaCompraTableClass::getAll($fields, false, $orderBy, 'ASC', 3, $page, $where);
      
       $fields = array(
           facturaCompraTableClass::ID,
           facturaCompraTableClass::FECHA
        );
        $orderBy = array(
            facturaCompraTableClass::FECHA
        );
        
//        $where = array(
//        facturaTableClass::ID => request::getInstance()->getRequest(facturaTableClass::ID)
//      );
        
        $this->objFactura = facturaCompraTableClass::getAll($fields, false, $orderBy, 'ASC');

      $fields = array(
              proveedorTableClass::ID,
              proveedorTableClass::NOMBREP
      );
      $orderBy = array(
          proveedorTableClass::NOMBREP
      );
      $this->objProveedor = proveedorTableClass::getAll($fields, true, $orderBy, 'ASC');
      $this->defineView('index', 'detalleFacturaCompra', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}
