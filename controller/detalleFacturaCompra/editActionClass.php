
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
   
      if (request::getInstance()->hasRequest(detalleFacturaCompraTableClass::ID)) {
        
        $fields = array(
            
          detalleFacturaCompraTableClass::ID,
          detalleFacturaCompraTableClass::DESCRIPCION,
          detalleFacturaCompraTableClass::CANTIDAD,
          detalleFacturaCompraTableClass::VALOR_UNIDAD,
          detalleFacturaCompraTableClass::VALOR_TOTAL,
          detalleFacturaCompraTableClass::PROVEEDOR_ID,
          detalleFacturaCompraTableClass::FACTURA_COMPRA_ID,
          detalleFacturaCompraTableClass::CREATED_AT,
          detalleFacturaCompraTableClass::UPDATED_AT
        );
        $where = array(
            detalleFacturaCompraTableClass::ID => request::getInstance()->getRequest(detalleFacturaCompraTableClass::ID)
        );
        $this->objDetalleFactura = detalleFacturaCompraTableClass::getAll($fields, false, null, null, null, null, $where);
        
         $fields = array(
           facturaCompraTableClass::ID,
           facturaCompraTableClass::FECHA
        );
        $orderBy = array(
            facturaCompraTableClass::FECHA
        );
        $this->objFactura = facturaCompraTableClass::getAll($fields, false, $orderBy, 'ASC');
        
        $fields = array(
              proveedorTableClass::ID,
              proveedorTableClass::NOMBREP
      );
      $orderBy = array(
          proveedorTableClass::NOMBREP
      );
      $this->objProveedor = proveedorTableClass::getAll($fields, true, $orderBy, 'ASC');
        $this->defineView('edit', 'detalleFacturaCompra', session::getInstance()->getFormatOutput());
     
      }else{
        routing::getInstance()->redirect('detalleFacturaCompra', 'index');
      }

    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}

