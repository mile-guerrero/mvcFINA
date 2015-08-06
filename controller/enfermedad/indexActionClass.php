<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\enfermedadValidatorClass as validator;
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
        
        if (request::getInstance()->hasPost(enfermedadTableClass::getNameField(enfermedadTableClass::NOMBRE, true)) and empty(mvc\request\requestClass::getInstance()->getPost(enfermedadTableClass::getNameField(enfermedadTableClass::NOMBRE, true))) === false) {

          if (request::getInstance()->isMethod('POST')) {
            $nombre = request::getInstance()->getPost(enfermedadTableClass::getNameField(enfermedadTableClass::NOMBRE, true));
            validator::validateFiltro();

           if (isset($nombre) and $nombre !== null and $nombre !== '') {
          $where[] ='(' .  enfermedadTableClass::getNameField(enfermedadTableClass::NOMBRE) . ' LIKE ' . '\'' . $nombre . '%\'  '
              . 'OR ' . enfermedadTableClass::getNameField(enfermedadTableClass::NOMBRE) . ' LIKE ' . '\'%' . $nombre . '%\' '
              . 'OR ' . enfermedadTableClass::getNameField(enfermedadTableClass::NOMBRE) . ' LIKE ' . '\'%' . $nombre .'\') ';       
              
            }//cierre del filtro documento
          }//cierre del filtro ubicacion   
        }
        
         if (request::getInstance()->hasPost(enfermedadTableClass::getNameField(enfermedadTableClass::DESCRIPCION, true)) and empty(mvc\request\requestClass::getInstance()->getPost(enfermedadTableClass::getNameField(enfermedadTableClass::DESCRIPCION, true))) === false) {

          if (request::getInstance()->isMethod('POST')) {
            $descripcion = request::getInstance()->getPost(enfermedadTableClass::getNameField(enfermedadTableClass::DESCRIPCION, true));
            validator::validateFiltroDescripcion();

          if (isset($descripcion) and $descripcion !== null and $descripcion !== '') {
         $where[] = '(' . enfermedadTableClass::getNameField(enfermedadTableClass::DESCRIPCION) . ' LIKE ' . '\'' . $descripcion . '%\'  '
              . 'OR ' . enfermedadTableClass::getNameField(enfermedadTableClass::DESCRIPCION) . ' LIKE ' . '\'%' . $descripcion . '%\' '
              . 'OR ' . enfermedadTableClass::getNameField(enfermedadTableClass::DESCRIPCION) . ' LIKE ' . '\'%' . $descripcion .'\') ';       
              }
          }//cierre del filtro ubicacion   
        }
       
      
        if (isset($filter['fecha1']) and $filter['fecha1'] !== null and $filter['fecha1'] !== '' and (isset($filter['fecha2']) and $filter['fecha2'] !== null and $filter['fecha2'] !== '')) {
          $where[enfermedadTableClass::CREATED_AT] = array(
          date(config::getFormatTimestamp(), strtotime($filter['fecha1'] . ' 00:00:00')),
          date(config::getFormatTimestamp(), strtotime($filter['fecha2'] . ' 23:59:59'))
          );
        }//cierre del filtro fecha1 y fecha2
          
//     session::getInstance()->setAttribute('enfermedadIndexFilters', $where);
//       }else if(session::getInstance()->hasAttribute('enfermedadIndexFilters')){
//        $where = session::getInstance()->getAttribute('enfermedadIndexFilters');
//    
        }
      $fields = array(
          enfermedadTableClass::ID,
          enfermedadTableClass::NOMBRE,
          enfermedadTableClass::DESCRIPCION,
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
