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
class reportActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      
     
     $where = null;
     
     if(request::getInstance()->hasPost('report')){
      $report = request::getInstance()->getPost('report');
      //validar
      if(isset($report['insumo']) and $report['insumo'] !== null and $report['insumo'] !== ""){
        $where[historialTableClass::PRODUCTO_INSUMO_ID] = $report['insumo'];
      }
      if(isset($report['enfermedad']) and $report['enfermedad'] !== null and $report['enfermedad'] !== ""){
        $where[historialTableClass::ENFERMEDAD_ID] = $report['enfermedad'];
      }
      if((isset($report['fechaIni']) and $report['fechaIni'] !== null and $report['fechaIni'] !== "") and (isset($report['fechaFin']) and $report['fechaFin'] !== null and $report['fechaFin'] !== "" )){
        $where[historialTableClass::CREATED_AT] = array(
           date(config::getFormatTimestamp(), strtotime($report['fechaIni'].' 00:00:00')),
           date(config::getFormatTimestamp(), strtotime($report['fechaFin'].' 23:59:59'))
            );
      } 
      }
       $this->mensaje = 'Informe de historial';
     $fields = array(
          historialTableClass::ID,
            historialTableClass::PRODUCTO_INSUMO_ID,
          historialTableClass::LOTE_ID,
            historialTableClass::ENFERMEDAD_ID,
          historialTableClass::CREATED_AT 
      );
      $orderBy = array(
      historialTableClass::ID   
      ); 
      
      $this->objHistorial = historialTableClass::getAll($fields, false, $orderBy, 'ASC',null,null,$where);

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
      echo '<pre>';
      print_r($exc->getTrace());
      echo '</pre>';
    }
  }

}
