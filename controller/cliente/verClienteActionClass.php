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
class verClienteActionClass extends controllerClass implements controllerActionInterface {

  
  /**
* @author: Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon .
* @date: fecha de inicio del desarrollo.
* @return   clienteTableClass::ID retorna (integer),
            clienteTableClass::NOMBRE retorna  (string),
            clienteTableClass::APELLIDO retorna  (string),
            clienteTableClass::DOCUMENTO retorna  (integer),
            clienteTableClass::DIRECCION retorna  (string),
            clienteTableClass::TELEFONO retorna  (integer),
            clienteTableClass::ID_TIPO_ID retorna (integer),
            clienteTableClass::ID_CIUDAD retorna  (integer),
            clienteTableClass::UPDATE_AT retorna  (timestamp),
 * estos datos retornan en la variable $fields el $id retorna en la variable $WHERE
*/
  public function execute() {
    try {
      $fields = array(
          clienteTableClass::ID,
          clienteTableClass::NOMBRE,
          clienteTableClass::APELLIDO,
          clienteTableClass::DOCUMENTO,
          clienteTableClass::DIRECCION,
          clienteTableClass::TELEFONO,
          clienteTableClass::ID_TIPO_ID,
          clienteTableClass::ID_CIUDAD,
          clienteTableClass::CREATED_AT,
          clienteTableClass::UPDATED_AT   
      );
      
       $where = array(
            clienteTableClass::ID => request::getInstance()->getRequest(clienteTableClass::ID)
        );
      $this->objCliente = clienteTableClass::getAll($fields, true, null, null, null, null, $where);
      
     
      $this->defineView('verCliente', 'cliente', session::getInstance()->getFormatOutput());
    }//cierre del try
     catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }//cierre del catch
}//cierre de la funcion execute

}//cierre de la clase
