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
class indexActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      
       $where = null;
      if (request::getInstance()->hasPost('filter')) {
        $filter = request::getInstance()->getPost('filter');
        //Validar datos

        if (isset($filter['empresa']) and $filter['empresa'] !== null and $filter['empresa'] !== '') {
          $where[facturaVentaTableClass::FECHA] = $filter['empresa'];
        }
        if (isset($filter['fechaIni']) and $filter['fechaIni'] !== null and $filter['fechaIni'] !== '' and (isset($filter['fechaFin']) and $filter['fechaFin'] !== null and $filter['fechaFin'] !== '')) {
          $where[facturaVentaTableClass::CREATED_AT] = array(
          date(config::getFormatTimestamp(), strtotime($filter['fechaIni'] . ' 00:00:00')),
          date(config::getFormatTimestamp(), strtotime($filter['fechaFin'] . ' 23:59:59'))
          );
        }
//      session::getInstance()->setAttribute('facturaVentaIndexFilters', $where);
//       }else if(session::getInstance()->hasAttribute('facturaVentaIndexFilters')){
//        $where = session::getInstance()->getAttribute('facturaVentaIndexFilters');
//     
//        
       }
      $fields = array(
          facturaVentaTableClass::ID,
          facturaVentaTableClass::FECHA,
          facturaVentaTableClass::CLIENTE_ID,
          facturaVentaTableClass::TRABAJADOR_ID,
          facturaVentaTableClass::CREATED_AT,
          facturaVentaTableClass::UPDATED_AT
      );
      $orderBy = array(
          facturaVentaTableClass::ID
      );
      $page = 0;
      if (request::getInstance()->hasGet('page')) {
        $this->page = request::getInstance()->getGet('page');
        $page = request::getInstance()->getGet('page') - 1;
        $page = $page * config::getRowGrid();
      }//cierre del if del paguinado
      $this->cntPages = facturaVentaTableClass::getTotalPages(config::getRowGrid(), $where);
      $this->objFactura = facturaVentaTableClass::getAll($fields, false, $orderBy, 'ASC', config::getRowGrid(), $page, $where);
//       $fields = array(
//            empresaTableClass::ID,
//            empresaTableClass::NOMBRE
//        );
//        $orderBy = array(
//            empresaTableClass::NOMBRE
//        );
//        $this->objEmpresa = empresaTableClass::getAll($fields, false, $orderBy, 'ASC');
      
      
       $fields = array(
            trabajadorTableClass::ID,
            trabajadorTableClass::NOMBRET
      );
      $orderBy = array(
          trabajadorTableClass::NOMBRET
      );
      $this->objTrabajador = trabajadorTableClass::getAll($fields, true, $orderBy, 'ASC');
      
        
      $fields = array(
          clienteTableClass::ID,
          clienteTableClass::NOMBRE
      );
      $orderBy = array(
          clienteTableClass::NOMBRE
      );
      $this->objCliente = clienteTableClass::getAll($fields, true, $orderBy, 'ASC');
      $this->defineView('index', 'facturaVenta', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
       routing::getInstance()->redirect('facturaVenta', 'index');
//      echo $exc->getMessage();
//      echo '<br>';
//      echo $exc->getTraceAsString();
    }
}

}

