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
class createActionClass extends controllerClass implements controllerActionInterface {

  /**
   * @author: Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon .
   * @date: fecha de inicio del desarrollo.
   * @return   plagaTableClass::NOMBRE retorna $nombre (string),
    plagaTableClass::DESCRIPCION retorna $descripcion (string),
    plagaTableClass::TRATAMIENTO retorna $tratamiento (string)
   * estos datos retornan en la variable $data
   */
  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $nombre = trim(request::getInstance()->getPost(plagaTableClass::getNameField(plagaTableClass::NOMBRE, true)));
        $descripcion = trim(request::getInstance()->getPost(plagaTableClass::getNameField(plagaTableClass::DESCRIPCION, true)));
        $tratamiento = trim(request::getInstance()->getPost(plagaTableClass::getNameField(plagaTableClass::TRATAMIENTO, true)));
        
        //llamar la funcion validateInsert()
        validator::validateInsert();


        $data = array(
            plagaTableClass::NOMBRE => $nombre,
            plagaTableClass::DESCRIPCION => $descripcion,
            plagaTableClass::TRATAMIENTO => $tratamiento,
            '__sequence' => 'plaga_id_seq'
        );
        $id = plagaTableClass::insert($data);
        session::getInstance()->setSuccess('El registro fue exitoso');
        $observacion ='se ha insertando una nueva plaga';
        log::register('Insertar', plagaTableClass::getNameTable(),$observacion,$id);
        routing::getInstance()->redirect('plaga', 'index');
      }//cierre del POST 
      else {
        routing::getInstance()->redirect('plaga', 'index');
      }//cierre del else
    } //cierre de la try
    catch (PDOException $exc) {
//      routing::getInstance()->redirect('plaga', 'insert');
//      session::getInstance()->setFlash('exc', $exc);
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
      
    }//cierre del catch
  }//cierre de la funcion execute 
}//cierre de la clase



