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
* @category: modulo de cliente.
*/
class editActionClass extends controllerClass implements controllerActionInterface {

  /**
* @author: Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon .
* @date: fecha de inicio del desarrollo.
* @return   controlEnfermedadTableClass::ID retorna (integer),
            controlEnfermedadTableClass::NOMBRE retorna (string),
            controlEnfermedadTableClass::APELLIDO retorna (string),
            controlEnfermedadTableClass::DOCUMENTO retorna  (integer),
            controlEnfermedadTableClass::DIRECCION retorna (string),
            controlEnfermedadTableClass::TELEFONO retorna  (integer),
            controlEnfermedadTableClass::ID_TIPO_ID retorna  (integer),
            controlEnfermedadTableClass::ID_CIUDAD retorna  (integer),
 * estos datos retornan en la variable $fields y el Id en la variable $WHERE
*/
  public function execute() {
    try {

      if (request::getInstance()->hasGet(controlEnfermedadTableClass::ID)) {
       $fields = array(
          controlEnfermedadTableClass::ID,
          controlEnfermedadTableClass::LOTE_ID,
          controlEnfermedadTableClass::ENFERMEDAD_ID,
          controlEnfermedadTableClass::PRODUCTO_INSUMO_ID,
          controlEnfermedadTableClass::CANTIDAD,
          controlEnfermedadTableClass::UNIDAD_MEDIDA_ID
        );
        $where = array(
            controlEnfermedadTableClass::ID => request::getInstance()->getGet(controlEnfermedadTableClass::ID)
        );
        $this->objControlEnfermedad = controlEnfermedadTableClass::getAll($fields, true, null, null, null, null, $where);
        
//        $id = array(
//            controlEnfermedadTableClass::ID => request::getInstance()->getRequest(controlEnfermedadTableClass::ID)
//        );

        $idProducto = $this->objControlEnfermedad[0]->producto_insumo_id;
        $this->idTipoProducto = controlEnfermedadTableClass::getTipoInsumo($idProducto);

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

        
       $fields = array(
            tipoProductoInsumoTableClass::ID,
            tipoProductoInsumoTableClass::DESCRIPCION
        );
        $orderBy = array(
            tipoProductoInsumoTableClass::DESCRIPCION
        );
        $this->objTipo = tipoProductoInsumoTableClass::getAll($fields, true, $orderBy, 'ASC');

      $fields = array(     
      loteTableClass::ID, 
      loteTableClass::UBICACION
      );
      $orderBy = array(
      loteTableClass::UBICACION    
      ); 
      $this->objLote = loteTableClass::getAll($fields, true, $orderBy, 'ASC');
      
       $fields = array(     
      enfermedadTableClass::ID, 
      enfermedadTableClass::NOMBRE
      );
      $orderBy = array(
      enfermedadTableClass::NOMBRE    
      ); 
      $this->objEnfermedad = enfermedadTableClass::getAll($fields, false, $orderBy, 'ASC');

      $fields = array(
          unidadMedidaTableClass::ID,
          unidadMedidaTableClass::DESCRIPCION
      );
      $orderBy = array(
          unidadMedidaTableClass::DESCRIPCION
      );
      $this->objUnidadMedida = unidadMedidaTableClass::getAll($fields, false, $orderBy, 'ASC');  
        
        $this->defineView('edit', 'controlEnfermedad', session::getInstance()->getFormatOutput());
        
      }//cierre del if existencia de id
       else{
        routing::getInstance()->redirect('controlEnfermedad', 'index');
      }//cierre del else

    }//cierre del try
      catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }//cierre del catch
  }//cierre de la funcion execute

}//cierre de la clase
