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
class indexMaquinaActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      $where = null;
      if(request::getInstance()->hasPost('filter')){
      $filter = request::getInstance()->getPost('filter');
      //validar
      if(isset($filter['nombre']) and $filter['nombre'] !== null and $filter['nombre'] !== ""){
        $where[] ='(' .  maquinaTableClass::getNameField(maquinaTableClass::NOMBRE) . ' LIKE ' . '\'' . $filter['nombre'] . '%\'  '
              . 'OR ' . maquinaTableClass::getNameField(maquinaTableClass::NOMBRE) . ' LIKE ' . '\'%' . $filter['nombre'] . '%\' '
              . 'OR ' . maquinaTableClass::getNameField(maquinaTableClass::NOMBRE) . ' LIKE ' . '\'%' . $filter['nombre'].'\') ';       
              }
              
              if((isset($filter['fechaIni']) and $filter['fechaIni'] !== null and $filter['fechaIni'] !== "") and (isset($filter['fechaFin']) and $filter['fechaFin'] !== null and $filter['fechaFin'] !== "" )){
        $where[maquinaTableClass::CREATED_AT] = array(
           date(config::getFormatTimestamp(), strtotime($filter['fechaIni'].' 00:00:00')),
           date(config::getFormatTimestamp(), strtotime($filter['fechaFin'].' 23:59:59'))
            );
      }
      
      if(isset($filter['descripcion']) and $filter['descripcion'] !== null and $filter['descripcion'] !== ""){
        $where[] = '(' . maquinaTableClass::getNameField(maquinaTableClass::DESCRIPCION) . ' LIKE ' . '\'' . $filter['descripcion'] . '%\'  '
              . 'OR ' . maquinaTableClass::getNameField(maquinaTableClass::DESCRIPCION) . ' LIKE ' . '\'%' . $filter['descripcion'] . '%\' '
              . 'OR ' . maquinaTableClass::getNameField(maquinaTableClass::DESCRIPCION) . ' LIKE ' . '\'%' . $filter['descripcion'].'\') ';       
              }
              
      if(isset($filter['origen']) and $filter['origen'] !== null and $filter['origen'] !== ""){
        $where[] ='(' .  maquinaTableClass::getNameField(maquinaTableClass::ORIGEN_MAQUINA) . ' LIKE ' . '\'' . $filter['origen'] . '%\'  '
              . 'OR ' . maquinaTableClass::getNameField(maquinaTableClass::ORIGEN_MAQUINA) . ' LIKE ' . '\'%' . $filter['origen'] . '%\' '
              . 'OR ' . maquinaTableClass::getNameField(maquinaTableClass::ORIGEN_MAQUINA) . ' LIKE ' . '\'%' . $filter['origen'].'\') ';       
              }
//      
      if(isset($filter['tipo']) and $filter['tipo'] !== null and $filter['tipo'] !== ""){
        $where[maquinaTableClass::TIPO_USO_ID] = $filter['tipo'];
      }
      
      if(isset($filter['proveedor']) and $filter['proveedor'] !== null and $filter['proveedor'] !== ""){
        $where[maquinaTableClass::PROVEEDOR_ID] = $filter['proveedor'];
      }
           
      }
      $fields = array(
          maquinaTableClass::ID,
          maquinaTableClass::NOMBRE,
          maquinaTableClass::DESCRIPCION,
          maquinaTableClass::TIPO_USO_ID,
          maquinaTableClass::ORIGEN_MAQUINA,
          maquinaTableClass::PROVEEDOR_ID,
          maquinaTableClass::CREATED_AT,
          maquinaTableClass::UPDATED_AT
      );
      $orderBy = array(
         maquinaTableClass::ID
      );
      $page = 0;
      if (request::getInstance()->hasGet('page')) {
        $this->page = request::getInstance()->getGet('page');
        $page = request::getInstance()->getGet('page') - 1;
        $page = $page * config::getRowGrid();
      }
      $this->cntPages = maquinaTableClass::getTotalPages(config::getRowGrid());
      
      $this->objMaquina = maquinaTableClass::getAll($fields, true, $orderBy, 'ASC',config::getRowGrid(), $page,$where);
     
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
      echo $exc->getTraceAsString();
    }
}

}
