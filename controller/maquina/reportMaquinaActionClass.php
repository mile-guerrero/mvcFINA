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
class reportMaquinaActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
    $where = null;
      if(request::getInstance()->hasPost('report')){
      $report = request::getInstance()->getPost('report');
      //validar
     if(isset($report['nombre']) and $report['nombre'] !== null and $report['nombre'] !== ""){
        $where[] ='(' .  maquinaTableClass::getNameField(maquinaTableClass::NOMBRE) . ' LIKE ' . '\'' . $report['nombre'] . '%\'  '
              . 'OR ' . maquinaTableClass::getNameField(maquinaTableClass::NOMBRE) . ' LIKE ' . '\'%' . $report['nombre'] . '%\' '
              . 'OR ' . maquinaTableClass::getNameField(maquinaTableClass::NOMBRE) . ' LIKE ' . '\'%' . $report['nombre'].'\') ';       
              }
              
              if((isset($report['fechaIni']) and $report['fechaIni'] !== null and $report['fechaIni'] !== "") and (isset($report['fechaFin']) and $report['fechaFin'] !== null and $report['fechaFin'] !== "" )){
        $where[maquinaTableClass::CREATED_AT] = array(
           date(config::getFormatTimestamp(), strtotime($report['fechaIni'].' 00:00:00')),
           date(config::getFormatTimestamp(), strtotime($report['fechaFin'].' 23:59:59'))
            );
      }
      
      if(isset($report['descripcion']) and $report['descripcion'] !== null and $report['descripcion'] !== ""){
        $where[] = '(' . maquinaTableClass::getNameField(maquinaTableClass::DESCRIPCION) . ' LIKE ' . '\'' . $report['descripcion'] . '%\'  '
              . 'OR ' . maquinaTableClass::getNameField(maquinaTableClass::DESCRIPCION) . ' LIKE ' . '\'%' . $report['descripcion'] . '%\' '
              . 'OR ' . maquinaTableClass::getNameField(maquinaTableClass::DESCRIPCION) . ' LIKE ' . '\'%' . $report['descripcion'].'\') ';       
              }
              
      if(isset($report['origen']) and $report['origen'] !== null and $report['origen'] !== ""){
        $where[] ='(' .  maquinaTableClass::getNameField(maquinaTableClass::ORIGEN_MAQUINA) . ' LIKE ' . '\'' . $report['origen'] . '%\'  '
              . 'OR ' . maquinaTableClass::getNameField(maquinaTableClass::ORIGEN_MAQUINA) . ' LIKE ' . '\'%' . $report['origen'] . '%\' '
              . 'OR ' . maquinaTableClass::getNameField(maquinaTableClass::ORIGEN_MAQUINA) . ' LIKE ' . '\'%' . $report['origen'].'\') ';       
              }
//      
      if(isset($report['tipo']) and $report['tipo'] !== null and $report['tipo'] !== ""){
        $where[maquinaTableClass::TIPO_USO_ID] = $report['tipo'];
      }
      
      if(isset($report['proveedor']) and $report['proveedor'] !== null and $report['proveedor'] !== ""){
        $where[maquinaTableClass::PROVEEDOR_ID] = $report['proveedor'];
      }
           
      }
       $this->mensaje = 'Informacion de Maquina';
      $fields = array(
          maquinaTableClass::ID,
          maquinaTableClass::NOMBRE,
          maquinaTableClass::DESCRIPCION,
          maquinaTableClass::ORIGEN_MAQUINA,
          maquinaTableClass::TIPO_USO_ID,
          maquinaTableClass::PROVEEDOR_ID,
          maquinaTableClass::CREATED_AT,
          maquinaTableClass::UPDATED_AT
      );
      $orderBy = array(
         maquinaTableClass::ID
      );
      
      
      $this->objMaquina = maquinaTableClass::getAll($fields, true, $orderBy, 'ASC',null,null,$where);
     
      $fields = array(     
      tipoUsoMaquinaTableClass::ID, 
      tipoUsoMaquinaTableClass::DESCRIPCION
      );
      $orderBy = array(
      tipoUsoMaquinaTableClass::ID   
      ); 
      $this->objMTUM = tipoUsoMaquinaTableClass::getAll($fields, false, $orderBy, 'ASC');
      
      $fields = array(     
      proveedorTableClass::ID, 
      proveedorTableClass::NOMBREP
      );
      $orderBy = array(
      proveedorTableClass::ID   
      ); 
      $this->objMP = proveedorTableClass::getAll($fields, true, $orderBy, 'ASC');
      
      $this->defineView('indexMaquina', 'maquina', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo '<pre>';
      print_r($exc->getTrace());
      echo '</pre>';
    }
  }

}
