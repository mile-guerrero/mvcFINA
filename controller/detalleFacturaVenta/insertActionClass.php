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
         if (request::getInstance()->hasRequest(facturaVentaTableClass::ID)) {
          $fields = array(
            clienteTableClass::ID,
            clienteTableClass::NOMBRE
      );
      $orderBy = array(
          clienteTableClass::NOMBRE
      );
      $this->objCliente = clienteTableClass::getAll($fields, true, $orderBy, 'ASC');
      
      $fields = array(
            trabajadorTableClass::ID,
            trabajadorTableClass::NOMBRET
      );
      $orderBy = array(
          trabajadorTableClass::NOMBRET
      );
      $this->objTrabajador = trabajadorTableClass::getAll($fields, true, $orderBy, 'ASC');
      
      $fields = array(
          facturaVentaTableClass::ID,
          facturaVentaTableClass::FECHA
        );
      
        $orderBy = array(
          facturaVentaTableClass::ID
        );
        
         $where = array(
                    facturaVentaTableClass::ID => request::getInstance()->getRequest(facturaVentaTableClass::ID)
                );
         
        $this->objFactura = facturaVentaTableClass::getAll($fields, false, $orderBy, 'ASC', null, $where);
        
    
            $this->mensaje ="";
            $this->defineView('insert', 'detalleFacturaVenta', session::getInstance()->getFormatOutput());
            $idFactura = facturaVentaTableClass::ID;
            } else {
                routing::getInstance()->redirect('detalleFacturaVenta', 'insert', array(facturaVentaTableClass::ID => $idFactura));
            }
            
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo '<br>';
            echo $exc->getTraceAsString();
        }


        //$this->defineView('ejemplo', 'default', session::getInstance()->getFormatOutput());
    }

}
