<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\detalleFacturaVentaValidatorClass as validator;

/**
 * Description of ejemploClass
 *
 * @author Andres Bahamon
 */
class getInsumoActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST') and request::getInstance()->isAjaxRequest()) {

        $idTipoInsumo = request::getInstance()->getPost('idTipoInsumo');
        $consultaInsumo = detalleFacturaVentaTableClass::getTraerInsumo($idTipoInsumo);

        $this->arrayAjax1 = array();
        foreach ($consultaInsumo as $value){
            $this->arrayAjax1[] = array("id" => $value->id , "name" => $value->descripcion);
        }
        
        $this->defineView('getInsumo', 'detalleFacturaVenta', session::getInstance()->getFormatOutput());
      } else {
        routing::getInstance()->redirect('facturaVenta', 'index');
      }
    } catch (PDOException $exc) {
      routing::getInstance()->redirect('detalleFacturaVenta', 'insert');
      session::getInstance()->setFlash('exc', $exc);
    }
  }

}
