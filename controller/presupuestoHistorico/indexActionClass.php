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
   * @return   presupuestoHistoricoTableClass::ID retorna (integer),
    presupuestoHistoricoTableClass::NOMBRE retorna  (string),
    presupuestoHistoricoTableClass::APELLIDO retorna  (string),
    presupuestoHistoricoTableClass::DOCUMENTO retorna  (integer),
    presupuestoHistoricoTableClass::DIRECCION retorna  (string),
    presupuestoHistoricoTableClass::TELEFONO retorna  (integer),
    presupuestoHistoricoTableClass::ID_TIPO_ID retorna (integer),
    presupuestoHistoricoTableClass::ID_CIUDAD retorna  (integer),
    presupuestoHistoricoTableClass::UPDATE_AT retorna  (timestamp),
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
//        if ((isset($filter[presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::CREATED_AT, true) . '_1']) and empty($filter[presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::CREATED_AT, true) . '_1']) === false) and ( isset($filter[presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::CREATED_AT, true) . '_2']) and empty($filter[presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::CREATED_AT, true) . '_2']) === false)) {
//          if (request::getInstance()->isMethod('POST')) {
//
//            $fechaInicial = $filter[presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::CREATED_AT, true) . '_1'];
//            $fechaFin = $filter[presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::CREATED_AT, true) . '_2'];
//
//            validator::validateFiltroFecha($fechaInicial, $fechaFin);
//
//            if ((isset($fechaInicial) and $fechaInicial !== null and $fechaInicial !== "") and ( isset($fechaFin) and $fechaFin !== null and $fechaFin !== "" )) {
//              $where[] = '(' . presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::CREATED_AT) . ' BETWEEN ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaInicial . ' 00:00:00')) . "'" . ' AND ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaFin . ' 23:59:59')) . "'" . ' ) ';
//            }
//          }
//        }
//        
//        if (isset($filter[presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::DOCUMENTO, true)]) and empty($filter[presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::DOCUMENTO, true)]) === false) {
//          if (request::getInstance()->isMethod('POST')) {
//
//            $documento = $filter[presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::DOCUMENTO, true)];
//              validator::validateFiltro($documento);
//            if (isset($documento) and $documento !== null and $documento !== '') {
//              $where[] = '(' . presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::DOCUMENTO) . ' = ' .  $documento  . ' ) ';
//            }
//          }
//        }
//        
//        if (isset($filter[presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::NOMBRE, true)]) and empty($filter[presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::NOMBRE, true)]) === false) {
//          if (request::getInstance()->isMethod('POST')) {
//
//            $nombre = $filter[presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::NOMBRE, true)];
//             validator::validateFiltroNombre($nombre);
//            if (isset($nombre) and $nombre !== null and $nombre !== '') {
//          $where[] = '(' . presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::NOMBRE) . ' LIKE ' . '\'' . $nombre . '%\'  '
//                  . 'OR ' . presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::NOMBRE) . ' LIKE ' . '\'%' . $nombre . '%\' '
//                  . 'OR ' . presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::NOMBRE) . ' LIKE ' . '\'%' . $nombre . '\') ';
//        }
//          }
//        }
//        
//        if (isset($filter[presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::APELLIDO, true)]) and empty($filter[presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::APELLIDO, true)]) === false) {
//          if (request::getInstance()->isMethod('POST')) {
//
//            $apellido = $filter[presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::APELLIDO, true)];
//              validator::validateFiltroApellido($apellido);
//            if (isset($apellido) and $apellido !== null and $apellido !== '') {
//          $where[] = '(' . presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::APELLIDO) . ' LIKE ' . '\'' . $apellido . '%\'  '
//                  . 'OR ' . presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::APELLIDO) . ' LIKE ' . '\'%' . $apellido . '%\' '
//                  . 'OR ' . presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::APELLIDO) . ' LIKE ' . '\'%' . $apellido . '\') ';
//        }
//          }
//        }
//
// if (isset($filter[presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::ID_CIUDAD, true)]) and empty($filter[presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::ID_CIUDAD, true)]) === false) {
//          if (request::getInstance()->isMethod('POST')) {
//
//            $ciudad = $filter[presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::ID_CIUDAD, true)];
//             
//             if (isset($ciudad) and $ciudad !== null and $ciudad !== '') {
//          $where[presupuestoHistoricoTableClass::ID_CIUDAD] = $ciudad;
//        }//cierre del filtro ciudad
//          }
//        }
      

       
        
//       session::getInstance()->setAttribute('clienteIndexFilters', $where);
//       }else if(session::getInstance()->hasAttribute('clienteIndexFilters')){
//        $where = session::getInstance()->getAttribute('clienteIndexFilters');
//     
        
//       }

      $fields = array(
          presupuestoHistoricoTableClass::ID,
          presupuestoHistoricoTableClass::LOTE_ID,
          presupuestoHistoricoTableClass::PRODUCTO_INSUMO_ID
      );
      $orderBy = array(
          presupuestoHistoricoTableClass::LOTE_ID
      );
      $page = 0;
      if (request::getInstance()->hasGet('page')) {
        $this->page = request::getInstance()->getGet('page');
        $page = request::getInstance()->getGet('page') - 1;
        $page = $page * config::getRowGrid();
      }//cierre del if del paguinado
      $this->cntPages = presupuestoHistoricoTableClass::getTotalPages(config::getRowGrid(), $where);
      $this->objPresupuestoHistorico = presupuestoHistoricoTableClass::getAll($fields, true, $orderBy, 'ASC', config::getRowGrid(), $page, $where);
      

      $this->defineView('index', 'presupuestoHistorico', session::getInstance()->getFormatOutput());
    } //cierre del try
    catch (PDOException $exc) {
   routing::getInstance()->redirect('presupuestoHistorico', 'index');
      
//      echo $exc->getMessage();
//      echo '<br>';
//      echo $exc->getTraceAsString();
    }//cierre del catch
  }

//cierre de la funcion execute
}

//cierre de la clase
