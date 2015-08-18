<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\enfermedadValidatorClass as validator;


/**
* @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon 
* @date: fecha de inicio del desarrollo.
* @category: modulo de cliente.
*/
class indexActionClass extends controllerClass implements controllerActionInterface {

   /**
* @author: Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon .
* @date: fecha de inicio del desarrollo.
* @return   enfermedadTableClass::ID retorna (integer),
            enfermedadTableClass::NOMBRE retorna  (string),
            enfermedadTableClass::DESCRIPCION retorna  (string),
            enfermedadTableClass::TRATAMIENTO retorna  (string),
 * estos datos retornan en la variable $fields
*/
  public function execute() {
    try {
      
      
      
      
    $where = null;
   if (request::getInstance()->hasPost('filter')) {
        $filter = request::getInstance()->getPost('filter');
        //Validar datos
        
      if ((isset($filter[enfermedadTableClass::getNameField(enfermedadTableClass::CREATED_AT, true) . '_1']) and empty($filter[enfermedadTableClass::getNameField(enfermedadTableClass::CREATED_AT, true) . '_1']) === false) and ( isset($filter[enfermedadTableClass::getNameField(enfermedadTableClass::CREATED_AT, true) . '_2']) and empty($filter[enfermedadTableClass::getNameField(enfermedadTableClass::CREATED_AT, true) . '_2']) === false)) {
          if (request::getInstance()->isMethod('POST')) {

            $fechaInicial = $filter[enfermedadTableClass::getNameField(enfermedadTableClass::CREATED_AT, true) . '_1'];
            $fechaFin = $filter[enfermedadTableClass::getNameField(enfermedadTableClass::CREATED_AT, true) . '_2'];

            validator::validateFiltroFecha($fechaInicial, $fechaFin);

            if ((isset($fechaInicial) and $fechaInicial !== null and $fechaInicial !== "") and ( isset($fechaFin) and $fechaFin !== null and $fechaFin !== "" )) {
              $where[] = '(' . enfermedadTableClass::getNameField(enfermedadTableClass::CREATED_AT) . ' BETWEEN ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaInicial . ' 00:00:00')) . "'" . ' AND ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaFin . ' 23:59:59')) . "'" . ' ) ';
            }
          }
        }
        
         if (isset($filter[enfermedadTableClass::getNameField(enfermedadTableClass::NOMBRE, true)]) and empty($filter[enfermedadTableClass::getNameField(enfermedadTableClass::NOMBRE, true)]) === false) {
          if (request::getInstance()->isMethod('POST')) {

            $nombre = $filter[enfermedadTableClass::getNameField(enfermedadTableClass::NOMBRE, true)];
            validator::validateFiltroNombre($nombre);
            if (isset($nombre) and $nombre !== null and $nombre !== "") {
            $where[] = '(' . enfermedadTableClass::getNameField(enfermedadTableClass::NOMBRE) . ' LIKE ' . '\'' . $nombre . '%\'  '
              . 'OR ' . enfermedadTableClass::getNameField(enfermedadTableClass::NOMBRE) . ' LIKE ' . '\'%' . $nombre . '%\' '
              . 'OR ' . enfermedadTableClass::getNameField(enfermedadTableClass::NOMBRE) . ' LIKE ' . '\'%' . $nombre.'\') ';       
              }//cierre del filtro nombre
          }
        }
       
//     session::getInstance()->setAttribute('enfermedadIndexFilters', $where);
//       }else if(session::getInstance()->hasAttribute('enfermedadIndexFilters')){
//        $where = session::getInstance()->getAttribute('enfermedadIndexFilters');
//    
        }
      $fields = array(
          enfermedadTableClass::ID,
          enfermedadTableClass::NOMBRE,
          enfermedadTableClass::DESCRIPCION,
          enfermedadTableClass::CREATED_AT,
          enfermedadTableClass::TRATAMIENTO
      );
      $orderBy = array(
         enfermedadTableClass::NOMBRE
      );
        $page = 0;
      if (request::getInstance()->hasGet('page')) {
        $this->page = request::getInstance()->getGet('page');
        $page = request::getInstance()->getGet('page') - 1;
        $page = $page * config::getRowGrid();
      }//cierre del if del paguinado
      $this->cntPages = enfermedadTableClass::getTotalPages(config::getRowGrid(), $where);
      $this->objEnfermedad = enfermedadTableClass::getAll($fields, true, $orderBy, 'ASC', config::getRowGrid(), $page,$where);
          
      $this->defineView('index', 'enfermedad', session::getInstance()->getFormatOutput());
    } //cierre del try
    
     catch (PDOException $exc) {
        routing::getInstance()->redirect('enfermedad', 'index');
//      echo $exc->getMessage();
//      echo '<br>';
//      echo $exc->getTraceAsString();
    }//cierre del catch
   
}//cierre de la funcion execute

}//cierre de la clase
