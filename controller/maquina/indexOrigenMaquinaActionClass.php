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
class indexOrigenMaquinaActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      $fields = array(
          origenMaquinaTableClass::ID,
          origenMaquinaTableClass::DESCRIPCION
      );
      $orderBy = array(
         origenMaquinaTableClass::ID
      );
      $page = 0;
      if (request::getInstance()->hasGet('page')) {
        $this->page = request::getInstance()->getGet('page');
        $page = request::getInstance()->getGet('page') - 1;
        $page = $page * config::getRowGrid();
      }
      $this->cntPages = origenMaquinaTableClass::getTotalPages(config::getRowGrid());
      
      $this->objOM = origenMaquinaTableClass::getAll($fields,false, $orderBy,'ASC',config::getRowGrid(), $page,null);
      $this->defineView('indexOrigenMaquina', 'maquina', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
}

}
