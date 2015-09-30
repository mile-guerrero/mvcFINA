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
 * Description of ejemploClass
 *
 * @author 
 */
class deleteActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST') and request::getInstance()->isAjaxRequest()) {

        $id = request::getInstance()->getPost(viveroTableClass::getNameField(viveroTableClass::ID, true));
       
        $ids = array(
            viveroTableClass::ID => $id
        );
       viveroTableClass::delete($ids, true);
       // routing::getInstance()->redirect('cliente', 'index');
       $this->arrayAjax = array(
           'code' => 200,
           'msg'  => 'La Eliminacion fue Exitosa'
           );
       
       $observacion ='se ha eliminado un registro de vivero';
       log::register('Eliminar', viveroTableClass::getNameTable(),$observacion,$id);
       $this->defineView('delete', 'vivero', session::getInstance()->getFormatOutput());
       session::getInstance()->setSuccess('La Eliminacion fue Exitosa');
      } else {
        routing::getInstance()->redirect('vivero', 'index');
      }
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}

