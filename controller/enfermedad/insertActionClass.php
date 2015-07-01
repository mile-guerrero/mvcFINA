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
class insertActionClass extends controllerClass implements controllerActionInterface {

/**
* @author: Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon .
* @date: fecha de inicio del desarrollo.
           
*/
  public function execute() {
    try {
      

      $this->defineView('insert', 'enfermedad', session::getInstance()->getFormatOutput());
    }//cierre del try
      catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }//cierre del catch
}//cierre de la funcion execute

}//cierre de la clase
