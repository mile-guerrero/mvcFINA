
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

      if (request::getInstance()->hasGet(detalleFacturaVentaTableClass::ID)) {




//     $this->idTipo = detalleFacturaVentaTableClass::getTipoInsumo($idVenta);
//        echo $idProducto;
//        exit();


        $fields = array(
            detalleFacturaVentaTableClass::ID,
            detalleFacturaVentaTableClass::DESCRIPCION,
            detalleFacturaVentaTableClass::CANTIDAD,
            detalleFacturaVentaTableClass::VALOR_UNIDAD,
            detalleFacturaVentaTableClass::VALOR_TOTAL,
            detalleFacturaVentaTableClass::FACTURA_ID,
            detalleFacturaVentaTableClass::CREATED_AT,
            detalleFacturaVentaTableClass::UPDATED_AT
        );
        $where = array(
            detalleFacturaVentaTableClass::ID => request::getInstance()->getGet(detalleFacturaVentaTableClass::ID)
        );
        $this->objDetalleFactura = detalleFacturaVentaTableClass::getAll($fields, false, null, null, null, null, $where);

        $id = array(
            detalleFacturaVentaTableClass::ID => request::getInstance()->getRequest(detalleFacturaVentaTableClass::ID)
        );

        $idProducto = $this->objDetalleFactura[0]->producto_insumo_id;
        $this->idTipoProducto = detalleFacturaVentaTableClass::getTipoInsumo($idProducto);

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
            facturaVentaTableClass::ID,
            facturaVentaTableClass::FECHA
        );
        $orderBy = array(
            facturaVentaTableClass::FECHA
        );
        $this->objFactura = facturaVentaTableClass::getAll($fields, false, $orderBy, 'ASC');

       

        $this->defineView('edit', 'detalleFacturaVenta', session::getInstance()->getFormatOutput());
        $idFactura = facturaVentaTableClass::ID;
      } else {
        routing::getInstance()->redirect('detalleFacturaVenta', 'edit', array(facturaVentaTableClass::ID => $idFactura));
      }
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}
