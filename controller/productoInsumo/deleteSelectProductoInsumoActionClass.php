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
class deleteSelectProductoInsumoActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {
        $idsToDelete = request::getInstance()->getPost('chk');
        
       
        foreach ($idsToDelete as $id){
          $ids = array(
              productoInsumoTableClass::ID => $id
        );
       
        productoInsumoTableClass::delete($ids, true);
      }
       session::getInstance()->setSuccess('Las Casillas Seleccionadas Fueron Eliminadas Exitosamente');
       $observacion ='se ha eliminado una seleccion en  producto insumo ';
        log::register('EliminarSeleccion', productoInsumoTableClass::getNameTable(),$observacion,$id);
      
        routing::getInstance()->redirect('productoInsumo', 'indexProductoInsumo');
      } else {
        routing::getInstance()->redirect('productoInsumo', 'indexProductoInsumo');
      }
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
      switch ($exc->getCode()){
        case 23503:
          session::getInstance()->setError('Las Casillas Seleccionadas no se pueden borrar por que esta siendo utilizado');
          routing::getInstance()->redirect('productoInsumo', 'indexProductoInsumo');
          break;
          case 00000:
          break;
      }
    }
  }

}

