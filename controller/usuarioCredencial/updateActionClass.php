
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
class updateActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {
        $id = request::getInstance()->getPost(usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::ID, true));
        $usuario = request::getInstance()->getPost(usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::USUARIO_ID, true));
        $credencial = request::getInstance()->getPost(usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::CREDENCIAL_ID, true));

        $ids = array(
            usuarioCredencialTableClass::ID => $id
        );
        $data = array(
            usuarioCredencialTableClass::USUARIO_ID => $usuario,
            usuarioCredencialTableClass::CREDENCIAL_ID => $credencial
        );
        usuarioCredencialTableClass::update($ids, $data);
         
        routing::getInstance()->redirect('usuarioCredencial', 'index');
      }
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}
