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
        $idFactura = request::getInstance()->getRequest(facturaCompraTableClass::ID, true);
        $fieldsFactura = array(
          facturaCompraTableClass::ID,
          facturaCompraTableClass::FECHA
          
      );

      $whereFactura = array(
          facturaCompraTableClass::ID => request::getInstance()->getRequest(facturaCompraTableClass::ID)
              
        );
      
       $this->objFactura = facturaCompraTableClass::getAll($fieldsFactura, false, null, null, null, null, $whereFactura);
      
      $idDetalle = request::getInstance()->getRequest(detalleFacturaCompraTableClass::ID, true);
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

      $where = array(
          detalleFacturaCompraTableClass::FACTURA_COMPRA_ID =>$idDetalle 
      );
      $this->objDetalleFactura = detalleFacturaCompraTableClass::getAll($fields, false, null, null, null, null, $where);
      
      
      
     
      
      $this->defineView('ver', 'detalleFacturaCompra', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}
