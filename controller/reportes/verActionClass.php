<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
//use mvc\validator\defaultValidatorClass as validator;
use hook\log\logHookClass as log;

/**
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon 
 * @date: fecha de inicio del desarrollo.
 * @category: modulo de defautl.
 */
class createActionClass extends controllerClass implements controllerActionInterface {

 
  /**
   * @author: Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon .
   * @date: fecha de inicio del desarrollo.
   * @return   usuarioTableClass::USUARIO retorna $usuario (string),
               usuarioTableClass::PASSWORD retorna $usuario (string),
   * estos datos retornan en la variable $data
   */
  public function execute() {
    try {

     $where= null;
       if (isset($filter[reporteTableClass::getNameField(reporteTableClass::NOMBRE, true)]) and empty($filter[reporteTableClass::getNameField(reporteTableClass::NOMBRE, true)]) === false) {
          if (request::getInstance()->isMethod('POST')) {

            $nombre = $filter[reporteTableClass::getNameField(reporteTableClass::NOMBRE, true)];
             validator::validateFiltroNombre($nombre);
            if (isset($nombre) and $nombre !== null and $nombre !== '') {
          $where[] = '(' . reporteTableClass::getNameField(reporteTableClass::NOMBRE) . ' LIKE ' . '\'' . $nombre . '%\'  '
                  . 'OR ' . reporteTableClass::getNameField(reporteTableClass::NOMBRE) . ' LIKE ' . '\'%' . $nombre . '%\' '
                  . 'OR ' . reporteTableClass::getNameField(reporteTableClass::NOMBRE) . ' LIKE ' . '\'%' . $nombre . '\') ';
            }
          }
        }
        
         $fields = array(
          reporteTableClass::ID,
          reporteTableClass::NOMBRE,
          reporteTableClass::DESCRIPCION,
          reporteTableClass::DIRECCION,
      );
      $orderBy = array(
         reporteTableClass::ID
      );
     
      
      $this->objReportes = reporteTableClass::getAll($fields, false, $orderBy, 'ASC',null, null,$where);
      $this->defineView('index', 'reportes', session::getInstance()->getFormatOutput());
    
        }catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }//cierre del catch
}//cierre de la funcion execute

}

