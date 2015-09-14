
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
class editActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
   
      if (request::getInstance()->hasGet(ordenServicioTableClass::ID)) {
        $fields = array(
            ordenServicioTableClass::ID,
            ordenServicioTableClass::FECHA_MANTENIMIENTO,
            ordenServicioTableClass::TRABAJADOR_ID,
            ordenServicioTableClass::CANTIDAD,
            ordenServicioTableClass::VALOR,            
            ordenServicioTableClass::PRODUCTO_INSUMO_ID,
            ordenServicioTableClass::MAQUINA_ID
        );
        $where = array(
            ordenServicioTableClass::ID => request::getInstance()->getGet(ordenServicioTableClass::ID)
        );
        $this->objOS = ordenServicioTableClass::getAll($fields, false, null, null, null, null, $where);
       
       $id = array(
            ordenServicioTableClass::ID => request::getInstance()->getRequest(ordenServicioTableClass::ID)
        );

        $idProducto = $this->objOS[0]->producto_insumo_id;
        $this->idTipoProducto = ordenServicioTableClass::getTipoInsumo($idProducto);

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
      $this->objOST = trabajadorTableClass::getAll($fields, true, $orderBy, 'ASC');
    
       $fields = array(
      maquinaTableClass::ID,
      maquinaTableClass::NOMBRE
      );
      $orderBy = array(
      maquinaTableClass::NOMBRE   
      );      
      $this->objOSM = maquinaTableClass::getAll($fields, true, $orderBy, 'ASC');
        $this->defineView('edit', 'ordenServicio', session::getInstance()->getFormatOutput());
     
      }else{
        routing::getInstance()->redirect('ordenServicio', 'index');
      }

    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}
