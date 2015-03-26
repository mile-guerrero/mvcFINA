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
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class createOrigenMaquinaActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {
       $descripcion = request::getInstance()->getPost(origenMaquinaTableClass::getNameField(origenMaquinaTableClass::DESCRIPCION, true));

        if (strlen($descripcion) > origenMaquinaTableClass::DESCRIPCION_LENGTH) {
          throw new PDOException(i18n::__(00001, null, 'errors', array(':longitud' => origenMaquinaTableClass::DESCRIPCION_LENGTH)), 00001);
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
