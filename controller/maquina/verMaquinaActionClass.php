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
class verMaquinaActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      $fields = array(
          maquinaTableClass::ID,
          maquinaTableClass::NOMBRE,
          maquinaTableClass::DESCRIPCION,
          maquinaTableClass::ORIGEN_MAQUINA,
          maquinaTableClass::TIPO_USO_ID,
          maquinaTableClass::PROVEEDOR_ID,
          maquinaTableClass::CREATED_AT,
          maquinaTableClass::UPDATED_AT
      );
      
       $where = array(
            maquinaTableClass::ID => request::getInstance()->getRequest(maquinaTableClass::ID)
        );
      $this->objMaquina = maquinaTableClass::getAll($fields, true, null, null, null, null, $where);

      
      $this->defineView('verMaquina', 'maquina', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
}

}
