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
class indexTipoUsoMaquinaActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      $fields = array(
          tipoUsoMaquinaTableClass::ID,
          tipoUsoMaquinaTableClass::DESCRIPCION
      );
      $orderBy = array(
         tipoUsoMaquinaTableClass::ID
      );
      $page = 0;
      if (request::getInstance()->hasGet('page')) {
        $this->page = request::getInstance()->getGet('page');
        $page = request::getInstance()->getGet('page') - 1;
        $page = $page * config::getRowGrid();
      }
      $this->cntPages = tipoUsoMaquinaTableClass::getTotalPages(config::getRowGrid());
      
      $this->objTUM = tipoUsoMaquinaTableClass::getAll($fields,false, $orderBy,null,config::getRowGrid(), $page,null);
      $this->defineView('indexTipoUsoMaquina', 'maquina', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
}

}
