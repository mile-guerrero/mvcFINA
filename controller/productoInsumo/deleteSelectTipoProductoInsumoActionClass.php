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
class deleteSelectTipoProductoInsumoActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {
        $idsToDelete = request::getInstance()->getPost('chk');
        foreach ($idsToDelete as $id){
          $ids = array(
              tipoProductoInsumoTableClass::ID => $id
        );
        
        tipoProductoInsumoTableClass::delete($ids, true);
      }
       session::getInstance()->setSuccess('Las Casillas Seleccionadas Fueron Eliminadas Exitosamente');
      
        routing::getInstance()->redirect('productoInsumo', 'indexTipoProductoInsumo');
      } else {
        routing::getInstance()->redirect('productoInsumo', 'indexTipoProductoInsumo');
      }
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
      switch ($exc->getCode()){
        case 23503:
          session::getInstance()->setError('Las Casillas Seleccionadas no se pueden borrar por que esta siendo utilizado');
          routing::getInstance()->redirect('productoInsumo', 'indexTipoProductoInsumo');
          break;
          case 00000:
          break;
      }
    }
  }

}

