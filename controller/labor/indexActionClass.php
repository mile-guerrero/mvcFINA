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
if (request::getInstance()->hasPost('filter')) {
        $filter = request::getInstance()->getPost('filter');
        //Validar datos

        if (request::getInstance()->hasPost(laborTableClass::getNameField(laborTableClass::DESCRIPCION, true)) and empty(mvc\request\requestClass::getInstance()->getPost(laborTableClass::getNameField(laborTableClass::DESCRIPCION, true))) === false) {

          if (request::getInstance()->isMethod('POST')) {
            $descripcion = request::getInstance()->getPost(laborTableClass::getNameField(laborTableClass::DESCRIPCION, true));
            validator::validateFiltro();

            if (isset($descripcion) and $descripcion !== null and $descripcion !== '') {
          $where[] ='(' .  laborTableClass::getNameField(laborTableClass::DESCRIPCION) . ' LIKE ' . '\'' . $descripcion . '%\'  '
              . 'OR ' . laborTableClass::getNameField(laborTableClass::DESCRIPCION) . ' LIKE ' . '\'%' . $descripcion . '%\' '
              . 'OR ' . laborTableClass::getNameField(laborTableClass::DESCRIPCION) . ' LIKE ' . '\'%' . $descripcion .'\') ';       
              }//cierre del filtro nombre
       
            }//cierre del filtro documento
          }//cierre del filtro ubicacion   
        }
        
        if (isset($filter['valor1']) and $filter['valor1'] !== null and $filter['valor1'] !== '' and (isset($filter['valor2']) and $filter['valor2'] !== null and $filter['valor2'] !== '')) {
          $where[laborTableClass::VALOR] = array(
         $filter['valor1'],
         $filter['valor2']
          );
        } 
        
        if (isset($filter['fechaIni']) and $filter['fechaIni'] !== null and $filter['fechaIni'] !== '' and (isset($filter['fechaFin']) and $filter['fechaFin'] !== null and $filter['fechaFin'] !== '')) {
          $where[laborTableClass::CREATED_AT] = array(
          date(config::getFormatTimestamp(), strtotime($filter['fechaIni'] . ' 00:00:00')),
          date(config::getFormatTimestamp(), strtotime($filter['fechaFin'] . ' 23:59:59'))
          );
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
