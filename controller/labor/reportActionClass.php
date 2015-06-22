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
class reportActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      $where = null;
      if (request::getInstance()->hasPost('report')) {
        $report = request::getInstance()->getPost('report');
        //Validar datos

          if (isset($report['descripcion']) and $report['descripcion'] !== null and $report['descripcion'] !== '') {
          $where[] ='(' .  laborTableClass::getNameField(laborTableClass::DESCRIPCION) . ' LIKE ' . '\'' . $report['descripcion'] . '%\'  '
              . 'OR ' . laborTableClass::getNameField(laborTableClass::DESCRIPCION) . ' LIKE ' . '\'%' . $report['descripcion'] . '%\' '
              . 'OR ' . laborTableClass::getNameField(laborTableClass::DESCRIPCION) . ' LIKE ' . '\'%' . $report['descripcion'].'\') ';       
              }//cierre del filtro nombre
       
        if (isset($report['valor1']) and $report['valor1'] !== null and $report['valor1'] !== '' and (isset($report['valor2']) and $report['valor2'] !== null and $report['valor2'] !== '')) {
          $where[laborTableClass::VALOR] = array(
         $report['valor1'],
         $report['valor2']
          );
        } 
        
        if (isset($report['fechaIni']) and $report['fechaIni'] !== null and $report['fechaIni'] !== '' and (isset($report['fechaFin']) and $report['fechaFin'] !== null and $report['fechaFin'] !== '')) {
          $where[laborTableClass::CREATED_AT] = array(
          date(config::getFormatTimestamp(), strtotime($report['fechaIni'] . ' 00:00:00')),
          date(config::getFormatTimestamp(), strtotime($report['fechaFin'] . ' 23:59:59'))
          );
        }
      }
      $this->mensaje = 'Informacion de Labor';
      $fields = array(
          laborTableClass::ID,
          laborTableClass::DESCRIPCION,
          laborTableClass::VALOR,
          laborTableClass::CREATED_AT,
          laborTableClass::UPDATED_AT
      );
      $orderBy = array(
         laborTableClass::ID
      );
      $this->objLabor = laborTableClass::getAll($fields, false, $orderBy, 'ASC',null,null,$where);
 
 
 
      $this->defineView('index', 'labor', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo '<pre>';
      print_r($exc->getTrace());
      echo '</pre>';
    }
  }

}
