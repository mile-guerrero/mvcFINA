<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as log;

/**
 * Description of ejemploClass
 *
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
 * @date: fecha de inicio del desarrollo.
 * @static: se define si la clase es de tipo estatica.
 * @category:modulo de cooperativa
 */
class deleteSelectActionClass extends controllerClass implements controllerActionInterface {
/**
  * @author: Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
* @date: fecha de inicio del desarrollo.
* @return cooperativaTableClass::ID retorna $id(integer),
 *        
 * estos datos retornan en la variable $ids
 */
  
  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {
        $idsToDelete = request::getInstance()->getPost('chk');
        foreach ($idsToDelete as $id){
          $ids = array(
            cooperativaTableClass::ID => $id
        );
        
        cooperativaTableClass::delete($ids, true);
      }
      session::getInstance()->setSuccess('Las Casillas Seleccionadas Fueron Eliminadas Exitosamente');
      $observacion ='se ha eliminado una seleccion en  cooperativa ';
        log::register('EliminarSeleccion', cooperativaTableClass::getNameTable(),$observacion,$id);
        routing::getInstance()->redirect('cooperativa', 'index');
      } else {
        routing::getInstance()->redirect('cooperativa', 'index');
      }
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
//      switch ($exc->getCode()){
//        case 23503:
//          session::getInstance()->setError(i18n::__(00011, null, 'errors', array(':correo'), 00011));
//          routing::getInstance()->redirect('cooperativa', 'index');
//          break;
//          case 00000:
//          break;
//      }
    }
  }

}

