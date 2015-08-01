<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\detalleFacturaVentaValidatorClass as validator;

/**
 * Description of ejemploClass
 *
 * @author Andres Bahamon
 */
class createActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

       $descripcion = request::getInstance()->getPost(detalleFacturaVentaTableClass::getNameField(detalleFacturaVentaTableClass::DESCRIPCION, true));
       $cantidad = request::getInstance()->getPost(detalleFacturaVentaTableClass::getNameField(detalleFacturaVentaTableClass::CANTIDAD, true));
       $valor_unidad = request::getInstance()->getPost(detalleFacturaVentaTableClass::getNameField(detalleFacturaVentaTableClass::VALOR_UNIDAD, true));
       $valor_total = request::getInstance()->getPost(detalleFacturaVentaTableClass::getNameField(detalleFacturaVentaTableClass::VALOR_TOTAL, true));
       $factura = request::getInstance()->getPost(detalleFacturaVentaTableClass::getNameField(detalleFacturaVentaTableClass::FACTURA_ID, true));
                    
       validator::validateInsert();


        $data = array(
          detalleFacturaVentaTableClass::DESCRIPCION => $descripcion,
          detalleFacturaVentaTableClass::CANTIDAD => $cantidad,
          detalleFacturaVentaTableClass::VALOR_UNIDAD => $valor_unidad,
          detalleFacturaVentaTableClass::VALOR_TOTAL => $valor_total,
          detalleFacturaVentaTableClass::FACTURA_ID => $factura
            
        );
        detalleFacturaVentaTableClass::insert($data);
        session::getInstance()->setSuccess('El registro fue Exitoso');
        routing::getInstance()->redirect('facturaVenta', 'index');
      } else {
        routing::getInstance()->redirect('facturaVenta', 'index');
      }
    } catch (PDOException $exc) {
      routing::getInstance()->redirect('detalleFacturaVenta', 'insert');
      session::getInstance()->setFlash('exc', $exc);
    }
  }

}
