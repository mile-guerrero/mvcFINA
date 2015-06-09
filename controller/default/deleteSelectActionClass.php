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
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon 
 * @date: fecha de inicio del desarrollo.
 * @category: modulo de defautl.
 */
class deleteSelectActionClass extends controllerClass implements controllerActionInterface {

   /**
* @author: Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon .
* @date: fecha de inicio del desarrollo.
* @return   usuarioTableClass::ID retorna $id (string),
 * estos datos retornan en la variable $ids
*/
  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {
        $idsToDelete = request::getInstance()->getPost('chk');
        foreach ($idsToDelete as $id){
          $ids = array(
            usuarioTableClass::ID => $id
        );
        
        usuarioTableClass::delete($ids, true);
      }//cierre del foreach
       session::getInstance()->setSuccess('Las Casillas Seleccionadas Fueron Eliminadas Exitosamente');
       $observacion ='se ha eliminado una seleccion en  usuario ';
        log::register('EliminarSeleccion', usuarioTableClass::getNameTable(),$observacion,$id);
      
        routing::getInstance()->redirect('default', 'index');
      }//cierre del if
        else {
        routing::getInstance()->redirect('default', 'index');
      }//cierre del else
    }//cierre del try
      catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }//cierre del catch
}//cierre de la funcion execute

}//cierre de la clase

