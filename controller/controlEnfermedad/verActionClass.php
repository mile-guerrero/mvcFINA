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
* @return   controlEnfermedadTableClass::ID retorna (integer),
            controlEnfermedadTableClass::NOMBRE retorna  (string),
            controlEnfermedadTableClass::APELLIDO retorna  (string),
            controlEnfermedadTableClass::DOCUMENTO retorna  (integer),
            controlEnfermedadTableClass::DIRECCION retorna  (string),
            controlEnfermedadTableClass::TELEFONO retorna  (integer),
            controlEnfermedadTableClass::ID_TIPO_ID retorna (integer),
            controlEnfermedadTableClass::ID_CIUDAD retorna  (integer),
            controlEnfermedadTableClass::UPDATE_AT retorna  (timestamp),
 * estos datos retornan en la variable $fields el $id retorna en la variable $WHERE
*/
  public function execute() {
    try {
      $fields = array(
          controlEnfermedadTableClass::ID,
          controlEnfermedadTableClass::LOTE_ID,
          controlEnfermedadTableClass::ENFERMEDAD_ID,
          controlEnfermedadTableClass::PRODUCTO_INSUMO_ID,
          controlEnfermedadTableClass::UNIDAD_MEDIDA_ID,  
          controlEnfermedadTableClass::CANTIDAD
      );
      
       $where = array(
            controlEnfermedadTableClass::ID => request::getInstance()->getRequest(controlEnfermedadTableClass::ID)
        );
      $this->objControlEnfermedad = controlEnfermedadTableClass::getAll($fields, true, null, null, null, null, $where);
      
     
      $this->defineView('ver', 'controlEnfermedad', session::getInstance()->getFormatOutput());
    }//cierre del try
     catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }//cierre del catch
}//cierre de la funcion execute

}//cierre de la clase
