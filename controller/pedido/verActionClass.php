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
class verActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      $fields = array(
          pedidoTableClass::ID,
          pedidoTableClass::EMPRESA_ID,
          pedidoTableClass::ID_PROVEEDOR,
          pedidoTableClass::CANTIDAD,
          pedidoTableClass::PRODUCTO_INSUMO_ID,
          pedidoTableClass::CREATED_AT,
          pedidoTableClass::UPDATED_AT
      );
      
       $where = array(
            pedidoTableClass::ID => request::getInstance()->getRequest(pedidoTableClass::ID)
        );
      $this->objPedido = pedidoTableClass::getAll($fields, true, null, null, null, null, $where);
//     $orderBy = array(
//         usuarioTableClass::ID
//      );
//      $this->objUsuarios = usuarioTableClass::getAll($fields, true, $orderBy);

      $this->defineView('ver', 'pedido', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
}

}
