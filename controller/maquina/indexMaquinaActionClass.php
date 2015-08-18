<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\maquinaValidatorClass as validator;

/**
 * Description of ejemploClass
 *
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
 */
class indexMaquinaActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      $where = null;
      if (request::getInstance()->hasPost('filter')) {
        $filter = request::getInstance()->getPost('filter');
        //validar
        
        if ((isset($filter[maquinaTableClass::getNameField(maquinaTableClass::CREATED_AT, true) . '_1']) and empty($filter[maquinaTableClass::getNameField(maquinaTableClass::CREATED_AT, true) . '_1']) === false) and ( isset($filter[maquinaTableClass::getNameField(maquinaTableClass::CREATED_AT, true) . '_2']) and empty($filter[maquinaTableClass::getNameField(maquinaTableClass::CREATED_AT, true) . '_2']) === false)) {
          if (request::getInstance()->isMethod('POST')) {

            $fechaInicial = $filter[maquinaTableClass::getNameField(maquinaTableClass::CREATED_AT, true) . '_1'];
            $fechaFin = $filter[maquinaTableClass::getNameField(maquinaTableClass::CREATED_AT, true) . '_2'];

            validator::validateFiltroFecha($fechaInicial, $fechaFin);

            if ((isset($fechaInicial) and $fechaInicial !== null and $fechaInicial !== "") and ( isset($fechaFin) and $fechaFin !== null and $fechaFin !== "" )) {
              $where[] = '(' . maquinaTableClass::getNameField(maquinaTableClass::CREATED_AT) . ' BETWEEN ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaInicial . ' 00:00:00')) . "'" . ' AND ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaFin . ' 23:59:59')) . "'" . ' ) ';
            }
          }
        }
        
        if (isset($filter[maquinaTableClass::getNameField(maquinaTableClass::NOMBRE, true)]) and empty($filter[maquinaTableClass::getNameField(maquinaTableClass::NOMBRE, true)]) === false) {
          if (request::getInstance()->isMethod('POST')) {

            $nombre = $filter[maquinaTableClass::getNameField(maquinaTableClass::NOMBRE, true)];

          validator::validateFiltro($nombre);
            if (isset($nombre) and $nombre !== null and $nombre !== "") {
              $where[] = '(' . maquinaTableClass::getNameField(maquinaTableClass::NOMBRE) . ' LIKE ' . '\'' . $nombre . '%\'  '
                      . 'OR ' . maquinaTableClass::getNameField(maquinaTableClass::NOMBRE) . ' LIKE ' . '\'%' . $nombre . '%\' '
                      . 'OR ' . maquinaTableClass::getNameField(maquinaTableClass::NOMBRE) . ' LIKE ' . '\'%' . $nombre . '\') ';
            }
          }
        }
        
        
        if (isset($filter[maquinaTableClass::getNameField(maquinaTableClass::PROVEEDOR_ID, true)]) and empty($filter[maquinaTableClass::getNameField(maquinaTableClass::PROVEEDOR_ID, true)]) === false) {
          if (request::getInstance()->isMethod('POST')) {

            $proveedor = $filter[maquinaTableClass::getNameField(maquinaTableClass::PROVEEDOR_ID, true)];

           if (isset($proveedor) and $proveedor !== null and $proveedor !== "") {
        $where[maquinaTableClass::PROVEEDOR_ID] = $proveedor;
      
            }
          }
        }
        
//
//       session::getInstance()->setAttribute('maquinaIndexFilters', $where);
//       }else if(session::getInstance()->hasAttribute('maquinaIndexFilters')){
//        $where = session::getInstance()->getAttribute('maquinaIndexFilters');
//     
        
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
      $this->cntPages = maquinaTableClass::getTotalPages(config::getRowGrid(), $where);
      
      $this->objMaquina = maquinaTableClass::getAll($fields, true, $orderBy, 'ASC', config::getRowGrid(), $page, $where);

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
          proveedorTableClass::NOMBREP,
          proveedorTableClass::APELLIDO,
          proveedorTableClass::DOCUMENTO
      );
      $orderBy = array(
          proveedorTableClass::ID
      );
      $this->objMP = proveedorTableClass::getAll($fields, true, $orderBy, 'ASC');


      $this->defineView('indexMaquina', 'maquina', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
       routing::getInstance()->redirect('maquina', 'indexMaquina');
//      echo $exc->getMessage();
//      echo '<br>';
//      echo $exc->getTraceAsString();
    }
  }

}
