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
* @category: modulo de cliente.
*/
class deleteSelectClienteActionClass extends controllerClass implements controllerActionInterface {

  /**
* @author: Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon .
* @date: fecha de inicio del desarrollo.
* @return   clienteTableClass::ID retorna $id (string),
 * estos datos retornan en la variable $ids
*/
  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {
        $idsToDelete = request::getInstance()->getPost('chk');
        foreach ($idsToDelete as $id){
          $ids = array(
            clienteTableClass::ID => $id
        );
        
        clienteTableClass::delete($ids, true);
      }//cierre del foreach
      session::getInstance()->setSuccess('Las Casillas Seleccionadas Fueron Eliminadas Exitosamente');
      $observacion ='se ha eliminado una seleccion en cliente';
        log::register('EliminarSeleccion', clienteTableClass::getNameTable(),$observacion,$id);
        routing::getInstance()->redirect('cliente', 'indexCliente');
      }//cierre del if
        else {
        routing::getInstance()->redirect('cliente', 'indexCliente');
      }//cierre del else
    }//cierre del try
      catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
//      switch ($exc->getCode()){
//        case 23503:
//          session::getInstance()->setError(i18n::__(00011, null, 'errors', array(':correo'), 00011));
//          routing::getInstance()->redirect('cliente', 'indexCliente');
//          break;
//          case 00000:
//          break;
//      }
    }//cierre del catch
  }//cierre de la funcion execute

}//cierre de la clase

