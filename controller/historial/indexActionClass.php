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
      if(request::getInstance()->hasPost('filter')){
      $filter = request::getInstance()->getPost('filter');
      //validar
      if(isset($filter['insumo']) and $filter['insumo'] !== null and $filter['insumo'] !== ""){
        $where[historialTableClass::PRODUCTO_INSUMO_ID] = $filter['insumo'];
      }
      if(isset($filter['enfermedad']) and $filter['enfermedad'] !== null and $filter['enfermedad'] !== ""){
        $where[historialTableClass::ENFERMEDAD_ID] = $filter['enfermedad'];
      }
      if((isset($filter['fechaIni']) and $filter['fechaIni'] !== null and $filter['fechaIni'] !== "") and (isset($filter['fechaFin']) and $filter['fechaFin'] !== null and $filter['fechaFin'] !== "" )){
        $where[historialTableClass::CREATED_AT] = array(
           date(config::getFormatTimestamp(), strtotime($filter['fechaIni'].' 00:00:00')),
           date(config::getFormatTimestamp(), strtotime($filter['fechaFin'].' 23:59:59'))
            );
      } 
      }
      
      $fields = array(
          historialTableClass::ID,
            historialTableClass::PRODUCTO_INSUMO_ID,          
            historialTableClass::ENFERMEDAD_ID,
          historialTableClass::CREATED_AT        
      );
      $orderBy = array(
         historialTableClass::ID
      );
      $page = 0;
      if (request::getInstance()->hasGet('page')) {
        $this->page = request::getInstance()->getGet('page');
        $page = request::getInstance()->getGet('page') - 1;
        $page = $page * config::getRowGrid();
      }
      $this->cntPages = historialTableClass::getTotalPages(config::getRowGrid());
      
      $this->objHistorial = historialTableClass::getAll($fields, false, $orderBy, 'ASC',config::getRowGrid(), $page,$where);
     
      $fields = array(     
      productoInsumoTableClass::ID, 
      productoInsumoTableClass::DESCRIPCION
      );
      $orderBy = array(
      productoInsumoTableClass::DESCRIPCION    
      ); 
      $this->objHistorialProducto = productoInsumoTableClass::getAll($fields, true, $orderBy, 'ASC');
      
      $fields = array(     
      enfermedadTableClass::ID, 
      enfermedadTableClass::NOMBRE
      );
      $orderBy = array(
      enfermedadTableClass::NOMBRE    
      ); 
      $this->objHistorialEnfermedad = enfermedadTableClass::getAll($fields, true, $orderBy, 'ASC');
      
      
      $this->defineView('index', 'historial', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
}

}
