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

        $fecha_ini = request::getInstance()->getPost(pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::FECHA_INICIAL, true));
        $fecha_fin = request::getInstance()->getPost(pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::FECHA_FINAL, true));
        $idEmpresa = request::getInstance()->getPost(pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::EMPRESA_ID, true));

//        if (strlen($usuario) > usuarioTableClass::USUARIO_LENGTH) {
//          throw new PDOException(i18n::__(00001, null, 'errors', array(':longitud' => usuarioTableClass::USUARIO_LENGTH)), 00001);
//        }

        $data = array(
            pagoTrabajadorTableClass::FECHA_INICIAL => $fecha_ini,
            pagoTrabajadorTableClass::FECHA_FINAL => $fecha_fin,
            pagoTrabajadorTableClass::EMPRESA_ID => $idEmpresa
            
        );
        pagoTrabajadorTableClass::insert($data);
        session::getInstance()->setSuccess('El registro fue Exitoso');
        routing::getInstance()->redirect('pagoTrabajador', 'index');
      } else {
        routing::getInstance()->redirect('pagoTrabajador', 'index');
      }
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}
