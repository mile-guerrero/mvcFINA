
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
 * @category: modulo de credencial.
 */
class updateActionClass extends controllerClass implements controllerActionInterface {

  
    /**
* @author: Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon .
* @date: fecha de inicio del desarrollo.
* @return   credencialTableClass::ID retorna $id (integer),
            credencialTableClass::NOMBRE retorna $apellido (string),
 * estos datos retornan en la variable $data y el $id retorna en la variable $ids
*/
  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {
        $id = request::getInstance()->getPost(credencialTableClass::getNameField(credencialTableClass::ID, true));
        $nombre = request::getInstance()->getPost(credencialTableClass::getNameField(credencialTableClass::NOMBRE, true));
        
        $ids = array(
            credencialTableClass::ID => $id
        );
        $data = array(
            credencialTableClass::NOMBRE => $nombre
        );
        credencialTableClass::update($ids, $data);
         session::getInstance()->setSuccess('La actualizacion fue correcta');
         $observacion ='se ha modificado la credencial';
        log::register('Modificar', credencialTableClass::getNameTable(),$observacion,$id);
        routing::getInstance()->redirect('credencial', 'index');
      }//cierre del if que trae el POST
    }//cierre del try
      catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }//cierre del catch
  }//cierre de la funcion execute
}//cierre de la clase
