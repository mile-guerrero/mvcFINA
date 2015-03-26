
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
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class updateActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {
        $id = request::getInstance()->getPost(detalleOrdenServicioTableClass::getNameField(detalleOrdenServicioTableClass::ID, true));
        $orden = request::getInstance()->getPost(detalleOrdenServicioTableClass::getNameField(detalleOrdenServicioTableClass::ORDEN_SERVICIO_ID, true));
        $producto = request::getInstance()->getPost(detalleOrdenServicioTableClass::getNameField(detalleOrdenServicioTableClass::PRODUCTO_INSUMO_ID, true));
        $cantidad = request::getInstance()->getPost(detalleOrdenServicioTableClass::getNameField(detalleOrdenServicioTableClass::CANTIDAD, true));
        $valor = request::getInstance()->getPost(detalleOrdenServicioTableClass::getNameField(detalleOrdenServicioTableClass::VALOR, true));
        $maquina = request::getInstance()->getPost(detalleOrdenServicioTableClass::getNameField(detalleOrdenServicioTableClass::MAQUINA_ID, true));
        
        $ids = array(
            detalleOrdenServicioTableClass::ID => $id
        );
        $data = array(
            detalleOrdenServicioTableClass::ORDEN_SERVICIO_ID => $orden,
            detalleOrdenServicioTableClass::PRODUCTO_INSUMO_ID => $producto,
            detalleOrdenServicioTableClass::CANTIDAD => $cantidad,
            detalleOrdenServicioTableClass::VALOR => $valor,
            detalleOrdenServicioTableClass::MAQUINA_ID => $maquina
        );
        detalleOrdenServicioTableClass::update($ids, $data);
         
        routing::getInstance()->redirect('detalleOrdenServicio', 'index');
      }
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}
