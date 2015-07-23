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
class indexProveedorActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      
       $where = null;
      if (request::getInstance()->hasPost('filter')) {
        $filter = request::getInstance()->getPost('filter');
        //Validar datos

        if (isset($filter['nombre']) and $filter['nombre'] !== null and $filter['nombre'] !== '') {
         $where[] = '(' . proveedorTableClass::getNameField(proveedorTableClass::NOMBREP) . ' LIKE ' . '\'' . $filter['nombre'] . '%\'  '
              . 'OR ' . proveedorTableClass::getNameField(proveedorTableClass::NOMBREP) . ' LIKE ' . '\'%' . $filter['nombre'] . '%\' '
              . 'OR ' . proveedorTableClass::getNameField(proveedorTableClass::NOMBREP) . ' LIKE ' . '\'%' . $filter['nombre'].'\') ';       
              }
        
        if (isset($filter['apellido']) and $filter['apellido'] !== null and $filter['apellido'] !== '') {
         $where[] ='(' .  proveedorTableClass::getNameField(proveedorTableClass::APELLIDO) . ' LIKE ' . '\'' . $filter['apellido'] . '%\'  '
              . 'OR ' . proveedorTableClass::getNameField(proveedorTableClass::APELLIDO) . ' LIKE ' . '\'%' . $filter['apellido'] . '%\' '
              . 'OR ' . proveedorTableClass::getNameField(proveedorTableClass::APELLIDO) . ' LIKE ' . '\'%' . $filter['apellido'].'\') ';       
              }
        
        if (isset($filter['documento']) and $filter['documento'] !== null and $filter['documento'] !== '') {
          $where[proveedorTableClass::DOCUMENTO] = $filter['documento'];
        }
        
        if (isset($filter['ciudad']) and $filter['ciudad'] !== null and $filter['ciudad'] !== '') {
          $where[proveedorTableClass::ID_CIUDAD] = $filter['ciudad'];
        }
        if (isset($filter['fecha1']) and $filter['fecha1'] !== null and $filter['fecha1'] !== '' and (isset($filter['fecha2']) and $filter['fecha2'] !== null and $filter['fecha2'] !== '')) {
          $where[proveedorTableClass::CREATED_AT] = array(
          date(config::getFormatTimestamp(), strtotime($filter['fecha1'] . ' 00:00:00')),
          date(config::getFormatTimestamp(), strtotime($filter['fecha2'] . ' 23:59:59'))
          );
        }
      }
      
      $fields = array(
          proveedorTableClass::ID,
          proveedorTableClass::NOMBREP,
          proveedorTableClass::APELLIDO,
          proveedorTableClass::DIRECCION,
          proveedorTableClass::DOCUMENTO,
          proveedorTableClass::TELEFONO,
          proveedorTableClass::EMAIL,
          proveedorTableClass::ID_CIUDAD
          
      );
      $orderBy = array(
          proveedorTableClass::NOMBREP
      );
      
      $page = 0;
      if (request::getInstance()->hasGet('page')) {
        $this->page = request::getInstance()->getGet('page');
        $page = request::getInstance()->getGet('page') - 1;
        $page = $page * 3;
      }

      $this->cntPages = proveedorTableClass::getTotalPages(config::getRowGrid());
      
      
      $this->objProveedor = proveedorTableClass::getAll($fields, true, $orderBy, 'ASC', config::getRowGrid(), $page, $where);
      
      $fields = array(     
      ciudadTableClass::ID, 
      ciudadTableClass::NOMBRE_CIUDAD
      );
      $orderBy = array(
      ciudadTableClass::NOMBRE_CIUDAD    
      ); 
      $this->objCC = ciudadTableClass::getAll($fields, false, $orderBy, 'ASC');
      $this->defineView('indexProveedor', 'maquina', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }


    //$this->defineView('ejemplo', 'default', session::getInstance()->getFormatOutput());
  }

}
