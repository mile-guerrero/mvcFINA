<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\tipoProductoInsumoValidatorClass as validator;

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
      if ((request::getInstance()->hasPost(tipoProductoInsumoTableClass::getNameField(tipoProductoInsumoTableClass::CREATED_AT, true) . '_1') and empty(mvc\request\requestClass::getInstance()->getPost(tipoProductoInsumoTableClass::getNameField(tipoProductoInsumoTableClass::CREATED_AT, true) . '_1')) === false) and ( (request::getInstance()->hasPost(tipoProductoInsumoTableClass::getNameField(tipoProductoInsumoTableClass::CREATED_AT, true) . '_2') and empty(mvc\request\requestClass::getInstance()->getPost(tipoProductoInsumoTableClass::getNameField(tipoProductoInsumoTableClass::CREATED_AT, true) . '_2')) === false))) {

          if (request::getInstance()->isMethod('POST')) {
           
            $fechaInicial = request::getInstance()->getPost(tipoProductoInsumoTableClass::getNameField(tipoProductoInsumoTableClass::CREATED_AT, true) . '_1');
            $fechaFin = request::getInstance()->getPost(tipoProductoInsumoTableClass::getNameField(tipoProductoInsumoTableClass::CREATED_AT, true) . '_2');
     
            validator::validateFiltroFecha($fechaInicial,$fechaFin);
            
           
//               echo "<script> alert(' La fecha final no puede ser menor a la actual');</script>";
//             exit();
            
            
          
           
            if ((isset($fechaInicial) and $fechaInicial !== null and $fechaInicial !== "") and ( isset($fechaFin) and $fechaFin !== null and $fechaFin !== "" )) {
              $where[] = '(' . tipoProductoInsumoTableClass::getNameField(tipoProductoInsumoTableClass::CREATED_AT) . ' BETWEEN ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaInicial . ' 00:00:00')) . "'" . ' AND ' . "'" .  date(config::getFormatTimestamp(), strtotime($fechaFin . ' 23:59:59')) . "'" . ' ) ';             
            }
          }
        }
      
      if(isset($report['descripcion']) and $report['descripcion'] !== null and $report['descripcion'] !== ""){
        $where[] = '(' . tipoProductoInsumoTableClass::getNameField(tipoProductoInsumoTableClass::DESCRIPCION) . ' LIKE ' . '\'' . $report['descripcion'] . '%\'  '
              . 'OR ' . tipoProductoInsumoTableClass::getNameField(tipoProductoInsumoTableClass::DESCRIPCION) . ' LIKE ' . '\'%' . $report['descripcion'] . '%\' '
              . 'OR ' . tipoProductoInsumoTableClass::getNameField(tipoProductoInsumoTableClass::DESCRIPCION) . ' LIKE ' . '\'%' . $report['descripcion'].'\') ';       
              }
              
//      if((isset($report['fechaIni']) and $report['fechaIni'] !== null and $report['fechaIni'] !== "") and (isset($report['fechaFin']) and $report['fechaFin'] !== null and $report['fechaFin'] !== "" )){
//        $where[tipoProductoInsumoTableClass::CREATED_AT] = array(
//           date(config::getFormatTimestamp(), strtotime($report['fechaIni'].' 00:00:00')),
//           date(config::getFormatTimestamp(), strtotime($report['fechaFin'].' 23:59:59'))
//            );
//      }     
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
