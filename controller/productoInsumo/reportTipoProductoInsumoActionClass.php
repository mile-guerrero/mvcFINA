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
class reportTipoProductoInsumoActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
     $where = null;
      if(request::getInstance()->hasPost('report')){
      $report = request::getInstance()->getPost('report');
      //validar
      
      if(isset($report['descripcion']) and $report['descripcion'] !== null and $report['descripcion'] !== ""){
        $where[tipoProductoInsumoTableClass::DESCRIPCION] = $report['descripcion'];
      }
      if((isset($report['fechaIni']) and $report['fechaIni'] !== null and $report['fechaIni'] !== "") and (isset($report['fechaFin']) and $report['fechaFin'] !== null and $report['fechaFin'] !== "" )){
        $where[tipoProductoInsumoTableClass::CREATED_AT] = array(
           date(config::getFormatTimestamp(), strtotime($report['fechaIni'].' 00:00:00')),
           date(config::getFormatTimestamp(), strtotime($report['fechaFin'].' 23:59:59'))
            );
      }     
      }
      $this->mensaje = 'Informacion de Tipo Producto Insumo';
      $fields = array(
          tipoProductoInsumoTableClass::ID,
          tipoProductoInsumoTableClass::DESCRIPCION,
          tipoProductoInsumoTableClass::CREATED_AT,
          tipoProductoInsumoTableClass::UPDATED_AT
        );
      $orderBy = array(
         tipoProductoInsumoTableClass::ID
      );
      $this->objTPI = tipoProductoInsumoTableClass::getAll($fields, true, $orderBy, 'ASC',null,null,$where);
     
      $this->defineView('indexTipoProductoInsumo', 'productoInsumo', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo '<pre>';
      print_r($exc->getTrace());
      echo '</pre>';
    }
  }

}
