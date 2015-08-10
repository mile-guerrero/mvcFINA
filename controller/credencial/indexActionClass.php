<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon 
 * @date: fecha de inicio del desarrollo.
 * @category: modulo de credencial.
 */
class indexActionClass extends controllerClass implements controllerActionInterface {

  
 /**
* @author: Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon .
* @date: fecha de inicio del desarrollo.
* @return   credencialTableClass::ID retorna (integer),
            credencialTableClass::NOMBRE retorna  (string),
            credencialTableClass::CREATED_AT retorna  (timestamp),
            credencialTableClass::UPDATED_AT retorna  (timestamp),
 * estos datos retornan en la variable $fields
*/
  public function execute() {
    try {
          $where = null;
      if(request::getInstance()->hasPost('filter')){
      $filter = request::getInstance()->getPost('filter');
      //validar
      if(isset($filter['nombre']) and $filter['nombre'] !== null and $filter['nombre'] !== ""){
        $where[] = '(' . credencialTableClass::getNameField(credencialTableClass::NOMBRE) . ' LIKE ' . '\'' . $filter['nombre'] . '%\'  '
              . 'OR ' . credencialTableClass::getNameField(credencialTableClass::NOMBRE) . ' LIKE ' . '\'%' . $filter['nombre'] . '%\' '
              . 'OR ' . credencialTableClass::getNameField(credencialTableClass::NOMBRE) . ' LIKE ' . '\'%' . $filter['nombre'].'\') ';       
              }//cierre del filtro nombre
              
       if (request::getInstance()->isMethod('POST')) {
//            echo 'dsasda';
//            exit();
            $fechaInicial = request::getInstance()->getPost(credencialTableClass::getNameField(credencialTableClass::CREATED_AT, true). '_1');
            
            $fechaFin = request::getInstance()->getPost(credencialTableClass::getNameField(credencialTableClass::CREATED_AT, true). '_2');
            
            if($fechaFin < $fechaInicial){
               session::getInstance()->setError('La fecha final no puede ser menor a la actual', 'inputFecha');
            }elseif($fechaFin == $fechaInicial){
                session::getInstance()->setError('La fecha final es igual a la inicial', 'inputFecha');
            }
            
        if ((isset($fechaInicial) and $fechaInicial !== null and $fechaInicial !== "") and ( isset($fechaFin) and $fechaFin !== null and $fechaFin !== "" )) {
          $where[credencialTableClass::CREATED_AT] = array(
              date(config::getFormatTimestamp(), strtotime($fechaInicial . ' 00:00:00')),
              date(config::getFormatTimestamp(), strtotime($fechaFin . ' 23:59:59'))
          );
        }
            
          }       
//     session::getInstance()->setAttribute('credencialIndexFilters', $where);
//       }else if(session::getInstance()->hasAttribute('credencialIndexFilters')){
//        $where = session::getInstance()->getAttribute('credencialIndexFilters');
//    
        }
      $fields = array(
          credencialTableClass::ID,
          credencialTableClass::NOMBRE,
		  credencialTableClass::CREATED_AT,
          credencialTableClass::UPDATED_AT
      );
      $orderBy = array(
         credencialTableClass::ID
      );
      $page = 0;
      if (request::getInstance()->hasGet('page')) {
        $this->page = request::getInstance()->getGet('page');
        $page = request::getInstance()->getGet('page') - 1;
        $page = $page * config::getRowGrid();
      }//cierre de paginado
      $this->cntPages = credencialTableClass::getTotalPages(config::getRowGrid(), $where);
      
      $this->objCredencial = credencialTableClass::getAll($fields, true, $orderBy, 'ASC',config::getRowGrid(), $page,$where);
      $this->defineView('index', 'credencial', session::getInstance()->getFormatOutput());
    }//cierre del try 
      catch (PDOException $exc) {
          routing::getInstance()->redirect('credencial', 'index');
//      echo $exc->getMessage();
//      echo '<br>';
//      echo $exc->getTraceAsString();
    }//cierre del catch
  }//cierre de la funcion execute

}//cierre de la clase
