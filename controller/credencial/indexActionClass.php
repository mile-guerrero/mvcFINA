<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon 
 * @date: fecha de inicio del desarrollo.
 * @category: modulo de credencial.
 */
class indexActionClass extends controllerClass implements controllerActionInterface {

  
 /**
* @author: Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon .
* @date: fecha de inicio del desarrollo.
* @return   credencialTableClass::ID retorna (integer),
            credencialTableClass::NOMBRE retorna  (string),
            credencialTableClass::CREATED_AT retorna  (timestamp),
            credencialTableClass::UPDATED_AT retorna  (timestamp),
 * estos datos retornan en la variable $fields
*/
  public function execute() {
    try {
          $where = null;
      if(request::getInstance()->hasPost('filter')){
      $filter = request::getInstance()->getPost('filter');
      //validar
      if(isset($filter['nombre']) and $filter['nombre'] !== null and $filter['nombre'] !== ""){
        $where[] = '(' . credencialTableClass::getNameField(credencialTableClass::NOMBRE) . ' LIKE ' . '\'' . $filter['nombre'] . '%\'  '
              . 'OR ' . credencialTableClass::getNameField(credencialTableClass::NOMBRE) . ' LIKE ' . '\'%' . $filter['nombre'] . '%\' '
              . 'OR ' . credencialTableClass::getNameField(credencialTableClass::NOMBRE) . ' LIKE ' . '\'%' . $filter['nombre'].'\') ';       
              }//cierre del filtro nombre
              
       if((isset($filter['fechaIni']) and $filter['fechaIni'] !== null and $filter['fechaIni'] !== "") and (isset($filter['fechaFin']) and $filter['fechaFin'] !== null and $filter['fechaFin'] !== "" )){
        $where[credencialTableClass::CREATED_AT] = array(
           date(config::getFormatTimestamp(), strtotime($filter['fechaIni'].' 00:00:00')),
           date(config::getFormatTimestamp(), strtotime($filter['fechaFin'].' 23:59:59'))
            );
      }//cierre del filtro fecha1 y fecha2       
      }//cierre del POST del reporte
      $fields = array(
          credencialTableClass::ID,
          credencialTableClass::NOMBRE,
		  credencialTableClass::CREATED_AT,
          credencialTableClass::UPDATED_AT
      );
      $orderBy = array(
         credencialTableClass::ID
      );
      $page = 0;
      if (request::getInstance()->hasGet('page')) {
        $this->page = request::getInstance()->getGet('page');
        $page = request::getInstance()->getGet('page') - 1;
        $page = $page * config::getRowGrid();
      }//cierre de paginado
      $this->cntPages = credencialTableClass::getTotalPages(config::getRowGrid());
      
      $this->objCredencial = credencialTableClass::getAll($fields, true, $orderBy, 'ASC',config::getRowGrid(), $page,$where);
      $this->defineView('index', 'credencial', session::getInstance()->getFormatOutput());
    }//cierre del try 
      catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }//cierre del catch
  }//cierre de la funcion execute

}//cierre de la clase
