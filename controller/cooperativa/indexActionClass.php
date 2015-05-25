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
class indexActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      
      $where = null;
      if (request::getInstance()->hasPost('filter')) {
        $filter = request::getInstance()->getPost('filter');
        //Validar datos

        if (isset($filter['nombre']) and $filter['nombre'] !== null and $filter['nombre'] !== '') {
          $where[cooperativaTableClass::NOMBRE] = $filter['nombre'];
        }
        if (isset($filter['descripcion']) and $filter['descripcion'] !== null and $filter['descripcion'] !== '') {
          $where[cooperativaTableClass::DESCRIPCION] = $filter['descripcion'];
        }
        if (isset($filter['ciudad']) and $filter['ciudad'] !== null and $filter['ciudad'] !== '') {
          $where[cooperativaTableClass::ID_CIUDAD] = $filter['ciudad'];
        }
        if (isset($filter['fechaIni']) and $filter['fechaIni'] !== null and $filter['fechaIni'] !== '' and (isset($filter['fechaFin']) and $filter['fechaFin'] !== null and $filter['fechaFin'] !== '')) {
          $where[cooperativaTableClass::CREATED_AT] = array(
          date(config::getFormatTimestamp(), strtotime($filter['fechaIni'] . ' 00:00:00')),
          date(config::getFormatTimestamp(), strtotime($filter['fechaFin'] . ' 23:59:59'))
          );
        }
      }
       
          
      $fields = array(
          cooperativaTableClass::ID,
          cooperativaTableClass::NOMBRE,
          cooperativaTableClass::DESCRIPCION,
          cooperativaTableClass::DIRECCION,
          cooperativaTableClass::TELEFONO,
          cooperativaTableClass::ID_CIUDAD
      );
      $orderBy = array(
         cooperativaTableClass::ID
      );
      $page = 0;
      if (request::getInstance()->hasGet('page')) {
        $this->page = request::getInstance()->getGet('page');
        $page = request::getInstance()->getGet('page') - 1;
        $page = $page * config::getRowGrid();
      }
      $this->cntPages = cooperativaTableClass::getTotalPages(config::getRowGrid());
      $this->objCooperativa = cooperativaTableClass::getAll($fields, true, $orderBy, 'ASC', config::getRowGrid(), $page,$where);
      
      
      $fields = array(     
      ciudadTableClass::ID, 
 
      );
      
      
      $this->defineView('index', 'cooperativa', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
}

}
