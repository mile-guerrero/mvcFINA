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
class insertActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
         if (request::getInstance()->hasRequest(facturaCompraTableClass::ID)) {
        
      $fields = array(
          facturaCompraTableClass::ID,
          facturaCompraTableClass::FECHA
        );
      
        $orderBy = array(
          facturaCompraTableClass::ID
        );
        
         $where = array(
                    facturaCompraTableClass::ID => request::getInstance()->getRequest(facturaCompraTableClass::ID)
                );
         
        $this->objFactura = facturaCompraTableClass::getAll($fields, false, $orderBy, 'ASC', null, $where);
        
    $fields = array(
            productoInsumoTableClass::ID,
            productoInsumoTableClass::DESCRIPCION
      );
      $orderBy = array(
          productoInsumoTableClass::DESCRIPCION
      );
      $this->objProducto = productoInsumoTableClass::getAll($fields, true, $orderBy, 'ASC');
      
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
      
            $this->mensaje ="";
            $this->defineView('insert', 'detalleFacturaCompra', session::getInstance()->getFormatOutput());
            $idFactura = facturaCompraTableClass::ID;
            } else {
                routing::getInstance()->redirect('detalleFacturaCompra', 'insert', array(facturaCompraTableClass::ID => $idFactura));
            }
            
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo '<br>';
            echo $exc->getTraceAsString();
        }


        //$this->defineView('ejemplo', 'default', session::getInstance()->getFormatOutput());
    }

}
