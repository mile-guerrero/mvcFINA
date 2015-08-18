<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\trabajadorValidatorClass as validator;

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

         if ((isset($filter[trabajadorTableClass::getNameField(trabajadorTableClass::CREATED_AT, true) . '_1']) and empty($filter[trabajadorTableClass::getNameField(trabajadorTableClass::CREATED_AT, true) . '_1']) === false) and ( isset($filter[trabajadorTableClass::getNameField(trabajadorTableClass::CREATED_AT, true) . '_2']) and empty($filter[trabajadorTableClass::getNameField(trabajadorTableClass::CREATED_AT, true) . '_2']) === false)) {
          if (request::getInstance()->isMethod('POST')) {

            $fechaInicial = $filter[trabajadorTableClass::getNameField(trabajadorTableClass::CREATED_AT, true) . '_1'];
            $fechaFin = $filter[trabajadorTableClass::getNameField(trabajadorTableClass::CREATED_AT, true) . '_2'];

            validator::validateFiltroFecha($fechaInicial, $fechaFin);

            if ((isset($fechaInicial) and $fechaInicial !== null and $fechaInicial !== "") and ( isset($fechaFin) and $fechaFin !== null and $fechaFin !== "" )) {
              $where[] = '(' . trabajadorTableClass::getNameField(trabajadorTableClass::CREATED_AT) . ' BETWEEN ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaInicial . ' 00:00:00')) . "'" . ' AND ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaFin . ' 23:59:59')) . "'" . ' ) ';
            }
          }
        }
        
        if (isset($filter[trabajadorTableClass::getNameField(trabajadorTableClass::DOCUMENTO, true)]) and empty($filter[trabajadorTableClass::getNameField(trabajadorTableClass::DOCUMENTO, true)]) === false) {
          if (request::getInstance()->isMethod('POST')) {

            $documento = $filter[trabajadorTableClass::getNameField(trabajadorTableClass::DOCUMENTO, true)];
              validator::validateFiltro($documento);
            if (isset($documento) and $documento !== null and $documento !== '') {
             $where[] = '(' . trabajadorTableClass::getNameField(trabajadorTableClass::DOCUMENTO) . ' = ' .  $documento  . ' ) ';
            }
          }
        }
        
        if (isset($filter[trabajadorTableClass::getNameField(trabajadorTableClass::NOMBRET, true)]) and empty($filter[trabajadorTableClass::getNameField(trabajadorTableClass::NOMBRET, true)]) === false) {
          if (request::getInstance()->isMethod('POST')) {

            $nombre = $filter[trabajadorTableClass::getNameField(trabajadorTableClass::NOMBRET, true)];
             validator::validateFiltroNombre($nombre);
            if (isset($nombre) and $nombre !== null and $nombre !== '') {
          $where[] = '(' . trabajadorTableClass::getNameField(trabajadorTableClass::NOMBRET) . ' LIKE ' . '\'' . $nombre . '%\'  '
                  . 'OR ' . trabajadorTableClass::getNameField(trabajadorTableClass::NOMBRET) . ' LIKE ' . '\'%' . $nombre . '%\' '
                  . 'OR ' . trabajadorTableClass::getNameField(trabajadorTableClass::NOMBRET) . ' LIKE ' . '\'%' . $nombre . '\') ';
        }
          }
        }
        
        if (isset($filter[trabajadorTableClass::getNameField(trabajadorTableClass::APELLIDO, true)]) and empty($filter[trabajadorTableClass::getNameField(trabajadorTableClass::APELLIDO, true)]) === false) {
          if (request::getInstance()->isMethod('POST')) {

            $apellido = $filter[trabajadorTableClass::getNameField(trabajadorTableClass::APELLIDO, true)];
              validator::validateFiltroApellido($apellido);
            if (isset($apellido) and $apellido !== null and $apellido !== '') {
          $where[] = '(' . trabajadorTableClass::getNameField(trabajadorTableClass::APELLIDO) . ' LIKE ' . '\'' . $apellido . '%\'  '
                  . 'OR ' . trabajadorTableClass::getNameField(trabajadorTableClass::APELLIDO) . ' LIKE ' . '\'%' . $apellido . '%\' '
                  . 'OR ' . trabajadorTableClass::getNameField(trabajadorTableClass::APELLIDO) . ' LIKE ' . '\'%' . $apellido . '\') ';
        }
          }
        }
    
//      session::getInstance()->setAttribute('trabajadorIndexFilters', $where);
//       }else if(session::getInstance()->hasAttribute('trabajadorIndexFilters')){
//        $where = session::getInstance()->getAttribute('trabajadorIndexFilters');
//     
        
       }

      $fields = array(
          trabajadorTableClass::ID,
          trabajadorTableClass::DOCUMENTO,
          trabajadorTableClass::NOMBRET,
          trabajadorTableClass::APELLIDO,
          trabajadorTableClass::DIRECCION,
          trabajadorTableClass::TELEFONO,
          trabajadorTableClass::EMAIL,
          trabajadorTableClass::ID_TIPO_ID,
          trabajadorTableClass::ID_CIUDAD,
          trabajadorTableClass::ID_CREDENCIAL,
          trabajadorTableClass::CREATED_AT,
          trabajadorTableClass::UPDATED_AT
      );
      $orderBy = array(
          trabajadorTableClass::NOMBRET
      );
        $page = 0;
      if (request::getInstance()->hasGet('page')) {
        $this->page = request::getInstance()->getGet('page');
        $page = request::getInstance()->getGet('page') - 1;
        $page = $page * config::getRowGrid();
      }

      $this->cntPages = trabajadorTableClass::getTotalPages(config::getRowGrid(), $where);

      $this->objTrabajador = trabajadorTableClass::getAll($fields, true, $orderBy, 'ASC', config::getRowGrid(), $page, $where);
      $fields = array(
          ciudadTableClass::ID,
          ciudadTableClass::NOMBRE_CIUDAD
      );
      $orderBy = array(
          ciudadTableClass::NOMBRE_CIUDAD
      );
      $this->objCC = ciudadTableClass::getAll($fields, false, $orderBy, 'ASC');
      $this->defineView('index', 'trabajador', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
       routing::getInstance()->redirect('trabajador', 'index');
//      echo $exc->getMessage();
//      echo '<br>';
//      echo $exc->getTraceAsString();
    }
  }

}
