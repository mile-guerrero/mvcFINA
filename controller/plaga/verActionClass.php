<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
* @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon 
* @date: fecha de inicio del desarrollo.
* @category: modulo de cliente.
*/
class verActionClass extends controllerClass implements controllerActionInterface {

  
  /**
* @author: Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon .
* @date: fecha de inicio del desarrollo.
* @return   plagaTableClass::ID retorna (integer),
            plagaTableClass::NOMBRE retorna  (string),
            plagaTableClass::descripcion retorna  (string),
            plagaTableClass::tratamiento retorna  (string)
 * estos datos retornan en la variable $fields el $id retorna en la variable $WHERE
*/
  public function execute() {
    try {
      $fields = array(
          plagaTableClass::ID,
          plagaTableClass::NOMBRE,
          plagaTableClass::DESCRIPCION,
          plagaTableClass::TRATAMIENTO,
          plagaTableClass::CREATED_AT,
          plagaTableClass::UPDATED_AT   
      );
      
       $where = array(
            plagaTableClass::ID => request::getInstance()->getRequest(plagaTableClass::ID)
        );
      $this->objPlaga = plagaTableClass::getAll($fields, false, null, null, null, null, $where);
      
     
      $this->defineView('ver', 'plaga', session::getInstance()->getFormatOutput());
    }//cierre del try
     catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }//cierre del catch
}//cierre de la funcion execute

}//cierre de la clase
