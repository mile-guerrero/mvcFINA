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
      //$where[detalleFacturaVentaTableClass::FACTURA_ID] = request::getInstance()->getGet(detalleFacturaVentaTableClass::getNameField(detalleFacturaVentaTableClass::FACTURA_ID, true));
      if (request::getInstance()->hasPost('filter')) {
        $filter = request::getInstance()->getPost('filter');
        //Validar datos

//        if (isset($filter['empresa']) and $filter['empresa'] !== null and $filter['empresa'] !== '') {
//          $where[pagoTrabajadorTableClass::EMPRESA_ID] = $filter['empresa'];
//        }
        if (isset($filter['fechaIni']) and $filter['fechaIni'] !== null and $filter['fechaIni'] !== '' and ( isset($filter['fechaFin']) and $filter['fechaFin'] !== null and $filter['fechaFin'] !== '')) {
          $where[detalleFacturaVentaTableClass::CREATED_AT] = array(
              date(config::getFormatTimestamp(), strtotime($filter['fechaIni'] . ' 00:00:00')),
              date(config::getFormatTimestamp(), strtotime($filter['fechaFin'] . ' 23:59:59'))
          );
        }
      }

      $fields = array(
          detalleFacturaVentaTableClass::ID,
          detalleFacturaVentaTableClass::DESCRIPCION,
          detalleFacturaVentaTableClass::CANTIDAD,
          detalleFacturaVentaTableClass::VALOR_UNIDAD,
          detalleFacturaVentaTableClass::VALOR_TOTAL,
          detalleFacturaVentaTableClass::FACTURA_ID,
          detalleFacturaVentaTableClass::CREATED_AT,
          detalleFacturaVentaTableClass::UPDATED_AT
      );
      $orderBy = array(
          detalleFacturaVentaTableClass::ID
      );
     
 
      $this->objDetalleFactura = detalleFacturaVentaTableClass::getAll($fields, false, $orderBy, 'ASC', null, null, $where);
      
       $fields = array(
           facturaVentaTableClass::ID,
           facturaVentaTableClass::FECHA
        );
        $orderBy = array(
            facturaVentaTableClass::FECHA
        );
        
//        $where = array(
//        facturaTableClass::ID => request::getInstance()->getRequest(facturaTableClass::ID)
//      );
        
        $this->objFactura = facturaVentaTableClass::getAll($fields, false, $orderBy, 'ASC');

        
      $this->defineView('index', 'detalleFacturaVenta', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}
