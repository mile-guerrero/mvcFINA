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
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class reportClienteActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      $this->mensaje = 'Informacion de Clientes';
      $fields = array(
          clienteTableClass::ID,
          clienteTableClass::NOMBRE,
          clienteTableClass::APELLIDO,
          clienteTableClass::DIRECCION,
          clienteTableClass::TELEFONO,          
          clienteTableClass::CREATED_AT,
          clienteTableClass::UPDATED_AT
      );
      $orderBy = array(
         clienteTableClass::ID
      );
      $this->objC = clienteTableClass::getAll($fields, true, $orderBy, 'ASC');
 
       $fields = array(
          ciudadTableClass::ID,
          ciudadTableClass::NOMBRE_CIUDAD,
          ciudadTableClass::HABITANTES
      );
      $orderBy = array(
         ciudadTableClass::ID
      );
      $this->objCC = ciudadTableClass::getAll($fields, false, $orderBy, 'ASC');
 
      $fields = array(
          tipoIdTableClass::ID,
          tipoIdTableClass::DESCRIPCION
      );
      $orderBy = array(
         tipoIdTableClass::ID
      );
      
      $this->objCTI = tipoIdTableClass::getAll($fields, false, $orderBy, 'ASC');
 
      $this->defineView('indexCliente', 'cliente', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo '<pre>';
      print_r($exc->getTrace());
      echo '</pre>';
    }
  }

}
