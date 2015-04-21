
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
class editLoteActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {

      if (request::getInstance()->hasRequest(loteTableClass::ID)) {
        $fields = array(
            loteTableClass::ID,
            loteTableClass::UBICACION,
            loteTableClass::TAMANO,
            loteTableClass::UNIDAD_DISTANCIA_ID,
            loteTableClass::DESCRIPCION,
            loteTableClass::FECHA_INICIO_SIEMBRA,
            loteTableClass::NUMERO_PLANTULAS,
            loteTableClass::PRESUPUESTO,
            loteTableClass::PRODUCTO_INSUMO_ID,
            loteTableClass::ID_CIUDAD   
        );
        $where = array(
            loteTableClass::ID => request::getInstance()->getRequest(loteTableClass::ID)
        );
        $this->objLote = loteTableClass::getAll($fields, true, null, null, null, null, $where);
       
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
     
      
        $this->defineView('editLote', 'lote', session::getInstance()->getFormatOutput());
        
      }else{
        routing::getInstance()->redirect('lote', 'indexLote');
      }

    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}
