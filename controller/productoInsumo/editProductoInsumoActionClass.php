
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
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class editProductoInsumoActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
   
      if (request::getInstance()->hasGet(productoInsumoTableClass::ID)) {
        $fields = array(
            productoInsumoTableClass::ID,
            productoInsumoTableClass::DESCRIPCION,
            productoInsumoTableClass::IVA,
            productoInsumoTableClass::UNIDAD_MEDIDA_ID,
            productoInsumoTableClass::TIPO_PRODUCTO_INSUMO_ID
        );
        $where = array(
            productoInsumoTableClass::ID => request::getInstance()->getGet(productoInsumoTableClass::ID)
        );
        $this->objPI = productoInsumoTableClass::getAll($fields, true, null, null, null, null, $where);
       $fields = array(
      unidadMedidaTableClass::ID,
      unidadMedidaTableClass::DESCRIPCION
      );
      $orderBy = array(
      unidadMedidaTableClass::DESCRIPCION   
      );      
      $this->objPIUM = unidadMedidaTableClass::getAll($fields, false, $orderBy, 'ASC');
      
      $fields = array(     
      tipoProductoInsumoTableClass::ID, 
      tipoProductoInsumoTableClass::DESCRIPCION
      );
      $orderBy = array(
      tipoProductoInsumoTableClass::DESCRIPCION    
      ); 
      $this->objPITPI = tipoProductoInsumoTableClass::getAll($fields, true, $orderBy, 'ASC');

        $this->defineView('editProductoInsumo', 'productoInsumo', session::getInstance()->getFormatOutput());
     
      }else{
        routing::getInstance()->redirect('productoInsumo', 'indexProductoInsumo');
      }

    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}
