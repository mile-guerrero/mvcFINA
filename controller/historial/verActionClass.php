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
class verActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      $fields = array(
          historialTableClass::ID,
            historialTableClass::PRODUCTO_INSUMO_ID,          
            historialTableClass::ENFERMEDAD_ID,
          historialTableClass::CREATED_AT        
      );
     
       $where = array(
            historialTableClass::ID => request::getInstance()->getRequest(historialTableClass::ID)
      );
      $this->objHistorial = historialTableClass::getAll($fields,false, null, null, null, null,$where);
      
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

  $this->defineView('ver', 'historial', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
}

}
