
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
class editActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
   
      if (request::getInstance()->hasGet(solicitudInsumoTableClass::ID)) {
        $fields = array(
            solicitudInsumoTableClass::ID,
            solicitudInsumoTableClass::FECHA_HORA,
            solicitudInsumoTableClass::TRABAJADOR_ID,
            solicitudInsumoTableClass::CANTIDAD,
            solicitudInsumoTableClass::PRODUCTO_INSUMO_ID,
            solicitudInsumoTableClass::LOTE_ID,
            solicitudInsumoTableClass::UNIDAD_MEDIDA_ID
        );
        $where = array(
            solicitudInsumoTableClass::ID => request::getInstance()->getGet(solicitudInsumoTableClass::ID)
        );
        $this->objS = solicitudInsumoTableClass::getAll($fields, true, null, null, null, null, $where);
        
         $id = array(
            solicitudInsumoTableClass::ID => request::getInstance()->getRequest(solicitudInsumoTableClass::ID)
        );

        $idProducto = $this->objS[0]->producto_insumo_id;
        $this->idTipoProducto = solicitudInsumoTableClass::getTipoInsumo($idProducto);

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
            trabajadorTableClass::ID,
            trabajadorTableClass::NOMBRET
        );
        $orderBy = array(
            trabajadorTableClass::NOMBRET
        );
        $this->objT = trabajadorTableClass::getAll($fields, true, $orderBy, 'ASC');
        
     
        $fields = array(
            loteTableClass::ID,
            loteTableClass::UBICACION
        );
        $orderBy = array(
            loteTableClass::UBICACION
        );
        $this->objL = loteTableClass::getAll($fields, true, $orderBy, 'ASC');
        
        $fields = array(
          unidadMedidaTableClass::ID,
          unidadMedidaTableClass::DESCRIPCION
      );
      $orderBy = array(
          unidadMedidaTableClass::DESCRIPCION
      );
      $this->objUnidadMedida = unidadMedidaTableClass::getAll($fields, false, $orderBy, 'ASC');
        
        $this->defineView('edit', 'solicitudInsumo', session::getInstance()->getFormatOutput());
     
      }else{
        routing::getInstance()->redirect('solicitudInsumo', 'index');
      }

    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}
