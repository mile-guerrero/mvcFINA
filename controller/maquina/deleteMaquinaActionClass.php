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
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
 */
class deleteMaquinaActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')and request::getInstance()->isAjaxRequest()) {

        $id = request::getInstance()->getPost(maquinaTableClass::getNameField(maquinaTableClass::ID, true));
       
        $ids = array(
            maquinaTableClass::ID => $id
        );
        
        $observacion ='se ha eliminado una maquina';
       log::register('Eliminar', maquinaTableClass::getNameTable(),$observacion,$id);
        maquinaTableClass::delete($ids, true);
      $this->arrayAjax = array(
            'code'=> 200,
            'msg'=> 'Eliminacion exitosa'
            );
       $observacion ='se ha eliminado un maquina';
       log::register('Eliminar', maquinaTableClass::getNameTable(),$observacion,$id);
        session::getInstance()->setSuccess('El campo Fue Eliminado Exitosamente');
        $this->defineView('deleteMaquina', 'maquina', session::getInstance()->getFormatOutput());
      
      } else {
        routing::getInstance()->redirect('maquina', 'indexMaquina');
      }
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}

