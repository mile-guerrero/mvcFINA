
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
class updateActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {
        $id = request::getInstance()->getPost(pedidoTableClass::getNameField(pedidoTableClass::ID, true));
        $idEmpresa = request::getInstance()->getPost(pedidoTableClass::getNameField(pedidoTableClass::EMPRESA_ID, true));
        $idProveedor = request::getInstance()->getPost(pedidoTableClass::getNameField(pedidoTableClass::ID_PROVEEDOR, true));
        $cantidad = request::getInstance()->getPost(pedidoTableClass::getNameField(pedidoTableClass::CANTIDAD, true));
        $idProducto = request::getInstance()->getPost(pedidoTableClass::getNameField(pedidoTableClass::PRODUCTO_INSUMO_ID, true));
        
        $ids = array(
            pedidoTableClass::ID => $id
        );
        $data = array(
            pedidoTableClass::EMPRESA_ID => $idEmpresa,
            pedidoTableClass::ID_PROVEEDOR => $idProveedor,
            pedidoTableClass::CANTIDAD => $cantidad,
            pedidoTableClass::PRODUCTO_INSUMO_ID => $idProducto
            
        );
        pedidoTableClass::update($ids, $data);
        session::getInstance()->setSuccess('La actualizacion fue correcta');
        routing::getInstance()->redirect('pedido', 'index');
      }
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}
