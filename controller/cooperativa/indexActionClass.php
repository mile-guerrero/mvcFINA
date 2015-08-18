<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\cooperativaValidatorClass as validator;

/**
 * Description of ejemploClass
 *
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
 * @date: fecha de inicio del desarrollo.
 * @static: se define si la clase es de tipo estatica.
 * @category:modulo de cooperativa
 */
class indexActionClass extends controllerClass implements controllerActionInterface {
/**
  * @author: Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
  * @date: fecha de inicio del desarrollo.
  * @return cooperativaTableClass::ID retorna $id(integer),
  *        cooperativaTableClass::NOMBRE retorna $nombre(string),
  *        cooperativaTableClass::DESCRIPCION retorna $descripcion(string),
  *        cooperativaTableClass::DIRECCION retorna $direccion(string),
  *        cooperativaTableClass::TELEFONO retorna $telefono(integer),  
  *        cooperativaTableClass::ID_CIUDAD retorna $id_ciudad(integer),
  * estos datos retornan en la variable $fields
  */
  public function execute() {
    try {
      
      $where = null;
      if (request::getInstance()->hasPost('filter')) {
        $filter = request::getInstance()->getPost('filter');
        //Validar datos
        
         if ((isset($filter[cooperativaTableClass::getNameField(cooperativaTableClass::CREATED_AT, true) . '_1']) and empty($filter[cooperativaTableClass::getNameField(cooperativaTableClass::CREATED_AT, true) . '_1']) === false) and ( isset($filter[cooperativaTableClass::getNameField(cooperativaTableClass::CREATED_AT, true) . '_2']) and empty($filter[cooperativaTableClass::getNameField(cooperativaTableClass::CREATED_AT, true) . '_2']) === false)) {
          if (request::getInstance()->isMethod('POST')) {

            $fechaInicial = $filter[cooperativaTableClass::getNameField(cooperativaTableClass::CREATED_AT, true) . '_1'];
            $fechaFin = $filter[cooperativaTableClass::getNameField(cooperativaTableClass::CREATED_AT, true) . '_2'];

            validator::validateFiltroFecha($fechaInicial, $fechaFin);

            if ((isset($fechaInicial) and $fechaInicial !== null and $fechaInicial !== "") and ( isset($fechaFin) and $fechaFin !== null and $fechaFin !== "" )) {
              $where[] = '(' . cooperativaTableClass::getNameField(cooperativaTableClass::CREATED_AT) . ' BETWEEN ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaInicial . ' 00:00:00')) . "'" . ' AND ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaFin . ' 23:59:59')) . "'" . ' ) ';
            }
          }
        }
        
         if (isset($filter[cooperativaTableClass::getNameField(cooperativaTableClass::NOMBRE, true)]) and empty($filter[cooperativaTableClass::getNameField(cooperativaTableClass::NOMBRE, true)]) === false) {
          if (request::getInstance()->isMethod('POST')) {

            $nombre = $filter[cooperativaTableClass::getNameField(cooperativaTableClass::NOMBRE, true)];
     validator::validateFiltroNombre($nombre);
            if (isset($nombre) and $nombre !== null and $nombre !== "") {
            $where[] = '(' . cooperativaTableClass::getNameField(cooperativaTableClass::NOMBRE) . ' LIKE ' . '\'' . $nombre . '%\'  '
              . 'OR ' . cooperativaTableClass::getNameField(cooperativaTableClass::NOMBRE) . ' LIKE ' . '\'%' . $nombre . '%\' '
              . 'OR ' . cooperativaTableClass::getNameField(cooperativaTableClass::NOMBRE) . ' LIKE ' . '\'%' . $nombre.'\') ';       
              }//cierre del filtro nombre
          }
        }
        
        
       
//       session::getInstance()->setAttribute('cooperativaIndexFilters', $where);
//       }else if(session::getInstance()->hasAttribute('cooperativaIndexFilters')){
//        $where = session::getInstance()->getAttribute('cooperativaIndexFilters');
//    
        }
       
          
      $fields = array(
          cooperativaTableClass::ID,
          cooperativaTableClass::NOMBRE,
          cooperativaTableClass::DESCRIPCION,
          cooperativaTableClass::DIRECCION,
          cooperativaTableClass::TELEFONO,
          cooperativaTableClass::ID_CIUDAD,
          cooperativaTableClass::DELETED_AT
      );
      $orderBy = array(
         cooperativaTableClass::ID
      );
      $page = 0;
      if (request::getInstance()->hasGet('page')) {
        $this->page = request::getInstance()->getGet('page');
        $page = request::getInstance()->getGet('page') - 1;
        $page = $page * config::getRowGrid();
      }
      $this->cntPages = cooperativaTableClass::getTotalPages(config::getRowGrid(), $where);
      $this->objCooperativa = cooperativaTableClass::getAll($fields, true, $orderBy, 'ASC', config::getRowGrid(), $page,$where);
      
      
      $fields = array(
      ciudadBaseTableClass::ID,
      ciudadTableClass::NOMBRE_CIUDAD
      );
      $orderBy = array(
      ciudadBaseTableClass::NOMBRE_CIUDAD
      );
      $this->objCC = ciudadTableClass::getAll($fields, false, $orderBy, 'ASC');
      
      
      $this->defineView('index', 'cooperativa', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      routing::getInstance()->redirect('cooperativa', 'index');
//      echo $exc->getMessage();
//      echo '<br>';
//      echo $exc->getTraceAsString();
    }
}

}
