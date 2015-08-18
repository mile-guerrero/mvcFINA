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
 * @category: modulo de defautl.
 */
class indexActionClass extends controllerClass implements controllerActionInterface {

  
   /**
* @author: Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon .
* @date: fecha de inicio del desarrollo.
* @return   usuarioTableClass::ID retorna (integer),
            usuarioTableClass::USUARIO retorna  (string),
            usuarioTableClass::CREATED_AT retorna  (timestamp),
            usuarioTableClass::PASSWORD retorna  (timestamp),
            usuarioTableClass::ACTIVED retorna  (integer),
 * estos datos retornan en la variable $fields
*/
  public function execute() {
    try {
      $where = null;

        
      $fields = array(
          reporteTableClass::ID,
          reporteTableClass::NOMBRE,
          reporteTableClass::DESCRIPCION,
          reporteTableClass::DIRECCION,
      );
      $orderBy = array(
         reporteTableClass::ID
      );
     $page = 0;
      if (request::getInstance()->hasGet('page')) {
        $this->page = request::getInstance()->getGet('page');
        $page = request::getInstance()->getGet('page') - 1;
        $page = $page * config::getRowGrid();
      }
      $this->cntPages = reporteTableClass::getTotalPages(config::getRowGrid());
      
      $this->objReportes = reporteTableClass::getAll($fields, false, $orderBy, 'ASC',config::getRowGrid(), $page,$where);

      $this->defineView('index', 'reportes', session::getInstance()->getFormatOutput());
    } //cierre del try
     catch (PDOException $exc) {
         routing::getInstance()->redirect('reportes', 'index');
//      echo $exc->getMessage();
//      echo '<br>';
//      echo $exc->getTraceAsString();
     }//cierre del catch
}//cierre de la funcion execute

}//cierre de la clase
