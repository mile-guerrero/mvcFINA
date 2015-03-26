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
class verActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      $fields = array(
          usuarioTableClass::ID,
          usuarioTableClass::USUARIO,
          usuarioTableClass::CREATED_AT,
          usuarioTableClass::UPDATED_AT,
          usuarioTableClass::ACTIVED
      );
      
       $where = array(
            usuarioTableClass::ID => request::getInstance()->getRequest(usuarioTableClass::ID)
        );
      $this->objUsuarios = usuarioTableClass::getAll($fields, true, null, null, null, null, $where);
//     $orderBy = array(
//         usuarioTableClass::ID
//      );
//      $this->objUsuarios = usuarioTableClass::getAll($fields, true, $orderBy);

      $this->defineView('ver', 'default', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
}

}
