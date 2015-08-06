<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\tipoProductoInsumoValidatorClass as validator;

/**
 * Description of ejemploClass
 *
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
 */
class indexTipoProductoInsumoActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      $where = null;
      if(request::getInstance()->hasPost('filter')){
      $filter = request::getInstance()->getPost('filter');
      //validar
      if (request::getInstance()->hasPost(tipoProductoInsumoTableClass::getNameField(tipoProductoInsumoTableClass::DESCRIPCION, true)) and empty(mvc\request\requestClass::getInstance()->getPost(tipoProductoInsumoTableClass::getNameField(tipoProductoInsumoTableClass::DESCRIPCION, true))) === false) {

          if (request::getInstance()->isMethod('POST')) {
            $descripcion = request::getInstance()->getPost(tipoProductoInsumoTableClass::getNameField(tipoProductoInsumoTableClass::DESCRIPCION, true));
            
            validator::validateFiltro();

            if(isset($descripcion) and $descripcion !== null and $descripcion !== ""){
        $where[] = '(' . tipoProductoInsumoTableClass::getNameField(tipoProductoInsumoTableClass::DESCRIPCION) . ' LIKE ' . '\'' . $descripcion . '%\'  '
              . 'OR ' . tipoProductoInsumoTableClass::getNameField(tipoProductoInsumoTableClass::DESCRIPCION) . ' LIKE ' . '\'%' . $descripcion . '%\' '
              . 'OR ' . tipoProductoInsumoTableClass::getNameField(tipoProductoInsumoTableClass::DESCRIPCION) . ' LIKE ' . '\'%' . $descripcion .'\') ';       
              }
            }//cierre del filtro ubicacion   
          }
        
      
              
      if((isset($filter['fechaIni']) and $filter['fechaIni'] !== null and $filter['fechaIni'] !== "") and (isset($filter['fechaFin']) and $filter['fechaFin'] !== null and $filter['fechaFin'] !== "" )){
        $where[tipoProductoInsumoTableClass::CREATED_AT] = array(
           date(config::getFormatTimestamp(), strtotime($filter['fechaIni'].' 00:00:00')),
           date(config::getFormatTimestamp(), strtotime($filter['fechaFin'].' 23:59:59'))
            );
      }     
//  session::getInstance()->setAttribute('tipoProductoInsumoIndexFilters', $where);
//       }else if(session::getInstance()->hasAttribute('tipoProductoInsumoIndexFilters')){
//        $where = session::getInstance()->getAttribute('tipoProductoInsumoIndexFilters');
     }
      $fields = array(
          tipoProductoInsumoTableClass::ID,
          tipoProductoInsumoTableClass::DESCRIPCION,
          tipoProductoInsumoTableClass::CREATED_AT,
        );
      $orderBy = array(
         tipoProductoInsumoTableClass::ID
      );
      $page = 0;
      if (request::getInstance()->hasGet('page')) {
        $this->page = request::getInstance()->getGet('page');
        $page = request::getInstance()->getGet('page') - 1;
        $page = $page * config::getRowGrid();
      }
      $this->cntPages = tipoProductoInsumoTableClass::getTotalPages(config::getRowGrid(), $where);
      $this->objTPI = tipoProductoInsumoTableClass::getAll($fields, true, $orderBy, 'ASC',config::getRowGrid(), $page,$where);
//      $this->objUsuarios = usuarioTableClass::getAll($fields, true);
      $this->defineView('indexTipoProductoInsumo', 'productoInsumo', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
       routing::getInstance()->redirect('productoInsumo', 'indexTipoProductoInsumo');
//      echo $exc->getMessage();
//      echo '<br>';
//      echo $exc->getTraceAsString();
    }
}

}
