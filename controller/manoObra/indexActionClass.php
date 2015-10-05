<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\manoObraValidatorClass as validator;

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

     if ((isset($filter[manoObraTableClass::getNameField(manoObraTableClass::CREATED_AT, true) . '_1']) and empty($filter[manoObraTableClass::getNameField(manoObraTableClass::CREATED_AT, true) . '_1']) === false) and ( isset($filter[manoObraTableClass::getNameField(manoObraTableClass::CREATED_AT, true) . '_2']) and empty($filter[manoObraTableClass::getNameField(manoObraTableClass::CREATED_AT, true) . '_2']) === false)) {
          if (request::getInstance()->isMethod('POST')) {

            $fechaInicial = $filter[manoObraTableClass::getNameField(manoObraTableClass::CREATED_AT, true) . '_1'];
            $fechaFin = $filter[manoObraTableClass::getNameField(manoObraTableClass::CREATED_AT, true) . '_2'];

            validator::validateFiltroFecha($fechaInicial, $fechaFin);

            if ((isset($fechaInicial) and $fechaInicial !== null and $fechaInicial !== "") and ( isset($fechaFin) and $fechaFin !== null and $fechaFin !== "" )) {
              $where[] = '(' . manoObraTableClass::getNameField(manoObraTableClass::CREATED_AT) . ' BETWEEN ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaInicial . ' 00:00:00')) . "'" . ' AND ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaFin . ' 23:59:59')) . "'" . ' ) ';
            }
          }
        }
//      session::getInstance()->setAttribute('manoObraIndexFilters', $where);
//       }else if(session::getInstance()->hasAttribute('manoObraIndexFilters')){
//        $where = session::getInstance()->getAttribute('manoObraIndexFilters');
//    
        }
      
//      validator::validateFilters();
      $fields = array(
          manoObraTableClass::ID,
          manoObraTableClass::CANTIDAD_HORA,
          manoObraTableClass::VALOR_HORA,
          manoObraTableClass::TOTAL,
          manoObraTableClass::COOPERATIVA_ID,
          manoObraTableClass::LOTE_ID,
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
      $this->cntPages = manoObraTableClass::getTotalPages(config::getRowGrid(), $where);
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
       routing::getInstance()->redirect('manoObra', 'index');
//      echo $exc->getMessage();
//      echo '<br>';
//      echo $exc->getTraceAsString();
    }
}

}
