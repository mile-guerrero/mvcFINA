
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
class updateActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {
        $id = request::getInstance()->getPost(solicitudInsumoTableClass::getNameField(solicitudInsumoTableClass::ID, true));
        $fecha = request::getInstance()->getPost(solicitudInsumoTableClass::getNameField(solicitudInsumoTableClass::FECHA_HORA, true));
        $trabajador = request::getInstance()->getPost(solicitudInsumoTableClass::getNameField(solicitudInsumoTableClass::TRABAJADOR_ID, true));

        $ids = array(
            solicitudInsumoTableClass::ID => $id
        );
        $data = array(
            solicitudInsumoTableClass::FECHA_HORA => $fecha,
            solicitudInsumoTableClass::TRABAJADOR_ID => $trabajador
        );
        solicitudInsumoTableClass::update($ids, $data);
         
        routing::getInstance()->redirect('solicitudInsumo', 'index');
      }
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}
