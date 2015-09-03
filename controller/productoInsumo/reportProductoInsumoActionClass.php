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
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
 */
class reportProductoInsumoActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      $where = null;
//      if(request::getInstance()->hasPost('report')){
//      $report = request::getInstance()->getPost('report');
      //validar
//        if (request::getInstance()->hasPost(productoInsumoTableClass::getNameField(productoInsumoTableClass::DESCRIPCION, true)) and empty(mvc\request\requestClass::getInstance()->getPost(productoInsumoTableClass::getNameField(productoInsumoTableClass::DESCRIPCION, true))) === false) {
//
//          if (request::getInstance()->isMethod('POST')) {
//            $descripcion = request::getInstance()->getPost(productoInsumoTableClass::getNameField(productoInsumoTableClass::DESCRIPCION, true));
//
//
//
//            validator::validateFiltro();
//
//            if (isset($descripcion) and $descripcion !== null and $descripcion !== "") {
//              $where[] = '(' . productoInsumoTableClass::getNameField(productoInsumoTableClass::DESCRIPCION) . ' LIKE ' . '\'' . $descripcion . '%\'  '
//                      . 'OR ' . productoInsumoTableClass::getNameField(productoInsumoTableClass::DESCRIPCION) . ' LIKE ' . '\'%' . $descripcion . '%\' '
//                      . 'OR ' . productoInsumoTableClass::getNameField(productoInsumoTableClass::DESCRIPCION) . ' LIKE ' . '\'%' . $descripcion . '\') ';
//            }
//          }
//        }
//
//         if ((request::getInstance()->hasPost(productoInsumoTableClass::getNameField(productoInsumoTableClass::CREATED_AT, true) . '_1') and empty(mvc\request\requestClass::getInstance()->getPost(productoInsumoTableClass::getNameField(productoInsumoTableClass::CREATED_AT, true) . '_1')) === false) and ( (request::getInstance()->hasPost(productoInsumoTableClass::getNameField(productoInsumoTableClass::CREATED_AT, true) . '_2') and empty(mvc\request\requestClass::getInstance()->getPost(productoInsumoTableClass::getNameField(productoInsumoTableClass::CREATED_AT, true) . '_2')) === false))) {
//
//          if (request::getInstance()->isMethod('POST')) {
//           
//            $fechaInicial = request::getInstance()->getPost(productoInsumoTableClass::getNameField(productoInsumoTableClass::CREATED_AT, true) . '_1');
//            $fechaFin = request::getInstance()->getPost(productoInsumoTableClass::getNameField(productoInsumoTableClass::CREATED_AT, true) . '_2');
//     
//            validator::validateFiltroFecha($fechaInicial,$fechaFin);
//           
//            if ((isset($fechaInicial) and $fechaInicial !== null and $fechaInicial !== "") and ( isset($fechaFin) and $fechaFin !== null and $fechaFin !== "" )) {
//              $where[] = '(' . productoInsumoTableClass::getNameField(productoInsumoTableClass::CREATED_AT) . ' BETWEEN ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaInicial . ' 00:00:00')) . "'" . ' AND ' . "'" .  date(config::getFormatTimestamp(), strtotime($fechaFin . ' 23:59:59')) . "'" . ' ) ';             
//            }
//          }
//        }
//      }
      $this->mensaje = 'Informacion de Producto Insumo';
      $fields = array(
          productoInsumoTableClass::ID,
          productoInsumoTableClass::DESCRIPCION,
          productoInsumoTableClass::TIPO_PRODUCTO_INSUMO_ID,
          productoInsumoTableClass::CREATED_AT
      );
      $orderBy = array(
         productoInsumoTableClass::ID
      );
      
     
      $this->objPI = productoInsumoTableClass::getAll($fields, true, $orderBy, 'ASC', null, null,$where);
      
      
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
      $this->objTipo = tipoProductoInsumoTableClass::getAll($fields, true, $orderBy, 'ASC');

  
      $this->defineView('indexProductoInsumo', 'productoInsumo', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo '<pre>';
      print_r($exc->getTrace());
      echo '</pre>';
    }
  }

}
