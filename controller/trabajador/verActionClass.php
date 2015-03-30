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
class verActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      $fields = array(
          trabajadorTableClass::ID,
          trabajadorTableClass::NOMBRET,
          trabajadorTableClass::APELLIDO,
          trabajadorTableClass::DIRECCION,
          trabajadorTableClass::TELEFONO,
          trabajadorTableClass::EMAIL,
          trabajadorTableClass::ID_TIPO_ID,
          trabajadorTableClass::ID_CIUDAD,
          trabajadorTableClass::ID_CREDENCIAL,
          trabajadorTableClass::CREATED_AT,
          trabajadorTableClass::UPDATED_AT   
      );
      
       $where = array(
            trabajadorTableClass::ID => request::getInstance()->getRequest(trabajadorTableClass::ID)
        );
      $this->objTrabajador = trabajadorTableClass::getAll($fields, true, null, null, null, null, $where);
      
     
      $this->defineView('ver', 'trabajador', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
}

}
