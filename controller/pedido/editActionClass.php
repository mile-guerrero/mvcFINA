
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
   
      if (request::getInstance()->hasGet(pedidoTableClass::ID)) {
        $fields = array(
            pedidoTableClass::ID,
            pedidoTableClass::EMPRESA_ID,
            pedidoTableClass::ID_PROVEEDOR,
            pedidoTableClass::CANTIDAD,
            pedidoTableClass::PRODUCTO_INSUMO_ID
        );
        $where = array(
            pedidoTableClass::ID => request::getInstance()->getGet(pedidoTableClass::ID)
        );
        $this->objPedido = pedidoTableClass::getAll($fields, true, null, null, null, null, $where);
        
        $fields = array(
            empresaTableClass::ID,
            empresaTableClass::NOMBRE
        );
        $orderBy = array(
            empresaTableClass::NOMBRE
        );
        $this->objEmpresa = empresaTableClass::getAll($fields, false, $orderBy, 'ASC');
        
        $fields = array(
            proveedorTableClass::ID,
            proveedorTableClass::NOMBREP
        );
        $orderBy = array(
            proveedorTableClass::NOMBREP
        );
        $this->objProveedor = proveedorTableClass::getAll($fields, true, $orderBy, 'ASC');
        
        $fields = array(
            productoInsumoTableClass::ID,
            productoInsumoTableClass::DESCRIPCION
        );
        $orderBy = array(
            productoInsumoTableClass::DESCRIPCION
        );
        $this->objProducto = productoInsumoTableClass::getAll($fields, true, $orderBy, 'ASC');
        
        $this->defineView('edit', 'pedido', session::getInstance()->getFormatOutput());
     
      }else{
        routing::getInstance()->redirect('pedido', 'index');
      }

    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}
