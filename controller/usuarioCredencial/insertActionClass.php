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
class insertActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      $fields = array(
      usuarioTableClass::ID,
      usuarioTableClass::USUARIO
      );
      $orderBy = array(
      usuarioTableClass::USUARIO   
      );      
      $this->objUCU = usuarioTableClass::getAll($fields, true, $orderBy, 'ASC');
      
      $fields = array(     
      credencialTableClass::ID, 
      credencialTableClass::NOMBRE
      );
      $orderBy = array(
      credencialTableClass::NOMBRE    
      ); 
      $this->objUCC = credencialTableClass::getAll($fields, true, $orderBy, 'ASC');

      
      $this->defineView('insert', 'usuarioCredencial', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
}

}
