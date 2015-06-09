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

        if (isset($filter['nombre']) and $filter['nombre'] !== null and $filter['nombre'] !== '') {
          $where[cooperativaTableClass::NOMBRE] = $filter['nombre'];
        }
        if (isset($filter['descripcion']) and $filter['descripcion'] !== null and $filter['descripcion'] !== '') {
          $where[cooperativaTableClass::DESCRIPCION] = $filter['descripcion'];
        }
        if (isset($filter['ciudad']) and $filter['ciudad'] !== null and $filter['ciudad'] !== '') {
          $where[cooperativaTableClass::ID_CIUDAD] = $filter['ciudad'];
        }
        if (isset($filter['fechaIni']) and $filter['fechaIni'] !== null and $filter['fechaIni'] !== '' and (isset($filter['fechaFin']) and $filter['fechaFin'] !== null and $filter['fechaFin'] !== '')) {
          $where[cooperativaTableClass::CREATED_AT] = array(
          date(config::getFormatTimestamp(), strtotime($filter['fechaIni'] . ' 00:00:00')),
          date(config::getFormatTimestamp(), strtotime($filter['fechaFin'] . ' 23:59:59'))
          );
        }
      }
       
          
      $fields = array(
          cooperativaTableClass::ID,
          cooperativaTableClass::NOMBRE,
          cooperativaTableClass::DESCRIPCION,
          cooperativaTableClass::DIRECCION,
          cooperativaTableClass::TELEFONO,
          cooperativaTableClass::ID_CIUDAD
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
      $this->cntPages = cooperativaTableClass::getTotalPages(config::getRowGrid());
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
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
}

}
