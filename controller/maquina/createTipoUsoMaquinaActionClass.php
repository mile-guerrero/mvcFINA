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
class createTipoUsoMaquinaActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {
       $descripcion = trim(request::getInstance()->getPost(tipoUsoMaquinaTableClass::getNameField(tipoUsoMaquinaTableClass::DESCRIPCION, true)));
       
       $this->validate($descripcion);
       
        $data = array(
            tipoUsoMaquinaTableClass::DESCRIPCION => $descripcion
        );
        tipoUsoMaquinaTableClass::insert($data);
        routing::getInstance()->redirect('maquina', 'indexTipoUsoMaquina');
      } else {
        routing::getInstance()->redirect('maquina', 'indexTipoUsoMaquina');
      }
    } catch (PDOException $exc) {
      routing::getInstance()->redirect('maquina', 'insertTipoUsoMaquina');
      session::getInstance()->setFlash('exc', $exc);
    }
  }

public function validate($descripcion) {

    $flag = false;
      if (strlen($descripcion) > tipoUsoMaquinaTableClass::DESCRIPCION_LENGTH) {
         session::getInstance()->setError(i18n::__(00004, null, 'errors', array(':longitud' => tipoUsoMaquinaTableClass::DESCRIPCION_LENGTH)), 00004);
       $flag = true;
      session::getInstance()->setFlash(tipoUsoMaquinaTableClass::getNameField(tipoUsoMaquinaTableClass::DESCRIPCION_LENGTH, true), true);
         
        }
        
      if (strlen($descripcion) == "") {
      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => tipoUsoMaquinaTableClass::DESCRIPCION)), 00009);
      $flag = true;
      session::getInstance()->setFlash(tipoUsoMaquinaTableClass::getNameField(tipoUsoMaquinaTableClass::DESCRIPCION, true), true);
   
      }
    
     if (!preg_match("/^[a-z]+$/i", $descripcion)) {
      session::getInstance()->setError(i18n::__(00012, null, 'errors', array(':letras' => $descripcion)), 00012);
      $flag = true;
      session::getInstance()->setFlash(tipoUsoMaquinaTableClass::getNameField(tipoUsoMaquinaTableClass::DESCRIPCION, true), true);
      
       }
    
      if ($flag === true){
      request::getInstance()->setMethod('GET');
      routing::getInstance()->forward('maquina', 'insertTipoUsoMaquina');
    }
}

}
