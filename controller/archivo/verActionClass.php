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
      

 $where = null;
      
     $fields = array(
          archivoTableClass::ID,
          archivoTableClass::NOMBRE,
          archivoTableClass::EXTENCION,
          archivoTableClass::HASH
      );
     
     
     $page = 0;
      if (request::getInstance()->hasGet('page')) {
        $this->page = request::getInstance()->getGet('page');
        $page = request::getInstance()->getGet('page') - 1;
        $page = $page * config::getRowGrid();
      }//cierre del if del paguinado
      $this->cntPages = archivoTableClass::getTotalPages(config::getRowGrid());
           
      $this->objArchivo = archivoTableClass::getAll($fields, false, null, null,  config::getRowGrid(), $page, $where);
      
  
      $this->defineView('ver', 'archivo', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}
