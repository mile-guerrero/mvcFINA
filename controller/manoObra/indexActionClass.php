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

      if (isset($filter['cantidad']) and $filter['cantidad'] !== null and $filter['cantidad'] !== '') {
          $where[manoObraTableClass::CANTIDAD_HORA] = $filter['cantidad'];
        }
//        if (isset($filter['trabajador']) and $filter['trabajador'] !== null and $filter['trabajador'] !== '') {
//          $where[manoObraTableClass::TRABAJADOR_ID] = $filter['trabajador'];
//        }
        if (isset($filter['fecha1']) and $filter['fecha1'] !== null and $filter['fecha1'] !== '' and (isset($filter['fecha2']) and $filter['fecha2'] !== null and $filter['fecha2'] !== '')) {
          $where[manoObraTableClass::CREATED_AT] = array(
          date(config::getFormatTimestamp(), strtotime($filter['fecha1'] . ' 00:00:00')),
          date(config::getFormatTimestamp(), strtotime($filter['fecha2'] . ' 23:59:59'))
          );
        }
      }
      $fields = array(
          manoObraTableClass::ID,
          manoObraTableClass::CANTIDAD_HORA,
          manoObraTableClass::VALOR_HORA,
          manoObraTableClass::COOPERATIVA_ID,
          manoObraTableClass::LABOR_ID,
          manoObraTableClass::MAQUINA_ID,
          manoObraTableClass::CREATED_AT,
          manoObraTableClass::UPDATED_AT,
          manoObraTableClass::DELETED_AT
      );
      $orderBy = array(
         manoObraTableClass::ID
      );
      $page = 0;
      if (request::getInstance()->hasGet('page')) {
        $this->page = request::getInstance()->getGet('page');
        $page = request::getInstance()->getGet('page') - 1;
        $page = $page * config::getRowGrid();
      }
      $this->cntPages = manoObraTableClass::getTotalPages(config::getRowGrid());
      $this->objManoObra = manoObraTableClass::getAll($fields, true, $orderBy, 'ASC', config::getRowGrid(), $page, $where);
      $fields = array(
           cooperativaTableClass::ID,
           cooperativaTableClass::DESCRIPCION
      );
      $orderBy = array(
      cooperativaTableClass::DESCRIPCION   
      );      
      $this->objCooperativa = cooperativaTableClass::getAll($fields, true, $orderBy, 'ASC');
       
      $this->defineView('index', 'manoObra', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
}

}
