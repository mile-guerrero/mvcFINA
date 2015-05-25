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
 */
class indexActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      $where = null;
      if(request::getInstance()->hasPost('filter')){
      $filter = request::getInstance()->getPost('filter');
      //validar
      if(isset($filter['usuario']) and $filter['usuario'] !== null and $filter['usuario'] !== ""){
        $where[usuarioCredencialTableClass::USUARIO_ID] = $filter['usuario'];
      }
      if(isset($filter['credencial']) and $filter['credencial'] !== null and $filter['credencial'] !== ""){
        $where[usuarioCredencialTableClass::CREDENCIAL_ID] = $filter['credencial'];
      }
      if((isset($filter['fechaIni']) and $filter['fechaIni'] !== null and $filter['fechaIni'] !== "") and (isset($filter['fechaFin']) and $filter['fechaFin'] !== null and $filter['fechaFin'] !== "" )){
        $where[usuarioCredencialTableClass::CREATED_AT] = array(
           date(config::getFormatTimestamp(), strtotime($filter['fechaIni'].' 00:00:00')),
           date(config::getFormatTimestamp(), strtotime($filter['fechaFin'].' 23:59:59'))
            );
      } 
      }
      
      $fields = array(
          usuarioCredencialTableClass::ID,
            usuarioCredencialTableClass::USUARIO_ID,          
            usuarioCredencialTableClass::CREDENCIAL_ID,
          usuarioCredencialTableClass::CREATED_AT        
      );
      $orderBy = array(
         usuarioCredencialTableClass::ID
      );
      $page = 0;
      if (request::getInstance()->hasGet('page')) {
        $this->page = request::getInstance()->getGet('page');
        $page = request::getInstance()->getGet('page') - 1;
        $page = $page * config::getRowGrid();
      }
      $this->cntPages = usuarioCredencialTableClass::getTotalPages(config::getRowGrid());
      
      $this->objUC = usuarioCredencialTableClass::getAll($fields, false, $orderBy, 'ASC',config::getRowGrid(), $page,$where);
     
      $fields = array(     
      usuarioTableClass::ID, 
      usuarioTableClass::USUARIO
      );
      $orderBy = array(
      usuarioTableClass::USUARIO    
      ); 
      $this->objUCU = usuarioTableClass::getAll($fields, true, $orderBy, 'ASC');
      
      $fields = array(     
      credencialTableClass::ID, 
      credencialTableClass::NOMBRE
      );
      $orderBy = array(
      credencialTableClass::NOMBRE    
      ); 
      $this->objUCC = credencialTableClass::getAll($fields, true, $orderBy, 'ASC');
      
      
      $this->defineView('index', 'usuarioCredencial', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
}

}
