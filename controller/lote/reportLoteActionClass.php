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
 * @category: modulo de maquina.
 */
class reportLoteActionClass extends controllerClass implements controllerActionInterface {

  
  /**
* @author: Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon .
* @date: fecha de inicio del desarrollo.
* @return loteTableClass::ID (integer),
          loteTableClass::UBICACION (string),
          loteTableClass::TAMANO (integer),
          loteTableClass::DESCRIPCION (string),
          loteTableClass::ID_CIUDAD (integer), 
          loteTableClass::CREATED_AT (timestamp),
          loteTableClass::UPDATED_AT (timestamp),
          unidadDistanciaTableClass::ID, 
          unidadDistanciaTableClass::DESCRIPCION
          ciudadTableClass::ID, 
          ciudadTableClass::NOMBRE_CIUDAD
          productoInsumoTableClass::ID, 
          productoInsumoTableClass::DESCRIPCION
 * estos datos retornan en la variable $fields
*/
  
  public function execute() {
    try {
     $where = null;
      if(request::getInstance()->hasPost('filter')){
      $filter = request::getInstance()->getPost('filter');
      //validar
      if(isset($filter['ubicacion']) and $filter['ubicacion'] !== null and $filter['ubicacion'] !== ""){
        $where[loteTableClass::UBICACION] = $filter['ubicacion'];
      }//cierre del filtro ubicacion
      
      if(isset($filter['tamano']) and $filter['tamano'] !== null and $filter['tamano'] !== ""){
        $where[loteTableClass::TAMANO] = $filter['tamano'];
      }//cierre del filtro tamano
      
      if(isset($filter['descripcion']) and $filter['descripcion'] !== null and $filter['descripcion'] !== ""){
        $where[loteTableClass::DESCRIPCION] = $filter['descripcion'];
      }//cierre del filtro descripcion
      
      if(isset($filter['ciudad']) and $filter['ciudad'] !== null and $filter['ciudad'] !== ""){
        $where[loteTableClass::ID_CIUDAD] = $filter['ciudad'];
      }//cierre del filtro ciudad
       
      if((isset($filter['fechaIni']) and $filter['fechaIni'] !== null and $filter['fechaIni'] !== "") and (isset($filter['fechaFin']) and $filter['fechaFin'] !== null and $filter['fechaFin'] !== "" )){
        $where[loteTableClass::CREATED_AT] = array(
           date(config::getFormatTimestamp(), strtotime($filter['fechaIni'].' 00:00:00')),
           date(config::getFormatTimestamp(), strtotime($filter['fechaFin'].' 23:59:59'))
            );
      }//cierre del filtro fechaIni y fechaFin
        
      }//cierre del POST del reporte
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
      
      
      $this->objLote = loteTableClass::getAll($fields, true, $orderBy, 'ASC',null,null,$where);
     
      
         $fields = array(     
      unidadDistanciaTableClass::ID, 
      unidadDistanciaTableClass::DESCRIPCION
      );
      $orderBy = array(
      unidadDistanciaTableClass::DESCRIPCION    
      ); 
      $this->objLUD = unidadDistanciaTableClass::getAll($fields, false, $orderBy, 'ASC');
     
        
        
        $fields = array(     
      ciudadTableClass::ID, 
      ciudadTableClass::NOMBRE_CIUDAD
      );
      $orderBy = array(
      ciudadTableClass::NOMBRE_CIUDAD    
      ); 
      $this->objLC = ciudadTableClass::getAll($fields, false, $orderBy, 'ASC');
     
      $fields = array(     
      productoInsumoTableClass::ID, 
      productoInsumoTableClass::DESCRIPCION
      );
      $orderBy = array(
      productoInsumoTableClass::DESCRIPCION    
      ); 
      $this->objLPI = productoInsumoTableClass::getAll($fields, true, $orderBy, 'ASC');
     
      $this->defineView('indexLote', 'lote', session::getInstance()->getFormatOutput());
    }//cierre del try
      catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo '<pre>';
      print_r($exc->getTrace());
      echo '</pre>';
     }//cierre del catch
}//cierre de la funcion execute

}//cierre de la clase