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
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
 */
class createActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $fecha = request::getInstance()->getPost(solicitudInsumoTableClass::getNameField(solicitudInsumoTableClass::FECHA_HORA, true));
        $trabajador = request::getInstance()->getPost(solicitudInsumoTableClass::getNameField(solicitudInsumoTableClass::TRABAJADOR_ID, true));

//        if (strlen($nombre) > credencialTableClass::NOMBRE_LENGTH) {
//          throw new PDOException(i18n::__(00001, null, 'errors', array(':longitud' => credencialTableClass::NOMBRE_LENGTH)), 00001);
//        }

        $data = array(
            solicitudInsumoTableClass::FECHA_HORA => $fecha,
            solicitudInsumoTableClass::TRABAJADOR_ID => $trabajador
        );
        solicitudInsumoTableClass::insert($data);
        routing::getInstance()->redirect('solicitudInsumo', 'index');
      } else {
        routing::getInstance()->redirect('solicitudInsumo', 'index');
      }
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}
