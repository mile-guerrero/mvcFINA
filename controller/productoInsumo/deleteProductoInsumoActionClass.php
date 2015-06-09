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
class deleteProductoInsumoActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST') and request::getInstance()->isAjaxRequest()) {

        $id = request::getInstance()->getPost(productoInsumoTableClass::getNameField( productoInsumoTableClass::ID, true));
       
        $ids = array(
             productoInsumoTableClass::ID => $id
        );
        productoInsumoTableClass::delete($ids, true);
        $this->arrayAjax = array(
            'code'=> 200,
            'msg'=> 'Eliminacion exitosa'
            );
        
        $observacion ='se ha eliminado un producto insumo';
       log::register('Eliminar', productoInsumoTableClass::getNameTable(),$observacion,$id);
       session::getInstance()->setSuccess('El campo Fue Eliminado Exitosamente');
        $this->defineView('deleteProductoInsumo', 'productoInsumo', session::getInstance()->getFormatOutput());
      
      } else {
        routing::getInstance()->redirect('productoInsumo', 'indexProductoInsumo');
      }
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}

