
<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\DetalleFacturaVentaValidatorUpdateClass as validator;

/**
 * Description of ejemploClass
 *
 * @author 
 */
class updateActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {
       $idDetalle = request::getInstance()->getPost(detalleFacturaVentaTableClass::getNameField(detalleFacturaVentaTableClass::ID, true));
       $descripcion = request::getInstance()->getPost(detalleFacturaVentaTableClass::getNameField(detalleFacturaVentaTableClass::DESCRIPCION, true));
       $cantidad = request::getInstance()->getPost(detalleFacturaVentaTableClass::getNameField(detalleFacturaVentaTableClass::CANTIDAD, true));
       $valor_unidad = request::getInstance()->getPost(detalleFacturaVentaTableClass::getNameField(detalleFacturaVentaTableClass::VALOR_UNIDAD, true));
       $valor_total = request::getInstance()->getPost(detalleFacturaVentaTableClass::getNameField(detalleFacturaVentaTableClass::VALOR_TOTAL, true));
       $factura = request::getInstance()->getPost(detalleFacturaVentaTableClass::getNameField(detalleFacturaVentaTableClass::FACTURA_ID, true));
       $idCliente = request::getInstance()->getPost(detalleFacturaVentaTableClass::getNameField(detalleFacturaVentaTableClass::CLIENTE_ID, true));

       
        $ids = array(
            detalleFacturaVentaTableClass::ID => $idDetalle
        );
        $data = array(
            
          detalleFacturaVentaTableClass::DESCRIPCION => $descripcion,
          detalleFacturaVentaTableClass::CANTIDAD => $cantidad,
          detalleFacturaVentaTableClass::VALOR_UNIDAD => $valor_unidad,
          detalleFacturaVentaTableClass::VALOR_TOTAL => $valor_total,
          detalleFacturaVentaTableClass::FACTURA_ID => $factura,
          detalleFacturaVentaTableClass::CLIENTE_ID => $idCliente
            
        );
        detalleFacturaVentaTableClass::update($ids, $data);
        session::getInstance()->setSuccess('La actualizacion fue exitosa');
        routing::getInstance()->redirect('facturaVenta', 'index');
      }
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}

