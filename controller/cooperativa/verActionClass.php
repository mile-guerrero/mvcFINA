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
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
 * @date: fecha de inicio del desarrollo.
 * @static: se define si la clase es de tipo estatica.
 * @category: medolo cooperativa
 * 

 */
class verActionClass extends controllerClass implements controllerActionInterface {
/**
* @author: Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
* @date: fecha de inicio del desarrollo.
* @return cooperativaTableClass::ID retorna (integer),
 *        cooperativaTableClass::NOMBRE retorna (string),
 *        cooperativaTableClass::DESCRIPCION retorna (string),
 *        cooperativaTableClass::DIRECCION retorna (string),
 *        cooperativaTableClass::TELEFONO retorna (integer),  
 *        cooperativaTableClass::ID_CIUDAD retorna(integer),
 * estos datos retornan en la variable $fields
 */
  public function execute() {
    try {
      $fields = array(
          cooperativaTableClass::ID,
          cooperativaTableClass::NOMBRE,
          cooperativaTableClass::DESCRIPCION,
          cooperativaTableClass::DIRECCION,
          cooperativaTableClass::TELEFONO,
          cooperativaTableClass::ID_CIUDAD 		  
      );
      
       $where = array(
            cooperativaTableClass::ID => request::getInstance()->getRequest(cooperativaTableClass::ID)
        );
      $this->objCooperativa = cooperativaTableClass::getAll($fields, true, null, null, null, null, $where);
      
     
      $this->defineView('ver', 'cooperativa', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
}

}
