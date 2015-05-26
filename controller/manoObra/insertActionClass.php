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
class insertActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      $fields = array(
           cooperativaTableClass::ID,
           cooperativaTableClass::NOMBRE
      );
      $orderBy = array(
      cooperativaTableClass::NOMBRE   
      );      
      $this->objCooperativa = cooperativaTableClass::getAll($fields, true, $orderBy, 'ASC');
    
      $fields = array(
          laborTableClass::ID,
          laborTableClass::DESCRIPCION
      );
      $orderBy = array(
      laborTableClass::DESCRIPCION   
      );      
      $this->objLabor = laborTableClass::getAll($fields, false, $orderBy, 'ASC');
    
       $fields = array(
      maquinaTableClass::ID,
      maquinaTableClass::NOMBRE
      );
      $orderBy = array(
      maquinaTableClass::NOMBRE   
      );      
      $this->objMaquina = maquinaTableClass::getAll($fields, true, $orderBy, 'ASC');
    
      $this->defineView('insert', 'manoObra', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
}

}
