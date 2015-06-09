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
class reportActionClass extends controllerClass implements controllerActionInterface {

  
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
      
      //$this->mensaje = 'Hola a todos';
     
      
       $where = null;
      if(request::getInstance()->hasPost('filter')){
      $filter = request::getInstance()->getPost('filter');
      //validar
      if(isset($filter['nombre']) and $filter['nombre'] !== null and $filter['nombre'] !== ""){
        $where[credencialTableClass::NOMBRE] = $filter['nombre'];
      }//cierre del filtro nombre
       if((isset($filter['fechaIni']) and $filter['fechaIni'] !== null and $filter['fechaIni'] !== "") and (isset($filter['fechaFin']) and $filter['fechaFin'] !== null and $filter['fechaFin'] !== "" )){
        $where[credencialTableClass::CREATED_AT] = array(
           date(config::getFormatTimestamp(), strtotime($filter['fechaIni'].' 00:00:00')),
           date(config::getFormatTimestamp(), strtotime($filter['fechaFin'].' 23:59:59'))
            );
      }//cierre del filtro fecha1 y fecha2     
      }//cierre del POST del reporte
      $fields = array(
          credencialTableClass::ID,
          credencialTableClass::NOMBRE,
		  credencialTableClass::CREATED_AT,
          credencialTableClass::UPDATED_AT
      );
      $orderBy = array(
         credencialTableClass::ID
      );
     $this->objCredencial = credencialTableClass::getAll($fields, true, $orderBy, 'ASC',null, null,$where);
      
       
       

      
      
      $this->defineView('index', 'credencial', session::getInstance()->getFormatOutput());
    }//cierre del try 
      catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo '<pre>';
      print_r($exc->getTrace());
      echo '</pre>';
    }//cierre del catch
  }//cierre de la funcion execute

}//cierre de la clase
