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
class createTipoIdActionClass extends controllerClass implements controllerActionInterface {

  public function execute(){
    try {
      if (request::getInstance()->isMethod('POST')) {

         $descripcion = request::getInstance()->getPost(tipoIdTableClass::getNameField(tipoIdTableClass::DESCRIPCION, true));
       
//        if (strlen($descripcion) > tipoIdTableClass::DESCRIPCION_LENGTH) {
//          throw new PDOException(i18n::__(00001, null, 'errors', array(':longitud' => tipoIdTableClass::DESCRIPCION_LENGTH)), 00001);
//        }
          if (strlen($descripcion) > tipoIdTableClass::DESCRIPCION_LENGTH) {
         session::getInstance()->setError(i18n::__(00004, null, 'errors', array(':longitud' => tipoIdTableClass::DESCRIPCION_LENGTH)), 00004);
        routing::getInstance()->redirect('cliente', 'insertTipoId');
         
        }
        

        $data = array(
            tipoIdTableClass::DESCRIPCION =>$descripcion 
        );
        tipoIdTableClass::insert($data);
        routing::getInstance()->redirect('cliente', 'indexTipoId');
      } else {
        routing::getInstance()->redirect('cliente', 'indexTipoId');
      }
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}
