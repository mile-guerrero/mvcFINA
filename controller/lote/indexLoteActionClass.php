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
class indexLoteActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      
      $where = null;
      
      $fields = array(
          loteTableClass::ID,
            loteTableClass::UBICACION,
            /*loteTableClass::TAMANO,
            loteTableClass::UNIDAD_DISTANCIA_ID,
            loteTableClass::DESCRIPCION,
            loteTableClass::FECHA_INICIO_SIEMBRA,
            loteTableClass::NUMERO_PLANTULAS,
            loteTableClass::PRESUPUESTO,
            loteTableClass::PRODUCTO_INSUMO_ID,
            loteTableClass::ID_CIUDAD, 
          loteTableClass::CREATED_AT,
          loteTableClass::UPDATED_AT*/
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
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
}

}
