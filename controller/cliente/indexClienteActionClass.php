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
class indexClienteActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      $where = null;
      if(request::getInstance()->hasPost('filter')){
      $filter = request::getInstance()->getPost('filter');
      //validar
      if(isset($filter['nombre']) and $filter['nombre'] !== null and $filter['nombre'] !== ""){
        $where[clienteTableClass::NOMBRE] = $filter['nombre'];
      }
      if(isset($filter['apellido']) and $filter['apellido'] !== null and $filter['apellido'] !== ""){
        $where[clienteTableClass::APELLIDO] = $filter['apellido'];
      }
      if(isset($filter['ciudad']) and $filter['ciudad'] !== null and $filter['ciudad'] !== ""){
      $where[clienteTableClass::ID_CIUDAD] = $filter['ciudad'];
      }
      if((isset($filter['fechaIni']) and $filter['fechaIni'] !== null and $filter['fechaIni'] !== "") and (isset($filter['fechaFin']) and $filter['fechaFin'] !== null and $filter['fechaFin'] !== "" )){
        $where[clienteTableClass::CREATED_AT] = array(
           date(config::getFormatTimestamp(), strtotime($filter['fechaIni'].' 00:00:00')),
           date(config::getFormatTimestamp(), strtotime($filter['fechaFin'].' 23:59:59'))
            );
      }     
      }
        
      $fields = array(
          clienteTableClass::ID,
          clienteTableClass::NOMBRE,
          clienteTableClass::APELLIDO,
          clienteTableClass::DIRECCION,
          clienteTableClass::TELEFONO,
          clienteTableClass::ID_TIPO_ID,
          clienteTableClass::ID_CIUDAD,
          clienteTableClass::CREATED_AT,
          clienteTableClass::UPDATED_AT
      );
      $orderBy = array(
         clienteTableClass::ID
      );
       $page = 0;
      if (request::getInstance()->hasGet('page')) {
        $this->page = request::getInstance()->getGet('page');
        $page = request::getInstance()->getGet('page') - 1;
        $page = $page * config::getRowGrid();
      }
      $this->cntPages = clienteTableClass::getTotalPages(config::getRowGrid());
      $this->objCliente = clienteTableClass::getAll($fields, true, $orderBy, 'ASC',config::getRowGrid(), $page,$where);
 $fields = array(     
      ciudadTableClass::ID, 
      ciudadTableClass::NOMBRE_CIUDAD
      );
      $orderBy = array(
      ciudadTableClass::NOMBRE_CIUDAD    
      ); 
      $this->objCC = ciudadTableClass::getAll($fields, false, $orderBy, 'ASC');

    
      $this->defineView('indexCliente', 'cliente', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
}

}
