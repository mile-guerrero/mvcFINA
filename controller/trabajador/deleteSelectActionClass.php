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
class deleteSelectActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST') and request::getInstance()->hasPost('chk')) {
        $idsToDelete = request::getInstance()->getPost('chk');
        foreach ($idsToDelete as $id){
          $ids = array(
              trabajadorTableClass::ID => $id
        ); 
        trabajadorTableClass::delete($ids, true);
      }
      session::getInstance()->setSuccess('Las Casillas Seleccionadas Fueron Eliminadas Exitosamente');
       $observacion ='se ha eliminado una seleccion en  trabajador ';
        log::register('EliminarSeleccion', trabajadorTableClass::getNameTable(),$observacion,$id);
        routing::getInstance()->redirect('trabajador', 'index');
      } else {
        routing::getInstance()->redirect('trabajador', 'index');
      }
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}

