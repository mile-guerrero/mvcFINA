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
class deleteSelectActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {
        $idsToDelete = request::getInstance()->getPost('chk');
        foreach ($idsToDelete as $id){
          $ids = array(
              manoObraTableClass::ID => $id
        );
        
        manoObraTableClass::delete($ids, true);
      }
        session::getInstance()->setSuccess('Las Casillas Seleccionadas Fueron Eliminadas Exitosamente');
        $observacion ='se ha eliminado una seleccion en  mano obra ';
        log::register('EliminarSeleccion', manoObraTableClass::getNameTable(),$observacion,$id);
        routing::getInstance()->redirect('manoObra', 'index');
      } else {
        routing::getInstance()->redirect('manoObra', 'index');
      }
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}

