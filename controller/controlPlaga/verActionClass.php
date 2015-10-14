<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
* @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon 
* @date: fecha de inicio del desarrollo.
* @category: modulo de cliente.
*/
class verActionClass extends controllerClass implements controllerActionInterface {

  
  /**
* @author: Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon .
* @date: fecha de inicio del desarrollo.
* @return   controlPlagaTableClass::ID retorna (integer),
            controlPlagaTableClass::NOMBRE retorna  (string),
            controlPlagaTableClass::APELLIDO retorna  (string),
            controlPlagaTableClass::DOCUMENTO retorna  (integer),
            controlPlagaTableClass::DIRECCION retorna  (string),
            controlPlagaTableClass::TELEFONO retorna  (integer),
            controlPlagaTableClass::ID_TIPO_ID retorna (integer),
            controlPlagaTableClass::ID_CIUDAD retorna  (integer),
            controlPlagaTableClass::UPDATE_AT retorna  (timestamp),
 * estos datos retornan en la variable $fields el $id retorna en la variable $WHERE
*/
  public function execute() {
    try {
      $fields = array(
          controlPlagaTableClass::ID,
          controlPlagaTableClass::LOTE_ID,
          controlPlagaTableClass::PLAGA_ID,
          controlPlagaTableClass::PRODUCTO_INSUMO_ID,  
          controlPlagaTableClass::CANTIDAD,
          controlPlagaTableClass::UNIDAD_MEDIDA_ID
      );
      
       $where = array(
            controlPlagaTableClass::ID => request::getInstance()->getRequest(controlPlagaTableClass::ID)
        );
      $this->objControlPlaga = controlPlagaTableClass::getAll($fields, true, null, null, null, null, $where);
      
     
      $this->defineView('ver', 'controlPlaga', session::getInstance()->getFormatOutput());
    }//cierre del try
     catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }//cierre del catch
}//cierre de la funcion execute

}//cierre de la clase
