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
* @return   controlPlagaTableClass::ID retorna (integer),
            controlPlagaTableClass::NOMBRE retorna (string),
            controlPlagaTableClass::APELLIDO retorna (string),
            controlPlagaTableClass::DOCUMENTO retorna  (integer),
            controlPlagaTableClass::DIRECCION retorna (string),
            controlPlagaTableClass::TELEFONO retorna  (integer),
            controlPlagaTableClass::ID_TIPO_ID retorna  (integer),
            controlPlagaTableClass::ID_CIUDAD retorna  (integer),
 * estos datos retornan en la variable $fields y el Id en la variable $WHERE
*/
  public function execute() {
    try {

      if (request::getInstance()->hasGet(controlPlagaTableClass::ID)) {
       $fields = array(
          controlPlagaTableClass::ID,
          controlPlagaTableClass::LOTE_ID,
          controlPlagaTableClass::PLAGA_ID,
          controlPlagaTableClass::PRODUCTO_INSUMO_ID,
          controlPlagaTableClass::CANTIDAD,
          controlPlagaTableClass::UNIDAD_MEDIDA_ID 
        );
        $where = array(
            controlPlagaTableClass::ID => request::getInstance()->getGet(controlPlagaTableClass::ID)
        );
        $this->objControlPlaga = controlPlagaTableClass::getAll($fields, true, null, null, null, null, $where);
        
//        $id = array(
//            controlPlagaTableClass::ID => request::getInstance()->getRequest(controlPlagaTableClass::ID)
//        );

        $idProducto = $this->objControlPlaga[0]->producto_insumo_id;
        $this->idTipoProducto = controlPlagaTableClass::getTipoInsumo($idProducto);

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
      plagaTableClass::ID, 
      plagaTableClass::NOMBRE
      );
      $orderBy = array(
      plagaTableClass::NOMBRE    
      ); 
      $this->objPlaga = plagaTableClass::getAll($fields, false, $orderBy, 'ASC');

      $fields = array(
          unidadMedidaTableClass::ID,
          unidadMedidaTableClass::DESCRIPCION
      );
      $orderBy = array(
          unidadMedidaTableClass::DESCRIPCION
      );
      $this->objUnidadMedida = unidadMedidaTableClass::getAll($fields, false, $orderBy, 'ASC');         
        
      $this->defineView('edit', 'controlPlaga', session::getInstance()->getFormatOutput());
        
      }//cierre del if existencia de id
       else{
        routing::getInstance()->redirect('controlPlaga', 'index');
      }//cierre del else

    }//cierre del try
      catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }//cierre del catch
  }//cierre de la funcion execute

}//cierre de la clase
