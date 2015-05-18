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
 *
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
 */
class createActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $nombre = request::getInstance()->getPost(credencialTableClass::getNameField(credencialTableClass::NOMBRE, true));
        
      $this->validate($nombre);
     
        
        $data = array(
            credencialTableClass::NOMBRE => $nombre,
          
        );
        credencialTableClass::insert($data);
        session::getInstance()->setSuccess('El registro fue exitoso');
        routing::getInstance()->redirect('credencial', 'index');
      } else {
        routing::getInstance()->redirect('credencial', 'index');
      }
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }
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
}
