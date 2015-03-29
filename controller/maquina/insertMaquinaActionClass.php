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
class insertMaquinaActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      
      $fields = array(
      origenMaquinaTableClass::ID,
      origenMaquinaTableClass::DESCRIPCION
      );
      $orderBy = array(
      origenMaquinaTableClass::DESCRIPCION   
      );      
      
      $this->objMOM = origenMaquinaTableClass::getAll($fields, false, $orderBy, 'ASC');
      
      
      $fields = array(     
      tipoUsoMaquinaTableClass::ID, 
      tipoUsoMaquinaTableClass::DESCRIPCION
      );
      $orderBy = array(
      tipoUsoMaquinaTableClass::DESCRIPCION    
      ); 
       
      $this->objMTUM = tipoUsoMaquinaTableClass::getAll($fields, false, $orderBy, 'ASC');

      
       $fields = array(
      proveedorTableClass::ID,
      proveedorTableClass::NOMBREP
      );
      $orderBy = array(
      proveedorTableClass::NOMBREP   
      );      
      
      $this->objMP = proveedorTableClass::getAll($fields, true, $orderBy, 'ASC');
      
      
      
      $this->defineView('insertMaquina', 'maquina', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
}

}
