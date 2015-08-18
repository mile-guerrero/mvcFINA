<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\empresaValidatorClass as validator;

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
        //Validar datos
        if ((isset($filter[empresaTableClass::getNameField(empresaTableClass::CREATED_AT, true) . '_1']) and empty($filter[empresaTableClass::getNameField(empresaTableClass::CREATED_AT, true) . '_1']) === false) and ( isset($filter[empresaTableClass::getNameField(empresaTableClass::CREATED_AT, true) . '_2']) and empty($filter[empresaTableClass::getNameField(empresaTableClass::CREATED_AT, true) . '_2']) === false)) {
          if (request::getInstance()->isMethod('POST')) {

            $fechaInicial = $filter[empresaTableClass::getNameField(empresaTableClass::CREATED_AT, true) . '_1'];
            $fechaFin = $filter[empresaTableClass::getNameField(empresaTableClass::CREATED_AT, true) . '_2'];

            validator::validateFiltroFecha($fechaInicial, $fechaFin);

            if ((isset($fechaInicial) and $fechaInicial !== null and $fechaInicial !== "") and ( isset($fechaFin) and $fechaFin !== null and $fechaFin !== "" )) {
              $where[] = '(' . empresaTableClass::getNameField(empresaTableClass::CREATED_AT) . ' BETWEEN ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaInicial . ' 00:00:00')) . "'" . ' AND ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaFin . ' 23:59:59')) . "'" . ' ) ';
            }
          }
        }
        
         if (isset($filter[empresaTableClass::getNameField(empresaTableClass::NOMBRE, true)]) and empty($filter[empresaTableClass::getNameField(empresaTableClass::NOMBRE, true)]) === false) {
          if (request::getInstance()->isMethod('POST')) {

            $nombre = $filter[empresaTableClass::getNameField(empresaTableClass::NOMBRE, true)];
            validator::validateFiltroNombre($nombre);
            if (isset($nombre) and $nombre !== null and $nombre !== "") {
            $where[] = '(' . empresaTableClass::getNameField(empresaTableClass::NOMBRE) . ' LIKE ' . '\'' . $nombre . '%\'  '
              . 'OR ' . empresaTableClass::getNameField(empresaTableClass::NOMBRE) . ' LIKE ' . '\'%' . $nombre . '%\' '
              . 'OR ' . empresaTableClass::getNameField(empresaTableClass::NOMBRE) . ' LIKE ' . '\'%' . $nombre.'\') ';       
              }//cierre del filtro nombre
          }
        }
        
       

//       session::getInstance()->setAttribute('empresaIndexFilters', $where);
//       }else if(session::getInstance()->hasAttribute('empresaIndexFilters')){
//        $where = session::getInstance()->getAttribute('empresaIndexFilters');
//    
        }


      $fields = array(
          empresaTableClass::ID,
          empresaTableClass::NOMBRE,
          empresaTableClass::DIRECCION,
          empresaTableClass::TELEFONO,
          empresaTableClass::EMAIL,
      );
      $orderBy = array(
          empresaTableClass::ID
      );
     $page = 0;
      if (request::getInstance()->hasGet('page')) {
        $this->page = request::getInstance()->getGet('page');
        $page = request::getInstance()->getGet('page') - 1;
        $page = $page * config::getRowGrid();
      }
      $this->cntPages = empresaTableClass::getTotalPages(config::getRowGrid(), $where);
      $this->objEmpresa = empresaTableClass::getAll($fields, true, $orderBy, 'ASC', config::getRowGrid(), $page, $where);


      $this->defineView('index', 'empresa', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      routing::getInstance()->redirect('empresa', 'index');
//      echo $exc->getMessage();
//      echo '<br>';
//      echo $exc->getTraceAsString();
    }
  }

}
