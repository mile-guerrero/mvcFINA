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
        $idFactura = request::getInstance()->getRequest(facturaVentaTableClass::ID, true);
        $fieldsFactura = array(
          facturaVentaTableClass::ID,
          facturaVentaTableClass::FECHA
          
      );

      $whereFactura = array(
          facturaVentaTableClass::ID => request::getInstance()->getRequest(facturaVentaTableClass::ID)
              
        );
      
       $this->objFactura = facturaVentaTableClass::getAll($fieldsFactura, false, null, null, null, null, $whereFactura);
      
      $idDetalle = request::getInstance()->getRequest(detalleFacturaVentaTableClass::ID, true);
      $fields = array(
          detalleFacturaVentaTableClass::ID,
          detalleFacturaVentaTableClass::DESCRIPCION,
          detalleFacturaVentaTableClass::CANTIDAD,
          detalleFacturaVentaTableClass::VALOR_UNIDAD,
          detalleFacturaVentaTableClass::VALOR_TOTAL,
          detalleFacturaVentaTableClass::CLIENTE_ID,
          detalleFacturaVentaTableClass::FACTURA_ID,
          detalleFacturaVentaTableClass::CREATED_AT,
          detalleFacturaVentaTableClass::UPDATED_AT
      );

      $where = array(
          detalleFacturaVentaTableClass::FACTURA_ID =>$idDetalle 
      );
      $this->objDetalleFactura = detalleFacturaVentaTableClass::getAll($fields, false, null, null, null, null, $where);
      
      
      
     
      
      $this->defineView('ver', 'detalleFacturaVenta', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}
