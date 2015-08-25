<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\pedidoValidatorClass as validator;
use hook\log\logHookClass as log;

/**
 * Description of ejemploClass
 *
 * @author 
 */
class createActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $idEmpresa = request::getInstance()->getPost(pedidoTableClass::getNameField(pedidoTableClass::EMPRESA_ID, true));
        $idProveedor = request::getInstance()->getPost(pedidoTableClass::getNameField(pedidoTableClass::ID_PROVEEDOR, true));
        $cantidad = request::getInstance()->getPost(pedidoTableClass::getNameField(pedidoTableClass::CANTIDAD, true));
        $idProducto = request::getInstance()->getPost(pedidoTableClass::getNameField(pedidoTableClass::PRODUCTO_INSUMO_ID, true));
        
        validator::validateInsert();
        
        if($cantidad <= 0){
                session::getInstance()->setFlash('inputCantidad', true);
                session::getInstance()->setError('Los valores numericos no pueden ser negativos', 'inputCantidad');
                routing::getInstance()->forward('pedido', 'insert');
            }

        $data = array(
            pedidoTableClass::EMPRESA_ID => $idEmpresa,
            pedidoTableClass::ID_PROVEEDOR => $idProveedor,
            pedidoTableClass::CANTIDAD => $cantidad,
            pedidoTableClass::PRODUCTO_INSUMO_ID => $idProducto,
            '__sequence' => 'pedido_id_seq'
          
        );
        $id = pedidoTableClass::insert($data);
        session::getInstance()->setSuccess('El registro fue exitoso');
        $observacion ='se ha insertando un nuevo pedido';
        log::register('Insertar', pedidoTableClass::getNameTable(),$observacion,$id);
        routing::getInstance()->redirect('pedido', 'index');
      } else {
        routing::getInstance()->redirect('pedido', 'index');
      }
    } catch (PDOException $exc) {
      routing::getInstance()->redirect('pedido', 'insert');
      session::getInstance()->setFlash('exc', $exc);
    }
  }
}
