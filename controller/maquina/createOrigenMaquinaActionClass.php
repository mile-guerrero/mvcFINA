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
class createOrigenMaquinaActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {
       $descripcion = request::getInstance()->getPost(origenMaquinaTableClass::getNameField(origenMaquinaTableClass::DESCRIPCION, true));

       if (strlen($descripcion) > origenMaquinaTableClass::DESCRIPCION_LENGTH) {
         session::getInstance()->setError(i18n::__(00004, null, 'errors', array(':longitud' => origenMaquinaTableClass::DESCRIPCION_LENGTH)), 00004);
        routing::getInstance()->redirect('maquina', 'insertOrigenMaquina');
         
        }
        
       

        $data = array(
            origenMaquinaTableClass::DESCRIPCION => $descripcion
        );
        origenMaquinaTableClass::insert($data);
        routing::getInstance()->redirect('maquina', 'indexOrigenMaquina');
      } else {
        routing::getInstance()->redirect('maquina', 'indexOrigenMaquina');
      }
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}
