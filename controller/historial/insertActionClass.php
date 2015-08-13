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
class insertActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      $fields = array(
      productoInsumoTableClass::ID,
      productoInsumoTableClass::DESCRIPCION
      );
      $orderBy = array(
      productoInsumoTableClass::DESCRIPCION   
      );      
      $this->objHistoriInsumo = productoInsumoTableClass::getAll($fields, true, $orderBy, 'ASC');
      
      $fields = array(     
      enfermedadTableClass::ID, 
      enfermedadTableClass::NOMBRE
      );
      $orderBy = array(
      enfermedadTableClass::NOMBRE    
      ); 
      $this->objHistoriEnfermedad = enfermedadTableClass::getAll($fields, true, $orderBy, 'ASC');
      
      $fields = array(     
      plagaTableClass::ID, 
      plagaTableClass::NOMBRE,
      plagaTableClass::DESCRIPCION,
      plagaTableClass::TRATAMIENTO
      );
      $orderBy = array(
      plagaTableClass::NOMBRE    
      ); 
      $this->objHistorialPlaga = plagaTableClass::getAll($fields, false, $orderBy, 'ASC');
      
      $fields = array(     
      loteTableClass::ID, 
      loteTableClass::UBICACION,
      loteTableClass::FECHA_RIEGO
      );
      $orderBy = array(
      loteTableClass::UBICACION    
      ); 
      $this->objHistorialLote = loteTableClass::getAll($fields, true, $orderBy, 'ASC');
      
      $this->defineView('insert', 'historial', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
}

}
