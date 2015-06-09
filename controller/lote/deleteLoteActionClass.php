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
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon 
 * @date: fecha de inicio del desarrollo.
 * @category: modulo de maquina.
 */
class deleteLoteActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')and request::getInstance()->isAjaxRequest()) {

        $id = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::ID, true));
       
        $ids = array(
            loteTableClass::ID => $id
        );
        loteTableClass::delete($ids, true);
        $this->arrayAjax = array(
            'code'=> 200,
            'msg'=> 'Eliminacion exitosa'
            );
        
        $observacion ='se ha eliminado un lote';
       log::register('Eliminar', loteTableClass::getNameTable(),$observacion,$id);
       session::getInstance()->setSuccess('El campo Fue Eliminado Exitosamente');
        $this->defineView('deleteLote', 'lote', session::getInstance()->getFormatOutput());
      
      } else {
        routing::getInstance()->redirect('lote', 'indexLote');
      }
    }//cierre del try
       catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
   }//cierre del catch
}//cierre de la funcion execute

}//cierre de la clase

