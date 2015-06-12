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
 * @author Andres Bahamon
 */
class createActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

       $descripcion = request::getInstance()->getPost(detalleFacturaCompraTableClass::getNameField(detalleFacturaCompraTableClass::DESCRIPCION, true));
       $cantidad = request::getInstance()->getPost(detalleFacturaCompraTableClass::getNameField(detalleFacturaCompraTableClass::CANTIDAD, true));
       $valorUnidad = request::getInstance()->getPost(detalleFacturaCompraTableClass::getNameField(detalleFacturaCompraTableClass::VALOR_UNIDAD, true));
       $valorTotal = request::getInstance()->getPost(detalleFacturaCompraTableClass::getNameField(detalleFacturaCompraTableClass::VALOR_TOTAL, true));
       $facturaCompra = request::getInstance()->getPost(detalleFacturaCompraTableClass::getNameField(detalleFacturaCompraTableClass::FACTURA_COMPRA_ID, true));
       $idProveedor = request::getInstance()->getPost(detalleFacturaCompraTableClass::getNameField(detalleFacturaCompraTableClass::PROVEEDOR_ID, true));

//        if (strlen($usuario) > usuarioTableClass::USUARIO_LENGTH) {
//          throw new PDOException(i18n::__(00001, null, 'errors', array(':longitud' => usuarioTableClass::USUARIO_LENGTH)), 00001);
//        }

        $data = array(
          detalleFacturaCompraTableClass::DESCRIPCION => $descripcion,
          detalleFacturaCompraTableClass::CANTIDAD => $cantidad,
          detalleFacturaCompraTableClass::VALOR_UNIDAD => $valorUnidad,
          detalleFacturaCompraTableClass::VALOR_TOTAL => $valorTotal,
          detalleFacturaCompraTableClass::FACTURA_COMPRA_ID => $facturaCompra,
          detalleFacturaCompraTableClass::PROVEEDOR_ID => $idProveedor
            
        );
        detalleFacturaCompraTableClass::insert($data);
        session::getInstance()->setSuccess('El registro fue Exitoso');
        routing::getInstance()->redirect('facturaCompra', 'index');
      } else {
        routing::getInstance()->redirect('facturaCompra', 'index');
      }
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}
