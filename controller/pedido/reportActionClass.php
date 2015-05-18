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
class reportActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      
         $where = null;
      if (request::getInstance()->hasPost('report')) {
        $report = request::getInstance()->getPost('report');
        //Validar datos
        if(isset($report['empresa']) and $report['empresa'] !== null and $report['empresa'] !== ""){
        $where[pedidoTableClass::EMPRESA_ID] = $report['empresa'];
        }
        if (isset($report['fecha1']) and $report['fecha1'] !== null and $report['fecha1'] !== '' and (isset($report['fecha2']) and $report['fecha2'] !== null and $report['fecha2'] !== '')) {
          $where[pedidoTableClass::CREATED_AT] = array(
          date(config::getFormatTimestamp(), strtotime($report['fecha1'] . ' 00:00:00')),
          date(config::getFormatTimestamp(), strtotime($report['fecha2'] . ' 23:59:59'))
          );
        }
      }
      
      $this->mensaje = 'Informacion de los pedidos';
      $fields = array(
          pedidoTableClass::ID,
          pedidoTableClass::EMPRESA_ID,
          pedidoTableClass::ID_PROVEEDOR,
          pedidoTableClass::CANTIDAD,
          pedidoTableClass::PRODUCTO_INSUMO_ID,
          pedidoTableClass::CREATED_AT,
          pedidoTableClass::UPDATED_AT,
      );
      $orderBy = array(
          pedidoTableClass::ID
      );
      $this->objPedido = pedidoTableClass::getAll($fields, true, $orderBy, 'ASC', null, null, $where);
 
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
 
      $this->defineView('index', 'pedido', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo '<pre>';
      print_r($exc->getTrace());
      echo '</pre>';
    }
  }

}
