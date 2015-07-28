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
          videoTableClass::ID,
          videoTableClass::NOMBRE,
          videoTableClass::EXTENCION,
          videoTableClass::HASH
      );
     
       $page = 0;
      if (request::getInstance()->hasGet('page')) {
        $this->page = request::getInstance()->getGet('page');
        $page = request::getInstance()->getGet('page') - 1;
        $page = $page * 2;
      }//cierre del if del paguinado
      $this->cntPages = videoTableClass::getTotalPages(2);
           
      $this->objVideo = videoTableClass::getAll($fields, false, null, null, 2, $page, $where);

      $this->defineView('ver', 'video', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}
