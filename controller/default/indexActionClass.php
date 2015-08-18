<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\defaultValidatorClass as validator;
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
      if(request::getInstance()->hasPost('filter')){
      $filter = request::getInstance()->getPost('filter');
      //validar
      
      if ((isset($filter[usuarioTableClass::getNameField(usuarioTableClass::CREATED_AT, true) . '_1']) and empty($filter[usuarioTableClass::getNameField(usuarioTableClass::CREATED_AT, true) . '_1']) === false) and ( isset($filter[usuarioTableClass::getNameField(usuarioTableClass::CREATED_AT, true) . '_2']) and empty($filter[usuarioTableClass::getNameField(usuarioTableClass::CREATED_AT, true) . '_2']) === false)) {
          if (request::getInstance()->isMethod('POST')) {

            $fechaInicial = $filter[usuarioTableClass::getNameField(usuarioTableClass::CREATED_AT, true) . '_1'];
            $fechaFin = $filter[usuarioTableClass::getNameField(usuarioTableClass::CREATED_AT, true) . '_2'];

            validator::validateFiltroFecha($fechaInicial, $fechaFin);

            if ((isset($fechaInicial) and $fechaInicial !== null and $fechaInicial !== "") and ( isset($fechaFin) and $fechaFin !== null and $fechaFin !== "" )) {
              $where[] = '(' . usuarioTableClass::getNameField(usuarioTableClass::CREATED_AT) . ' BETWEEN ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaInicial . ' 00:00:00')) . "'" . ' AND ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaFin . ' 23:59:59')) . "'" . ' ) ';
            }
          }
        }
        
        if (isset($filter[usuarioTableClass::getNameField(usuarioTableClass::USUARIO, true)]) and empty($filter[usuarioTableClass::getNameField(usuarioTableClass::USUARIO, true)]) === false) {
          if (request::getInstance()->isMethod('POST')) {

            $usuario = $filter[usuarioTableClass::getNameField(usuarioTableClass::USUARIO, true)];

          validator::validateFiltro($usuario);
            if(isset($usuario) and $usuario !== null and $usuario !== ""){
          $where[] = '(' . usuarioTableClass::getNameField(usuarioTableClass::USUARIO) . ' LIKE ' . '\'' . $usuario . '%\'  '
              . 'OR ' . usuarioTableClass::getNameField(usuarioTableClass::USUARIO) . ' LIKE ' . '\'%' . $usuario . '%\' '
              . 'OR ' . usuarioTableClass::getNameField(usuarioTableClass::USUARIO) . ' LIKE ' . '\'%' . $usuario .'\') ';       
              }
          }
        }
      
     
       
//    session::getInstance()->setAttribute('defaultIndexFilters', $where);
//       }else if(session::getInstance()->hasAttribute('defaultIndexFilters')){
//        $where = session::getInstance()->getAttribute('defaultIndexFilters');
//    
        }
      $fields = array(
          usuarioTableClass::ID,
          usuarioTableClass::USUARIO,
          usuarioTableClass::NOMBRE_IMAGEN,
          usuarioTableClass::HASH_IMAGEN,
          usuarioTableClass::EXTENCION_IMAGEN,
          usuarioTableClass::PASSWORD,
          usuarioTableClass::CREATED_AT,
          usuarioTableClass::ACTIVED
      );
      $orderBy = array(
         usuarioTableClass::ID
      );
      $page = 0;
      if (request::getInstance()->hasGet('page')) {
        $this->page = request::getInstance()->getGet('page');
        $page = request::getInstance()->getGet('page') - 1;
        $page = $page * config::getRowGrid();
      }//cierre de paginado
      $this->cntPages = usuarioTableClass::getTotalPages(config::getRowGrid(), $where);
      
      $this->objUsuarios = usuarioTableClass::getAll($fields, true, $orderBy, 'ASC',config::getRowGrid(), $page,$where);
//      $this->objUsuarios = usuarioTableClass::getAll($fields, true);
      $this->defineView('index', 'default', session::getInstance()->getFormatOutput());
    } //cierre del try
     catch (PDOException $exc) {
         routing::getInstance()->redirect('default', 'index');
//      echo $exc->getMessage();
//      echo '<br>';
//      echo $exc->getTraceAsString();
     }//cierre del catch
}//cierre de la funcion execute

}//cierre de la clase
