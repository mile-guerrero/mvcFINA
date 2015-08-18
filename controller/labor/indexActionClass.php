<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\validator\laborValidatorClass as validator;
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
        
       if ((isset($filter[laborTableClass::getNameField(laborTableClass::CREATED_AT, true) . '_1']) and empty($filter[laborTableClass::getNameField(laborTableClass::CREATED_AT, true) . '_1']) === false) and ( isset($filter[laborTableClass::getNameField(laborTableClass::CREATED_AT, true) . '_2']) and empty($filter[laborTableClass::getNameField(laborTableClass::CREATED_AT, true) . '_2']) === false)) {
          if (request::getInstance()->isMethod('POST')) {

            $fechaInicial = $filter[laborTableClass::getNameField(laborTableClass::CREATED_AT, true) . '_1'];
            $fechaFin = $filter[laborTableClass::getNameField(laborTableClass::CREATED_AT, true) . '_2'];

            validator::validateFiltroFecha($fechaInicial, $fechaFin);

            if ((isset($fechaInicial) and $fechaInicial !== null and $fechaInicial !== "") and ( isset($fechaFin) and $fechaFin !== null and $fechaFin !== "" )) {
              $where[] = '(' . laborTableClass::getNameField(laborTableClass::CREATED_AT) . ' BETWEEN ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaInicial . ' 00:00:00')) . "'" . ' AND ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaFin . ' 23:59:59')) . "'" . ' ) ';
            }
          }
        }
        
         if (isset($filter[laborTableClass::getNameField(laborTableClass::DESCRIPCION, true)]) and empty($filter[laborTableClass::getNameField(laborTableClass::DESCRIPCION, true)]) === false) {
          if (request::getInstance()->isMethod('POST')) {

            $descripcion = $filter[laborTableClass::getNameField(laborTableClass::DESCRIPCION, true)];
            validator::validateFiltroNombre($descripcion);
            if (isset($descripcion) and $descripcion !== null and $descripcion !== "") {
            $where[] = '(' . laborTableClass::getNameField(laborTableClass::DESCRIPCION) . ' LIKE ' . '\'' . $descripcion . '%\'  '
              . 'OR ' . laborTableClass::getNameField(laborTableClass::DESCRIPCION) . ' LIKE ' . '\'%' . $descripcion . '%\' '
              . 'OR ' . laborTableClass::getNameField(laborTableClass::DESCRIPCION) . ' LIKE ' . '\'%' . $descripcion.'\') ';       
              }//cierre del filtro nombre
          }
        }
        
//      session::getInstance()->setAttribute('laborIndexFilters', $where);
//       }else if(session::getInstance()->hasAttribute('laborIndexFilters')){
//        $where = session::getInstance()->getAttribute('laborIndexFilters');
//     
        
       }
       
          
      $fields = array(
          laborTableClass::ID,
          laborTableClass::DESCRIPCION,
          laborTableClass::VALOR          
      );
      $orderBy = array(
         laborTableClass::ID
      );
      $page = 0;
      if (request::getInstance()->hasGet('page')) {
        $this->page = request::getInstance()->getGet('page');
        $page = request::getInstance()->getGet('page') - 1;
        $page = $page * config::getRowGrid();
      }
      $this->cntPages = laborTableClass::getTotalPages(config::getRowGrid(), $where);
      $this->objLabor = laborTableClass::getAll($fields, false, $orderBy, 'ASC', config::getRowGrid(), $page,$where);
     
    
      $this->defineView('index', 'labor', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
        routing::getInstance()->redirect('labor', 'index');
//      echo $exc->getMessage();
//      echo '<br>';
//      echo $exc->getTraceAsString();
    }
}

}
