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
class reportProveedorActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      
         $where = null;
      if (request::getInstance()->hasPost('report')) {
        $report = request::getInstance()->getPost('report');
        //Validar datos

        if (isset($report['nombre']) and $report['nombre'] !== null and $report['nombre'] !== '') {
          $where[proveedorTableClass::NOMBREP] = $report['nombre'];
        }
        if (isset($report['ciudad']) and $report['ciudad'] !== null and $report['ciudad'] !== '') {
          $where[proveedorTableClass::ID_CIUDAD] = $report['ciudad'];
        }
        if (isset($report['fecha1']) and $report['fecha1'] !== null and $report['fecha1'] !== '' and (isset($report['fecha2']) and $report['fecha2'] !== null and $report['fecha2'] !== '')) {
          $where[proveedorTableClass::CREATED_AT] = array(
          date(config::getFormatTimestamp(), strtotime($report['fecha1'] . ' 00:00:00')),
          date(config::getFormatTimestamp(), strtotime($report['fecha2'] . ' 23:59:59'))
          );
        }
      }
      
      $this->mensaje = 'Informacion de Proveedores';
      $fields = array(
          proveedorTableClass::ID,
          proveedorTableClass::NOMBREP,
          proveedorTableClass::APELLIDO,
          proveedorTableClass::DOCUMENTO,
          proveedorTableClass::DIRECCION,
          proveedorTableClass::TELEFONO,
          proveedorTableClass::EMAIL,
          proveedorTableClass::ID_CIUDAD,
          proveedorTableClass::CREATED_AT,
          proveedorTableClass::UPDATED_AT
      );
      $orderBy = array(
         proveedorTableClass::NOMBREP
      );
      $this->objP = proveedorTableClass::getAll($fields, true, $orderBy, 'ASC', null, null, $where);
 
       $fields = array(
          ciudadTableClass::ID,
          ciudadTableClass::NOMBRE_CIUDAD,
          ciudadTableClass::HABITANTES
      );
      $orderBy = array(
         ciudadTableClass::NOMBRE_CIUDAD
      );
      $this->objCC = ciudadTableClass::getAll($fields, false, $orderBy, 'ASC');
 
 
      $this->defineView('indexProveedor', 'maquina', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo '<pre>';
      print_r($exc->getTrace());
      echo '</pre>';
    }
  }

}
