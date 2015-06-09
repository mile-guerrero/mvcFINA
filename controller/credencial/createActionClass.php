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
class createActionClass extends controllerClass implements controllerActionInterface {

  
  /**
   * @author: Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon .
   * @date: fecha de inicio del desarrollo.
   * @return   credencialTableClass::NOMBRE retorna $nombre (string),
   * estos datos retornan en la variable $data
   */
  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $nombre = request::getInstance()->getPost(credencialTableClass::getNameField(credencialTableClass::NOMBRE, true));
        
      $this->validate($nombre);
     
        
        $data = array(
            credencialTableClass::NOMBRE => $nombre,
            '__sequence' => 'credencial_id_seq'
          
        );
        $id = credencialTableClass::insert($data);
        session::getInstance()->setSuccess('El registro fue exitoso');
        $observacion ='se ha insertando una nueva credencial';
        log::register('Insertar', credencialTableClass::getNameTable(),$observacion,$id);
        routing::getInstance()->redirect('credencial', 'index');
      } //cierre del POST 
       else {
        routing::getInstance()->redirect('credencial', 'index');
      }//cierre del else
    } //cierre de la try
      catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }//cierre del catch
  }//cierre de la funcion execute 
  public function validate($nombre) {
     $flag = false;
    
    if (strlen($nombre) > credencialTableClass::NOMBRE_LENGTH) {
      session::getInstance()->setError(i18n::__(00001, null, 'errors', array(':longitud' => credencialTableClass::NOMBRE_LENGTH)), 00001);
      $flag = true;
      session::getInstance()->setFlash(credencialTableClass::getNameField(credencialTableClass::NOMBRE, true),true);
      }

    if (strlen($nombre) == null) {
      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => credencialTableClass::NOMBRE)), 00009);
      $flag = true;
      session::getInstance()->setFlash(credencialTableClass::getNameField(credencialTableClass::NOMBRE, true), true);
     }
     
    
    if (!preg_match("/^[a-z]+$/i", $nombre)){         
      session::getInstance()->setError(i18n::__(00012, null, 'errors', array(':letras' => credencialTableClass::NOMBRE)), 00012);
      $flag = true;
      session::getInstance()->setFlash(credencialTableClass::getNameField(credencialTableClass::NOMBRE, true), true);
      }
      
      if ($flag === true){
    request::getInstance()->setMethod('GET');
    routing::getInstance()->forward('credencial', 'insert');
  }
    
  }
}//cierre de la clase
