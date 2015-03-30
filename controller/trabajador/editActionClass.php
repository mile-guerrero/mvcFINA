
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
class editActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {

      if (request::getInstance()->hasRequest(trabajadorTableClass::ID)) {
        $fields = array(
            trabajadorTableClass::ID,
            trabajadorTableClass::NOMBRET,
            trabajadorTableClass::APELLIDO,
            trabajadorTableClass::DIRECCION,
            trabajadorTableClass::TELEFONO,
            trabajadorTableClass::EMAIL,
            trabajadorTableClass::ID_TIPO_ID,
            trabajadorTableClass::ID_CIUDAD,
            trabajadorTableClass::ID_CREDENCIAL
        );
        $where = array(
            trabajadorTableClass::ID => request::getInstance()->getRequest(trabajadorTableClass::ID)
        );
        $this->objTrabajador = trabajadorTableClass::getAll($fields, true, null, null, null, null, $where);
        $fields = array(
            ciudadTableClass::ID,
            ciudadTableClass::NOMBRE_CIUDAD
        );
        $orderBy = array(
            ciudadTableClass::NOMBRE_CIUDAD
        );
        $this->objCC = ciudadTableClass::getAll($fields, false, $orderBy, 'ASC');

        $fields = array(
            tipoIdTableClass::ID,
            tipoIdTableClass::DESCRIPCION
        );
        $orderBy = array(
            tipoIdTableClass::DESCRIPCION
        );
        $this->objCTI = tipoIdTableClass::getAll($fields, false, $orderBy, 'ASC');
        
        $fields = array(
            credencialTableClass::ID,
            credencialTableClass::NOMBRE
        );
        $orderBy = array(
            credencialTableClass::NOMBRE
        );
        $this->objCredencial = credencialTableClass::getAll($fields, false, $orderBy, 'ASC');




        $this->defineView('edit', 'trabajador', session::getInstance()->getFormatOutput());
      } else {
        routing::getInstance()->redirect('trabajador', 'index');
      }
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}
