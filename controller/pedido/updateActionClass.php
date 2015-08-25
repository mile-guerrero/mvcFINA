
<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\pedidoValidatorUpdateClass as validator;
use hook\log\logHookClass as log;

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
        
        validator::validateUpdate();
        
        if($cantidad <= 0){
                session::getInstance()->setFlash('inputCantidad', true);
                session::getInstance()->setError('Los valores numericos no pueden ser negativos', 'inputCantidad');
                request::getInstance()->setMethod('GET');
                request::getInstance()->addParamGet(array(\pedidoTableClass::ID => request::getInstance()->getPost(\pedidoTableClass::getNameField(\pedidoTableClass::ID, true))));
                routing::getInstance()->forward('pedido', 'edit');
            }
        
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
        $observacion ='se ha modificado el pedido';
        log::register('Modificar', pedidoTableClass::getNameTable(),$observacion,$id);
        routing::getInstance()->redirect('pedido', 'index');
      }
    } catch (PDOException $exc) {
      routing::getInstance()->redirect('pedido', 'edit');
      session::getInstance()->setFlash('exc', $exc);
    }
  }

}
