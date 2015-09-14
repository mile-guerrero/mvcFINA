<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
//use mvc\validator\clienteValidatorClass as validator;

/**
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon 
 * @date: fecha de inicio del desarrollo.
 * @category: modulo de cliente.
 */
class indexActionClass extends controllerClass implements controllerActionInterface {

  /**
   * @author: Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon .
   * @date: fecha de inicio del desarrollo.
   * @return   controlPlagaTableClass::ID retorna (integer),
    controlPlagaTableClass::NOMBRE retorna  (string),
    controlPlagaTableClass::APELLIDO retorna  (string),
    controlPlagaTableClass::DOCUMENTO retorna  (integer),
    controlPlagaTableClass::DIRECCION retorna  (string),
    controlPlagaTableClass::TELEFONO retorna  (integer),
    controlPlagaTableClass::ID_TIPO_ID retorna (integer),
    controlPlagaTableClass::ID_CIUDAD retorna  (integer),
    controlPlagaTableClass::UPDATE_AT retorna  (timestamp),
    ciudadTableClass::ID retorna  (integer),
    ciudadTableClass::NOMBRE_CIUDAD retorna  (string),
   * estos datos retornan en la variable $fields
   */
  public function execute() {
    try {




      $where = null;


//      if (request::getInstance()->hasPost('filter')) {
//        $filter = request::getInstance()->getPost('filter');
//        //Validar datos
//        
//        if ((isset($filter[controlPlagaTableClass::getNameField(controlPlagaTableClass::CREATED_AT, true) . '_1']) and empty($filter[controlPlagaTableClass::getNameField(controlPlagaTableClass::CREATED_AT, true) . '_1']) === false) and ( isset($filter[controlPlagaTableClass::getNameField(controlPlagaTableClass::CREATED_AT, true) . '_2']) and empty($filter[controlPlagaTableClass::getNameField(controlPlagaTableClass::CREATED_AT, true) . '_2']) === false)) {
//          if (request::getInstance()->isMethod('POST')) {
//
//            $fechaInicial = $filter[controlPlagaTableClass::getNameField(controlPlagaTableClass::CREATED_AT, true) . '_1'];
//            $fechaFin = $filter[controlPlagaTableClass::getNameField(controlPlagaTableClass::CREATED_AT, true) . '_2'];
//
//            validator::validateFiltroFecha($fechaInicial, $fechaFin);
//
//            if ((isset($fechaInicial) and $fechaInicial !== null and $fechaInicial !== "") and ( isset($fechaFin) and $fechaFin !== null and $fechaFin !== "" )) {
//              $where[] = '(' . controlPlagaTableClass::getNameField(controlPlagaTableClass::CREATED_AT) . ' BETWEEN ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaInicial . ' 00:00:00')) . "'" . ' AND ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaFin . ' 23:59:59')) . "'" . ' ) ';
//            }
//          }
//        }
//        
//        if (isset($filter[controlPlagaTableClass::getNameField(controlPlagaTableClass::DOCUMENTO, true)]) and empty($filter[controlPlagaTableClass::getNameField(controlPlagaTableClass::DOCUMENTO, true)]) === false) {
//          if (request::getInstance()->isMethod('POST')) {
//
//            $documento = $filter[controlPlagaTableClass::getNameField(controlPlagaTableClass::DOCUMENTO, true)];
//              validator::validateFiltro($documento);
//            if (isset($documento) and $documento !== null and $documento !== '') {
//              $where[] = '(' . controlPlagaTableClass::getNameField(controlPlagaTableClass::DOCUMENTO) . ' = ' .  $documento  . ' ) ';
//            }
//          }
//        }
//        
//        if (isset($filter[controlPlagaTableClass::getNameField(controlPlagaTableClass::NOMBRE, true)]) and empty($filter[controlPlagaTableClass::getNameField(controlPlagaTableClass::NOMBRE, true)]) === false) {
//          if (request::getInstance()->isMethod('POST')) {
//
//            $nombre = $filter[controlPlagaTableClass::getNameField(controlPlagaTableClass::NOMBRE, true)];
//             validator::validateFiltroNombre($nombre);
//            if (isset($nombre) and $nombre !== null and $nombre !== '') {
//          $where[] = '(' . controlPlagaTableClass::getNameField(controlPlagaTableClass::NOMBRE) . ' LIKE ' . '\'' . $nombre . '%\'  '
//                  . 'OR ' . controlPlagaTableClass::getNameField(controlPlagaTableClass::NOMBRE) . ' LIKE ' . '\'%' . $nombre . '%\' '
//                  . 'OR ' . controlPlagaTableClass::getNameField(controlPlagaTableClass::NOMBRE) . ' LIKE ' . '\'%' . $nombre . '\') ';
//        }
//          }
//        }
//        
//        if (isset($filter[controlPlagaTableClass::getNameField(controlPlagaTableClass::APELLIDO, true)]) and empty($filter[controlPlagaTableClass::getNameField(controlPlagaTableClass::APELLIDO, true)]) === false) {
//          if (request::getInstance()->isMethod('POST')) {
//
//            $apellido = $filter[controlPlagaTableClass::getNameField(controlPlagaTableClass::APELLIDO, true)];
//              validator::validateFiltroApellido($apellido);
//            if (isset($apellido) and $apellido !== null and $apellido !== '') {
//          $where[] = '(' . controlPlagaTableClass::getNameField(controlPlagaTableClass::APELLIDO) . ' LIKE ' . '\'' . $apellido . '%\'  '
//                  . 'OR ' . controlPlagaTableClass::getNameField(controlPlagaTableClass::APELLIDO) . ' LIKE ' . '\'%' . $apellido . '%\' '
//                  . 'OR ' . controlPlagaTableClass::getNameField(controlPlagaTableClass::APELLIDO) . ' LIKE ' . '\'%' . $apellido . '\') ';
//        }
//          }
//        }
//
// if (isset($filter[controlPlagaTableClass::getNameField(controlPlagaTableClass::ID_CIUDAD, true)]) and empty($filter[controlPlagaTableClass::getNameField(controlPlagaTableClass::ID_CIUDAD, true)]) === false) {
//          if (request::getInstance()->isMethod('POST')) {
//
//            $ciudad = $filter[controlPlagaTableClass::getNameField(controlPlagaTableClass::ID_CIUDAD, true)];
//             
//             if (isset($ciudad) and $ciudad !== null and $ciudad !== '') {
//          $where[controlPlagaTableClass::ID_CIUDAD] = $ciudad;
//        }//cierre del filtro ciudad
//          }
//        }
      

       
        
//       session::getInstance()->setAttribute('clienteIndexFilters', $where);
//       }else if(session::getInstance()->hasAttribute('clienteIndexFilters')){
//        $where = session::getInstance()->getAttribute('clienteIndexFilters');
//     
        
//       }

      $fields = array(
          controlPlagaTableClass::ID,
          controlPlagaTableClass::LOTE_ID,
          controlPlagaTableClass::PLAGA_ID,
          controlPlagaTableClass::PRODUCTO_INSUMO_ID
      );
      $orderBy = array(
          controlPlagaTableClass::LOTE_ID
      );
      $page = 0;
      if (request::getInstance()->hasGet('page')) {
        $this->page = request::getInstance()->getGet('page');
        $page = request::getInstance()->getGet('page') - 1;
        $page = $page * config::getRowGrid();
      }//cierre del if del paguinado
      $this->cntPages = controlPlagaTableClass::getTotalPages(config::getRowGrid(), $where);
      $this->objControlPlaga = controlPlagaTableClass::getAll($fields, true, $orderBy, 'ASC', config::getRowGrid(), $page, $where);
      

      $this->defineView('index', 'controlPlaga', session::getInstance()->getFormatOutput());
    } //cierre del try
    catch (PDOException $exc) {
   routing::getInstance()->redirect('controlPlaga', 'index');
      
//      echo $exc->getMessage();
//      echo '<br>';
//      echo $exc->getTraceAsString();
    }//cierre del catch
  }

//cierre de la funcion execute
}

//cierre de la clase
