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
class indexLoteActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      $where = null;
      if(request::getInstance()->hasPost('filter')){
      $filter = request::getInstance()->getPost('filter');
      //validar
      if(isset($filter['ubicacion']) and $filter['ubicacion'] !== null and $filter['ubicacion'] !== ""){
        $where[loteTableClass::UBICACION] = $filter['ubicacion'];
      }
      if(isset($filter['tamano']) and $filter['tamano'] !== null and $filter['tamano'] !== ""){
        $where[loteTableClass::TAMANO] = $filter['tamano'];
      }
      if(isset($filter['descripcion']) and $filter['descripcion'] !== null and $filter['descripcion'] !== ""){
        $where[loteTableClass::DESCRIPCION] = $filter['descripcion'];
      }
       
      if((isset($filter['fechaIni']) and $filter['fechaIni'] !== null and $filter['fechaIni'] !== "") and (isset($filter['fechaFin']) and $filter['fechaFin'] !== null and $filter['fechaFin'] !== "" )){
        $where[loteTableClass::CREATED_AT] = array(
           date(config::getFormatTimestamp(), strtotime($filter['fechaIni'].' 00:00:00')),
           date(config::getFormatTimestamp(), strtotime($filter['fechaFin'].' 23:59:59'))
            );
      }     
      }
      $fields = array(
          loteTableClass::ID,
          loteTableClass::UBICACION,
          loteTableClass::TAMANO,
          loteTableClass::DESCRIPCION,
          loteTableClass::ID_CIUDAD, 
          loteTableClass::CREATED_AT,
          loteTableClass::UPDATED_AT
      );
      $orderBy = array(
         loteTableClass::ID
      );
      $page = 0;
      if (request::getInstance()->hasGet('page')) {
        $this->page = request::getInstance()->getGet('page');
        $page = request::getInstance()->getGet('page') - 1;
        $page = $page * config::getRowGrid();
      }
      $this->cntPages = loteTableClass::getTotalPages(config::getRowGrid());
      
      $this->objLote = loteTableClass::getAll($fields, true, $orderBy, 'ASC',config::getRowGrid(), $page,$where);
     if(request::getInstance()->hasPost('filter')){
      $filter = request::getInstance()->getPost('filter');
      if(isset($filter['ciudad']) and $filter['ciudad'] !== null and $filter['ciudad'] !== ""){
        $where[loteTableClass::ID_CIUDAD] = $filter['ciudad'];
     }
     
      }
      
      $fields = array(     
      ciudadTableClass::ID, 
      ciudadTableClass::NOMBRE_CIUDAD
      );
      $orderBy = array(
      ciudadTableClass::NOMBRE_CIUDAD    
      ); 
      $this->objCC = ciudadTableClass::getAll($fields, false, $orderBy, 'ASC');
      
      $this->defineView('indexLote', 'lote', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
}

}
