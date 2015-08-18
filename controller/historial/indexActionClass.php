<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\historialValidatorClass as validator;

/**
 * Description of ejemploClass
 *
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
 */
class indexActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      $where = null;
      if (request::getInstance()->hasPost('filter')) {
        $filter = request::getInstance()->getPost('filter');
        //validar


        if ((isset($filter[historialTableClass::getNameField(historialTableClass::CREATED_AT, true) . '_1']) and empty($filter[historialTableClass::getNameField(historialTableClass::CREATED_AT, true) . '_1']) === false) and ( isset($filter[historialTableClass::getNameField(historialTableClass::CREATED_AT, true) . '_2']) and empty($filter[historialTableClass::getNameField(historialTableClass::CREATED_AT, true) . '_2']) === false)) {
          if (request::getInstance()->isMethod('POST')) {

            $fechaInicial = $filter[historialTableClass::getNameField(historialTableClass::CREATED_AT, true) . '_1'];
            $fechaFin = $filter[historialTableClass::getNameField(historialTableClass::CREATED_AT, true) . '_2'];

            validator::validateFiltroFecha($fechaInicial, $fechaFin);

            if ((isset($fechaInicial) and $fechaInicial !== null and $fechaInicial !== "") and ( isset($fechaFin) and $fechaFin !== null and $fechaFin !== "" )) {
              $where[] = '(' . historialTableClass::getNameField(historialTableClass::CREATED_AT) . ' BETWEEN ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaInicial . ' 00:00:00')) . "'" . ' AND ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaFin . ' 23:59:59')) . "'" . ' ) ';
            }
          }
        }

      if (isset($filter[historialTableClass::getNameField(historialTableClass::LOTE_ID, true)]) and empty($filter[historialTableClass::getNameField(historialTableClass::LOTE_ID, true)]) === false) {
          if (request::getInstance()->isMethod('POST')) {

            $lote = $filter[historialTableClass::getNameField(historialTableClass::LOTE_ID, true)];

            if (isset($lote) and $lote !== null and $lote !== "") {
             $where[] = '(' . historialTableClass::getNameField(historialTableClass::LOTE_ID) . ' = ' .  $lote  . ' ) ';
            }
          }
        }
        
        if (isset($filter[historialTableClass::getNameField(historialTableClass::PRODUCTO_INSUMO_ID, true)]) and empty($filter[historialTableClass::getNameField(historialTableClass::PRODUCTO_INSUMO_ID, true)]) === false) {
          if (request::getInstance()->isMethod('POST')) {

            $insumo = $filter[historialTableClass::getNameField(historialTableClass::PRODUCTO_INSUMO_ID, true)];

            if (isset($insumo) and $insumo !== null and $insumo !== "") {
              $where[] = '(' . historialTableClass::getNameField(historialTableClass::PRODUCTO_INSUMO_ID) . ' = ' .  $insumo  . ' ) ';
            }
          }
        }

        




//      session::getInstance()->setAttribute('historialIndexFilters', $where);
//       }else if(session::getInstance()->hasAttribute('historialIndexFilters')){
//        $where = session::getInstance()->getAttribute('historialIndexFilters');
//    
      }

      $fields = array(
          historialTableClass::ID,
          historialTableClass::PRODUCTO_INSUMO_ID,
          historialTableClass::ENFERMEDAD_ID,
          historialTableClass::PLAGA_ID,
          historialTableClass::LOTE_ID,
          historialTableClass::CREATED_AT
      );
      $orderBy = array(
          historialTableClass::ID
      );
      $page = 0;
      if (request::getInstance()->hasGet('page')) {
        $this->page = request::getInstance()->getGet('page');
        $page = request::getInstance()->getGet('page') - 1;
        $page = $page * config::getRowGrid();
      }
      $this->cntPages = historialTableClass::getTotalPages(config::getRowGrid(), $where);

      $this->objHistorial = historialTableClass::getAll($fields, false, $orderBy, 'ASC', config::getRowGrid(), $page, $where);

      $fields = array(
          plagaTableClass::ID,
          plagaTableClass::NOMBRE,
          plagaTableClass::DESCRIPCION,
          plagaTableClass::TRATAMIENTO
      );
      $orderBy = array(
          plagaTableClass::NOMBRE
      );
      $this->objHistorialPlaga = plagaTableClass::getAll($fields, false, $orderBy, 'ASC');

      $fields = array(
          loteTableClass::ID,
          loteTableClass::UBICACION,
          loteTableClass::FECHA_RIEGO
      );
      $orderBy = array(
          loteTableClass::UBICACION
      );
      $this->objHistorialLote = loteTableClass::getAll($fields, true, $orderBy, 'ASC');

      $fields = array(
          productoInsumoTableClass::ID,
          productoInsumoTableClass::DESCRIPCION
      );
      $orderBy = array(
          productoInsumoTableClass::DESCRIPCION
      );
      $this->objHistorialProducto = productoInsumoTableClass::getAll($fields, true, $orderBy, 'ASC');

      $fields = array(
          enfermedadTableClass::ID,
          enfermedadTableClass::NOMBRE
      );
      $orderBy = array(
          enfermedadTableClass::NOMBRE
      );
      $this->objHistorialEnfermedad = enfermedadTableClass::getAll($fields, true, $orderBy, 'ASC');


      $this->defineView('index', 'historial', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      routing::getInstance()->redirect('historial', 'index');
//      echo $exc->getMessage();
//      echo '<br>';
//      echo $exc->getTraceAsString();
    }
  }

}
