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
 * @category: modulo de defautl.
 */
class verActionClass extends controllerClass implements controllerActionInterface {

  
   /**
* @author: Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon .
* @date: fecha de inicio del desarrollo.
* @return   usuarioTableClass::ID retorna (integer),
            usuarioTableClass::USUARIO retorna  (string),
            usuarioTableClass::CREATED_AT retorna  (timestamp),            
            usuarioTableClass::UPDATE_AT retorna  (timestamp),
            usuarioTableClass::ACTIVED retorna (integer),
 * estos datos retornan en la variable $fields el $id retorna en la variable $WHERE
*/
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
    }//cierre del try 
      catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
     }//cierre del catch
}//cierre de la funcion execute

}//cierre de la clase
