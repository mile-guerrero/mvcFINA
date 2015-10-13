
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
 * @author 
 */
class editActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
   
      if (request::getInstance()->hasGet(detalleFacturaCompraTableClass::ID)) {
        
        $fields = array(
            
          detalleFacturaCompraTableClass::ID,
          detalleFacturaCompraTableClass::DESCRIPCION,
          detalleFacturaCompraTableClass::CANTIDAD,
          detalleFacturaCompraTableClass::VALOR_UNIDAD,
          detalleFacturaCompraTableClass::VALOR_TOTAL,
          detalleFacturaCompraTableClass::FACTURA_COMPRA_ID,
          detalleFacturaCompraTableClass::UNIDAD_MEDIDA_ID,
          detalleFacturaCompraTableClass::CREATED_AT,
          detalleFacturaCompraTableClass::UPDATED_AT
        );
        $where = array(
            detalleFacturaCompraTableClass::ID => request::getInstance()->getGet(detalleFacturaCompraTableClass::ID)
        );
        $this->objDetalleFactura = detalleFacturaCompraTableClass::getAll($fields, false, null, null, null, null, $where);
        $id = array(
            detalleFacturaCompraTableClass::ID => request::getInstance()->getRequest(detalleFacturaCompraTableClass::ID)
        );

        $idProducto = $this->objDetalleFactura[0]->producto_insumo_id;
        $this->idTipoProducto = detalleFacturaCompraTableClass::getTipoInsumo($idProducto);
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
           facturaCompraTableClass::ID,
           facturaCompraTableClass::FECHA
        );
        $orderBy = array(
            facturaCompraTableClass::FECHA
        );
        $this->objFactura = facturaCompraTableClass::getAll($fields, false, $orderBy, 'ASC');
      
       $fields = array(
            tipoProductoInsumoTableClass::ID,
            tipoProductoInsumoTableClass::DESCRIPCION
      );
      $orderBy = array(
          tipoProductoInsumoTableClass::DESCRIPCION
      );
      $this->objTipo = tipoProductoInsumoTableClass::getAll($fields, true, $orderBy, 'ASC');
      
      $fields = array(
          unidadMedidaTableClass::ID,
          unidadMedidaTableClass::DESCRIPCION
      );
      $orderBy = array(
          unidadMedidaTableClass::DESCRIPCION
      );
      $this->objUnidadMedida = unidadMedidaTableClass::getAll($fields, false, $orderBy, 'ASC');
      
        $this->defineView('edit', 'detalleFacturaCompra', session::getInstance()->getFormatOutput());
        $idFactura = facturaCompraTableClass::ID;
        
      }else{
        routing::getInstance()->redirect('detalleFacturaCompra', 'edit', array(facturaCompraTableClass::ID => $idFactura));
      }

    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}

