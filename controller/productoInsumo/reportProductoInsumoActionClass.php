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
      if(request::getInstance()->hasPost('report')){
      $report = request::getInstance()->getPost('report');
      //validar
       if(isset($report['descripcion']) and $report['descripcion'] !== null and $report['descripcion'] !== ""){
        $where[] = '(' . productoInsumoTableClass::getNameField(productoInsumoTableClass::DESCRIPCION) . ' LIKE ' . '\'' . $report['descripcion'] . '%\'  '
              . 'OR ' . productoInsumoTableClass::getNameField(productoInsumoTableClass::DESCRIPCION) . ' LIKE ' . '\'%' . $report['descripcion'] . '%\' '
              . 'OR ' . productoInsumoTableClass::getNameField(productoInsumoTableClass::DESCRIPCION) . ' LIKE ' . '\'%' . $report['descripcion'].'\') ';       
              }              
     
      if((isset($report['fechaIni']) and $report['fechaIni'] !== null and $report['fechaIni'] !== "") and (isset($report['fechaFin']) and $report['fechaFin'] !== null and $report['fechaFin'] !== "" )){
        $where[productoInsumoTableClass::CREATED_AT] = array(
           date(config::getFormatTimestamp(), strtotime($report['fechaIni'].' 00:00:00')),
           date(config::getFormatTimestamp(), strtotime($report['fechaFin'].' 23:59:59'))
            );
      }
      
      if(isset($report['unidadMedida']) and $report['unidadMedida'] !== null and $report['unidadMedida'] !== ""){
        $where[productoInsumoTableClass::UNIDAD_MEDIDA_ID] = $report['unidadMedida'];
      }
      
      if(isset($report['tipoInsumo']) and $report['tipoInsumo'] !== null and $report['tipoInsumo'] !== ""){
        $where[productoInsumoTableClass::TIPO_PRODUCTO_INSUMO_ID] = $report['tipoInsumo'];
      }
      }
      $this->mensaje = 'Informacion de Producto Insumo';
      $fields = array(
          productoInsumoTableClass::ID,
          productoInsumoTableClass::DESCRIPCION,
          productoInsumoTableClass::IVA,
          productoInsumoTableClass::UNIDAD_MEDIDA_ID,
          productoInsumoTableClass::TIPO_PRODUCTO_INSUMO_ID,
          productoInsumoTableClass::CREATED_AT,
          productoInsumoTableClass::UPDATED_AT
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
