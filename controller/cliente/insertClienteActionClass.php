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
class insertClienteActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      $fields = array(
      tipoIdTableClass::ID,
      tipoIdTableClass::DESCRIPCION
      );
      $orderBy = array(
      tipoIdTableClass::DESCRIPCION   
      );      
      $this->objCTI = tipoIdTableClass::getAll($fields, false, $orderBy, 'ASC');
      
      $fields = array(     
      ciudadTableClass::ID, 
      ciudadTableClass::NOMBRE_CIUDAD
      );
      $orderBy = array(
      ciudadTableClass::NOMBRE_CIUDAD    
      ); 
      $this->objCC = ciudadTableClass::getAll($fields, false, $orderBy, 'ASC');

      $this->defineView('insertCliente', 'cliente', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
}

}
