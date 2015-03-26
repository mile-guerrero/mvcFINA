
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
class updateTipoIdActionClass extends controllerClass implements controllerActionInterface {

  public function execute(){
    try {
      if (request::getInstance()->isMethod('POST')) {
        $id = request::getInstance()->getPost(tipoIdTableClass::getNameField(tipoIdTableClass::ID, true));
        $descripcion = request::getInstance()->getPost(tipoIdTableClass::getNameField(tipoIdTableClass::DESCRIPCION, true));
        
        $ids = array(
            tipoIdTableClass::ID => $id
        );
        $data = array(
            tipoIdTableClass::DESCRIPCION => $descripcion
            );
        tipoIdTableClass::update($ids, $data);
         
        routing::getInstance()->redirect('cliente', 'indexTipoId');
      }
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}
