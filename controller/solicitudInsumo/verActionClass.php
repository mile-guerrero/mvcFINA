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
class verActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      $fields = array(
          solicitudInsumoTableClass::ID,
          solicitudInsumoTableClass::FECHA_HORA,
          solicitudInsumoTableClass::CREATED_AT,
          solicitudInsumoTableClass::UPDATED_AT
      );

      $where = array(
          solicitudInsumoTableClass::ID => request::getInstance()->getRequest(solicitudInsumoTableClass::ID)
      );
      $this->objS = solicitudInsumoTableClass::getAll($fields,false, null, null, null, null, null, $where);
      
     $fields = array(     
      trabajadorTableClass::ID, 
      trabajadorTableClass::NOMBRET
      );
      $orderBy = array(
      trabajadorTableClass::NOMBRET    
      ); 
       $where = array(
            trabajadorTableClass::ID => request::getInstance()->getRequest(trabajadorTableClass::ID)
        );
      $this->objOST = trabajadorTableClass::getAll($fields, true, $orderBy, 'ASC', null, null,$where);

      $this->defineView('ver', 'solicitudInsumo', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}
