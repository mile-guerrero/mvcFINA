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

        $fecha = request::getInstance()->getPost(facturaVentaTableClass::getNameField(facturaVentaTableClass::FECHA, true));
        $idCliente = request::getInstance()->getPost(facturaVentaTableClass::getNameField(facturaVentaTableClass::CLIENTE_ID, true));
        $idTrabajador = request::getInstance()->getPost(facturaVentaTableClass::getNameField(facturaVentaTableClass::TRABAJADOR_ID, true));
  


        $data = array(
            facturaVentaTableClass::FECHA => $fecha,
            facturaVentaTableClass::CLIENTE_ID => $idCliente,
            facturaVentaTableClass::TRABAJADOR_ID => $idTrabajador
            
        );
        facturaVentaTableClass::insert($data);
        session::getInstance()->setSuccess('El registro fue Exitoso');
        routing::getInstance()->redirect('facturaVenta', 'index');
      } else {
        routing::getInstance()->redirect('facturaVenta', 'index');
      }
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}
