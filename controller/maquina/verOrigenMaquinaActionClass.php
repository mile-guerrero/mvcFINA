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
class verOrigenMaquinaActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      $fields = array(
          origenMaquinaTableClass::ID,
          origenMaquinaTableClass::DESCRIPCION
      );
      
       $where = array(
            origenMaquinaTableClass::ID => request::getInstance()->getRequest(origenMaquinaTableClass::ID)
        );
      $this->objOM = origenMaquinaTableClass::getAll($fields,false, null, null, null, null, $where);

      $this->defineView('verOrigenMaquina', 'maquina', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
}

}
