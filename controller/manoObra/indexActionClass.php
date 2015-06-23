<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\manoObraValidatorFiltersClass as validator;

/**
 * Description of ejemploClass
 * @date: 2015/06/01.
 * @category: Modulo mano de obra.
 *
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
 */
class indexActionClass extends controllerClass implements controllerActionInterface {
    
   /**
   * Método para leer todos los registros de una tabla
   *
   * @param array $fields Array con los nombres de los campos a solicitar
   * @param array $orderBy [optional] Array con el o los nombres de los campos
   * por los cuales se ordenará la consulta
   * @param string $order [optional] Forma de ordenar la consulta
   * (por defecto NULL), pude ser ASC o DESC
   * @param $page Forma de ver cuantas paginas se encuentran.
   * @param $where Forma de hacer filtros
   * de datos a mostrar.
   * @return datatype description: \PDOException|boolean.
   * 
   */

  public function execute() {
    try {
        $where = null;
        $flag = false;
      if (request::getInstance()->hasPost('filter')) {
        $filter = request::getInstance()->getPost('filter');
        //Validar datos
      
      if (isset($filter['cooperativa']) and $filter['cooperativa'] !== null and $filter['cooperativa'] !== '') {
          $where[manoObraTableClass::COOPERATIVA_ID] = $filter['cooperativa'];
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
      
//      validator::validateFilters();
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
           cooperativaTableClass::NOMBRE
      );
      $orderBy = array(
           cooperativaTableClass::NOMBRE   
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
