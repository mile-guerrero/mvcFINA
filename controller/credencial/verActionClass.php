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
 * @category: modulo de credencial.
 */
class verActionClass extends controllerClass implements controllerActionInterface {

  /**
* @author: Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon .
* @date: fecha de inicio del desarrollo.
* @return   credencialTableClass::ID retorna (integer),
            credencialTableClass::NOMBRE retorna  (string),
            credencialTableClass::CREATED_AT retorna  (timestamp),            
            credencialTableClass::UPDATE_AT retorna  (timestamp),
 * estos datos retornan en la variable $fields el $id retorna en la variable $WHERE
*/
  public function execute() {
    try {
      $fields = array(
          credencialTableClass::ID,
          credencialTableClass::NOMBRE,
          credencialTableClass::CREATED_AT,
          credencialTableClass::UPDATED_AT
      );
      
       $where = array(
            credencialTableClass::ID => request::getInstance()->getRequest(credencialTableClass::ID)
        );
      $this->objCredencial = credencialTableClass::getAll($fields, true, null, null, null, null, $where);
//     $orderBy = array(
//         usuarioTableClass::ID
//      );
//      $this->objUsuarios = usuarioTableClass::getAll($fields, true, $orderBy);

      $this->defineView('ver', 'credencial', session::getInstance()->getFormatOutput());
    }//cierre del try
      catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }//cierre del catch
}//cierre de la funcion execute

}//cierre de la clase
