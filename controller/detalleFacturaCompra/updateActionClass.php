
<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\detalleFacturaCompraValidatorUpdateClass as validator;

/**
 * Description of ejemploClass
 *
 * @author 
 */
class updateActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {
       $idDetalle = request::getInstance()->getPost(detalleFacturaCompraTableClass::getNameField(detalleFacturaCompraTableClass::ID, true));
       $descripcion = request::getInstance()->getPost(detalleFacturaCompraTableClass::getNameField(detalleFacturaCompraTableClass::DESCRIPCION, true));
       $cantidad = request::getInstance()->getPost(detalleFacturaCompraTableClass::getNameField(detalleFacturaCompraTableClass::CANTIDAD, true));
       $valorUnidad = request::getInstance()->getPost(detalleFacturaCompraTableClass::getNameField(detalleFacturaCompraTableClass::VALOR_UNIDAD, true));
       $valorTotal = request::getInstance()->getPost(detalleFacturaCompraTableClass::getNameField(detalleFacturaCompraTableClass::VALOR_TOTAL, true));
       $facturaCompra = request::getInstance()->getPost(detalleFacturaCompraTableClass::getNameField(detalleFacturaCompraTableClass::FACTURA_COMPRA_ID, true));
       $idProveedor = request::getInstance()->getPost(detalleFacturaCompraTableClass::getNameField(detalleFacturaCompraTableClass::PROVEEDOR_ID, true));

       validator::validateUpdate();
       
        $ids = array(
            detalleFacturaCompraTableClass::ID => $idDetalle
        );
        $data = array(
            
          detalleFacturaCompraTableClass::DESCRIPCION => $descripcion,
          detalleFacturaCompraTableClass::CANTIDAD => $cantidad,
          detalleFacturaCompraTableClass::VALOR_UNIDAD => $valorUnidad,
          detalleFacturaCompraTableClass::VALOR_TOTAL => $valorTotal,
          detalleFacturaCompraTableClass::FACTURA_COMPRA_ID => $facturaCompra,
          detalleFacturaCompraTableClass::PROVEEDOR_ID => $idProveedor
            
        );
        detalleFacturaCompraTableClass::update($ids, $data);
        session::getInstance()->setSuccess('La actualizacion fue exitosa');
        routing::getInstance()->redirect('facturaCompra', 'index');
      }
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}

