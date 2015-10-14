
<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\plagaValidatorClass as validator;
use hook\log\logHookClass as log;
/**
* @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon 
* @date: fecha de inicio del desarrollo.
* @category: modulo de cliente.
*/
class updateActionClass extends controllerClass implements controllerActionInterface {

  /**
* @author: Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon .
* @date: fecha de inicio del desarrollo.
* @return   plagaTableClass::NOMBRE retorna $nombre (string),
            plagaTableClass::APELLIDO retorna $apellido (string),
            plagaTableClass::DOCUMENTO retorna $documento (integer)
 * estos datos retornan en la variable $data y el $id retorna en la variable $ids
*/
  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {
        $id = request::getInstance()->getPost(plagaTableClass::getNameField(plagaTableClass::ID, true));
        $nombre = request::getInstance()->getPost(plagaTableClass::getNameField(plagaTableClass::NOMBRE, true));
        $descripcion = request::getInstance()->getPost(plagaTableClass::getNameField(plagaTableClass::DESCRIPCION, true));
        $tratamiento = request::getInstance()->getPost(plagaTableClass::getNameField(plagaTableClass::TRATAMIENTO, true));
        
        validator::validateEdit();
         
        $ids = array(
            plagaTableClass::ID => $id
        );
        $data = array(
            plagaTableClass::NOMBRE => $nombre,
            plagaTableClass::DESCRIPCION => $descripcion,
            plagaTableClass::TRATAMIENTO => $tratamiento
        );
          plagaTableClass::update($ids, $data);
        
         session::getInstance()->setSuccess('La actualizacion fue correcta');
         $observacion ='se ha modificado la plaga';
        log::register('Modificar', plagaTableClass::getNameTable(),$observacion,$id);
        routing::getInstance()->redirect('plaga', 'index');
      }//cierre del if

    }//cierre del try
     catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
     }//cierre del catch
  }//cierre de la funcion execute
}//cierre de la clase


