
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
class editLoteMasActionClass extends controllerClass implements controllerActionInterface {

  
  
  public function execute() {
    try {

      if (request::getInstance()->hasGet(loteTableClass::ID)) {
        $fields = array(
            loteTableClass::ID,
            loteTableClass::UBICACION,
            loteTableClass::TAMANO,
            loteTableClass::UNIDAD_DISTANCIA_ID,
            loteTableClass::UNIDAD_MEDIDA_ID,
            loteTableClass::DESCRIPCION,
            loteTableClass::PRODUCCION,
            loteTableClass::FECHA_INICIO_SIEMBRA,
            loteTableClass::FECHA_RIEGO,
            loteTableClass::NUMERO_PLANTULAS,
            loteTableClass::PRESUPUESTO,
            loteTableClass::PRODUCTO_INSUMO_ID,
            loteTableClass::ID_CIUDAD   
        );
        $where = array(
            loteTableClass::ID => request::getInstance()->getGet(loteTableClass::ID)
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
          unidadMedidaTableClass::ID, 
          unidadMedidaTableClass::DESCRIPCION
      );
      $orderBy = array(
          unidadMedidaTableClass::DESCRIPCION    
      ); 
      $this->objLUMedida = unidadMedidaTableClass::getAll($fields, false, $orderBy, 'ASC');
     
         $fields = array(     
      tipoProductoInsumoTableClass::ID, 
      tipoProductoInsumoTableClass::DESCRIPCION
      );
      $orderBy = array(
      tipoProductoInsumoTableClass::DESCRIPCION    
      ); 
      $this->objTipo = tipoProductoInsumoTableClass::getAll($fields, false, $orderBy, 'ASC');
        
        $fields = array(     
      ciudadTableClass::ID, 
      ciudadTableClass::NOMBRE_CIUDAD
      );
      $orderBy = array(
      ciudadTableClass::NOMBRE_CIUDAD    
      ); 
      $this->objLC = ciudadTableClass::getAll($fields, false, $orderBy, 'ASC');
     
     $idProducto = $this->objLote[0]->producto_insumo_id;
        $this->idTipoProducto = loteTableClass::getTipoInsumo($idProducto);

        $fields = array(
            productoInsumoTableClass::ID,
            productoInsumoTableClass::DESCRIPCION
        );
        $orderBy = array(
            productoInsumoTableClass::DESCRIPCION
        );
        $whereProducto = array(
            productoInsumoTableClass::TIPO_PRODUCTO_INSUMO_ID => $this->idTipoProducto
        );
        $this->objProducto = productoInsumoTableClass::getAll($fields, true, $orderBy, 'ASC', null, null, $whereProducto);

     
      
        $this->defineView('editLoteMas', 'lote', session::getInstance()->getFormatOutput());
        
      }//cierre de if  GET
        else{
        routing::getInstance()->redirect('lote', 'indexLote');
      }//cierre del else

    }//cierre del try
      catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
   }//cierre del catch
}//cierre de la funcion execute

}//cierre de la clase
