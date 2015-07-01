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
* @return   enfermedadTableClass::ID retorna (integer),
            enfermedadTableClass::NOMBRE retorna  (string),
            enfermedadTableClass::descripcion retorna  (string),
            enfermedadTableClass::tratamiento retorna  (string)
 * estos datos retornan en la variable $fields el $id retorna en la variable $WHERE
*/
  public function execute() {
    try {
      $fields = array(
          enfermedadTableClass::ID,
          enfermedadTableClass::NOMBRE,
          enfermedadTableClass::DESCRIPCION,
          enfermedadTableClass::TRATAMIENTO,
          enfermedadTableClass::CREATED_AT,
          enfermedadTableClass::UPDATED_AT   
      );
      
       $where = array(
            enfermedadTableClass::ID => request::getInstance()->getRequest(enfermedadTableClass::ID)
        );
      $this->objEnfermedad = enfermedadTableClass::getAll($fields, true, null, null, null, null, $where);
      
     
      $this->defineView('ver', 'enfermedad', session::getInstance()->getFormatOutput());
    }//cierre del try
     catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }//cierre del catch
}//cierre de la funcion execute

}//cierre de la clase
