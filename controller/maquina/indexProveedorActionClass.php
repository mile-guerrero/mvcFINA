<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\proveedorValidatorClass as validator;

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
        if ((isset($filter[proveedorTableClass::getNameField(proveedorTableClass::CREATED_AT, true) . '_1']) and empty($filter[proveedorTableClass::getNameField(proveedorTableClass::CREATED_AT, true) . '_1']) === false) and ( isset($filter[proveedorTableClass::getNameField(proveedorTableClass::CREATED_AT, true) . '_2']) and empty($filter[proveedorTableClass::getNameField(proveedorTableClass::CREATED_AT, true) . '_2']) === false)) {
          if (request::getInstance()->isMethod('POST')) {

            $fechaInicial = $filter[proveedorTableClass::getNameField(proveedorTableClass::CREATED_AT, true) . '_1'];
            $fechaFin = $filter[proveedorTableClass::getNameField(proveedorTableClass::CREATED_AT, true) . '_2'];

            validator::validateFiltroFecha($fechaInicial, $fechaFin);

            if ((isset($fechaInicial) and $fechaInicial !== null and $fechaInicial !== "") and ( isset($fechaFin) and $fechaFin !== null and $fechaFin !== "" )) {
              $where[] = '(' . proveedorTableClass::getNameField(proveedorTableClass::CREATED_AT) . ' BETWEEN ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaInicial . ' 00:00:00')) . "'" . ' AND ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaFin . ' 23:59:59')) . "'" . ' ) ';
            }
          }
        }

        if (isset($filter[proveedorTableClass::getNameField(proveedorTableClass::ID_CIUDAD, true)]) and empty($filter[proveedorTableClass::getNameField(proveedorTableClass::ID_CIUDAD, true)]) === false) {
          if (request::getInstance()->isMethod('POST')) {

            $ciudad = $filter[proveedorTableClass::getNameField(proveedorTableClass::ID_CIUDAD, true)];

            if (isset($ciudad) and $ciudad !== null and $ciudad !== '') {
              $where[] = '(' . proveedorTableClass::getNameField(proveedorTableClass::ID_CIUDAD) . ' = ' .  $ciudad  . ' ) ';
              
            }//cierre del filtro ciudad
          }
        }

        if (isset($filter[proveedorTableClass::getNameField(proveedorTableClass::DOCUMENTO, true)]) and empty($filter[proveedorTableClass::getNameField(proveedorTableClass::DOCUMENTO, true)]) === false) {
          if (request::getInstance()->isMethod('POST')) {
            $documento = $filter[proveedorTableClass::getNameField(proveedorTableClass::DOCUMENTO, true)];
            validator::validateFiltro($documento);
            
            if (isset($documento) and $documento !== null and $documento !== '') {
               $where[] = '(' . proveedorTableClass::getNameField(proveedorTableClass::DOCUMENTO) . ' = ' .  $documento  . ' ) ';
              
            }
          }
        }

        if (isset($filter[proveedorTableClass::getNameField(proveedorTableClass::NOMBREP, true)]) and empty($filter[proveedorTableClass::getNameField(proveedorTableClass::NOMBREP, true)]) === false) {
          if (request::getInstance()->isMethod('POST')) {

            $nombre = $filter[proveedorTableClass::getNameField(proveedorTableClass::NOMBREP, true)];
            validator::validateFiltroNombre($nombre);
            if (isset($nombre) and $nombre !== null and $nombre !== '') {
              $where[] = '(' . proveedorTableClass::getNameField(proveedorTableClass::NOMBREP) . ' LIKE ' . '\'' . $nombre . '%\'  '
                      . 'OR ' . proveedorTableClass::getNameField(proveedorTableClass::NOMBREP) . ' LIKE ' . '\'%' . $nombre . '%\' '
                      . 'OR ' . proveedorTableClass::getNameField(proveedorTableClass::NOMBREP) . ' LIKE ' . '\'%' . $nombre . '\') ';
            }
          }
        }

        if (isset($filter[proveedorTableClass::getNameField(proveedorTableClass::APELLIDO, true)]) and empty($filter[proveedorTableClass::getNameField(proveedorTableClass::APELLIDO, true)]) === false) {
          if (request::getInstance()->isMethod('POST')) {

            $apellido = $filter[proveedorTableClass::getNameField(proveedorTableClass::APELLIDO, true)];
            validator::validateFiltroApellido($apellido);
            if (isset($apellido) and $apellido !== null and $apellido !== '') {
              $where[] = '(' . proveedorTableClass::getNameField(proveedorTableClass::APELLIDO) . ' LIKE ' . '\'' . $apellido . '%\'  '
                      . 'OR ' . proveedorTableClass::getNameField(proveedorTableClass::APELLIDO) . ' LIKE ' . '\'%' . $apellido . '%\' '
                      . 'OR ' . proveedorTableClass::getNameField(proveedorTableClass::APELLIDO) . ' LIKE ' . '\'%' . $apellido . '\') ';
            }
          }
        }


//      session::getInstance()->setAttribute('proveedorIndexFilters', $where);
//       }else if(session::getInstance()->hasAttribute('proveedorIndexFilters')){
//        $where = session::getInstance()->getAttribute('proveedorIndexFilters');
//     
//        
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
        $page = $page * config::getRowGrid();
      }

      $this->cntPages = proveedorTableClass::getTotalPages(config::getRowGrid(), $where);

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
      routing::getInstance()->redirect('maquina', 'indexProveedor');
//      echo $exc->getMessage();
//      echo '<br>';
//      echo $exc->getTraceAsString();
    }


    //$this->defineView('ejemplo', 'default', session::getInstance()->getFormatOutput());
  }

}
