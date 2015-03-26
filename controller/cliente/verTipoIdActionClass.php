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
class verTipoIdActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      $fields = array(
          tipoIdTableClass::ID,
          tipoIdTableClass::DESCRIPCION,
          tipoIdTableClass::CREATED_AT,
          tipoIdTableClass::UPDATED_AT
      );
      
       $where = array(
            tipoIdTableClass::ID => request::getInstance()->getRequest(tipoIdTableClass::ID)
        );
      $this->objTI =tipoIdTableClass::getAll($fields, null,null, null, null, null, $where);
//     $orderBy = array(
//         usuarioTableClass::ID
//      );
//      $this->objUsuarios = usuarioTableClass::getAll($fields, true, $orderBy);

      $this->defineView('verTipoId', 'cliente', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
}

}
