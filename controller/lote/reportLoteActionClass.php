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
      if(request::getInstance()->hasPost('report')){
      $report = request::getInstance()->getPost('report');
      //validar
      if(isset($report['ubicacion']) and $report['ubicacion'] !== null and $report['ubicacion'] !== ""){
         $where[] = '(' . loteTableClass::getNameField(loteTableClass::UBICACION) . ' LIKE ' . '\'' . $report['ubicacion'] . '%\'  '
              . 'OR ' . loteTableClass::getNameField(loteTableClass::UBICACION) . ' LIKE ' . '\'%' . $report['ubicacion'] . '%\' '
              . 'OR ' . loteTableClass::getNameField(loteTableClass::UBICACION) . ' LIKE ' . '\'%' . $report['ubicacion'].'\') ';       
              }//cierre del filtro ubicacion
              
      if((isset($report['tamanoIni']) and $report['tamanoIni'] !== null and $report['tamanoIni'] !== "") and (isset($report['tamanoFin']) and $report['tamanoFin'] !== null and $report['tamanoFin'] !== "" )){
        $where[loteTableClass::TAMANO] = array(
           $report['tamanoIni'],
           $report['tamanoFin']
            );
      }//cierre del filtro tamanoIni y tamanoFin       
              
      if((isset($report['fechaIni']) and $report['fechaIni'] !== null and $report['fechaIni'] !== "") and (isset($report['fechaFin']) and $report['fechaFin'] !== null and $report['fechaFin'] !== "" )){
        $where[loteTableClass::CREATED_AT] = array(
           date(config::getFormatTimestamp(), strtotime($report['fechaIni'].' 00:00:00')),
           date(config::getFormatTimestamp(), strtotime($report['fechaFin'].' 23:59:59'))
            );
        } //cierre del filtro fechaIni y fechaFin
        
        if((isset($report['fechaSI']) and $report['fechaSI'] !== null and $report['fechaSI'] !== "") and (isset($report['fechaSF']) and $report['fechaSF'] !== null and $report['fechaSF'] !== "" )){
        $where[loteTableClass::FECHA_INICIO_SIEMBRA] = array(
           date(config::getFormatTimestamp(), strtotime($report['fechaSI'].' 00:00:00')),
           date(config::getFormatTimestamp(), strtotime($report['fechaSF'].' 23:59:59'))
            );
        } //cierre del filtro fechaSI y fechaSF
      
      
      if(isset($report['ciudad']) and $report['ciudad'] !== null and $report['ciudad'] !== ""){
        $where[loteTableClass::ID_CIUDAD] = $report['ciudad'];
      }//cierre del filtro ciudad
      }//cierre del POST report 
      
      $this->mensaje = 'Informacion de Lote';
      $fields = array(
          loteTableClass::ID,
          loteTableClass::UBICACION,
          loteTableClass::TAMANO,
          loteTableClass::DESCRIPCION,
          loteTableClass::ID_CIUDAD, 
          loteTableClass::NUMERO_PLANTULAS,
          loteTableClass::FECHA_INICIO_SIEMBRA,
          loteTableClass::FECHA_RIEGO,
          loteTableClass::PRODUCTO_INSUMO_ID,
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