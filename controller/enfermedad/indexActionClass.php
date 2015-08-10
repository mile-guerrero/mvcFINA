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
        
       if (isset($filter['nombre']) and $filter['nombre'] !== null and $filter['nombre'] !== '') {
          $where[] ='(' .  enfermedadTableClass::getNameField(enfermedadTableClass::NOMBRE) . ' LIKE ' . '\'' . $filter['nombre'] . '%\'  '
              . 'OR ' . enfermedadTableClass::getNameField(enfermedadTableClass::NOMBRE) . ' LIKE ' . '\'%' . $filter['nombre'] . '%\' '
              . 'OR ' . enfermedadTableClass::getNameField(enfermedadTableClass::NOMBRE) . ' LIKE ' . '\'%' . $filter['nombre'].'\') ';       
              }//cierre del filtro nombre
              
        if (isset($filter['descripcion']) and $filter['descripcion'] !== null and $filter['descripcion'] !== '') {
         $where[] = '(' . enfermedadTableClass::getNameField(enfermedadTableClass::DESCRIPCION) . ' LIKE ' . '\'' . $filter['descripcion'] . '%\'  '
              . 'OR ' . enfermedadTableClass::getNameField(enfermedadTableClass::DESCRIPCION) . ' LIKE ' . '\'%' . $filter['descripcion'] . '%\' '
              . 'OR ' . enfermedadTableClass::getNameField(enfermedadTableClass::DESCRIPCION) . ' LIKE ' . '\'%' . $filter['descripcion'].'\') ';       
              }//cierre del filtro descripcion 
       
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
