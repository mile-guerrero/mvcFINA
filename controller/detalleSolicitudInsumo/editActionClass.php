
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
class editActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
   
      if (request::getInstance()->hasRequest(detalleOrdenServicioTableClass::ID)) {
        $fields = array(
            detalleOrdenServicioTableClass::ID,
            detalleOrdenServicioTableClass::ORDEN_SERVICIO_ID,
            detalleOrdenServicioTableClass::PRODUCTO_INSUMO_ID,
            detalleOrdenServicioTableClass::CANTIDAD,
            detalleOrdenServicioTableClass::VALOR,
            detalleOrdenServicioTableClass::MAQUINA_ID
        );
        $where = array(
            detalleOrdenServicioTableClass::ID => request::getInstance()->getRequest(detalleOrdenServicioTableClass::ID)
        );
        $this->objDOS = detalleOrdenServicioTableClass::getAll($fields, null, null, null, null, $where);
        $this->defineView('edit', 'detalleOrdenServicio', session::getInstance()->getFormatOutput());
     
      }else{
        routing::getInstance()->redirect('detalleOrdenServicio', 'index');
      }

    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}
