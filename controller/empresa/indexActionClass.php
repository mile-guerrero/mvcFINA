<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\empresaValidatorClass as validator;

/**
 * Description of ejemploClass
 *
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
 */
class indexActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {

      $where = null;
      if (request::getInstance()->hasPost('filter')) {
        $filter = request::getInstance()->getPost('filter');
        //Validar datos
        if (request::getInstance()->hasPost(empresaTableClass::getNameField(empresaTableClass::NOMBRE, true)) and empty(mvc\request\requestClass::getInstance()->getPost(empresaTableClass::getNameField(empresaTableClass::NOMBRE, true))) === false) {

          if (request::getInstance()->isMethod('POST')) {
            $nombre = request::getInstance()->getPost(empresaTableClass::getNameField(empresaTableClass::NOMBRE, true));

            validator::validateFiltro();

            if (isset($nombre) and $nombre !== null and $nombre !== '') {
              $where[] = '(' . empresaTableClass::getNameField(empresaTableClass::NOMBRE) . ' LIKE ' . '\'' . $nombre . '%\'  '
                      . 'OR ' . empresaTableClass::getNameField(empresaTableClass::NOMBRE) . ' LIKE ' . '\'%' . $nombre . '%\' '
                      . 'OR ' . empresaTableClass::getNameField(empresaTableClass::NOMBRE) . ' LIKE ' . '\'%' . $nombre . '\') ';
            }//cierre del filtro nombre
          }//cierre del filtro documento
        }//cierre del filtro ubicacion   
       if (request::getInstance()->hasPost(empresaTableClass::getNameField(empresaTableClass::DIRECCION, true)) and empty(mvc\request\requestClass::getInstance()->getPost(empresaTableClass::getNameField(empresaTableClass::DIRECCION, true))) === false) {
        if (request::getInstance()->isMethod('POST')) {
          $direccion = request::getInstance()->getPost(empresaTableClass::getNameField(empresaTableClass::DIRECCION, true));
          validator::validateFiltroDireccion();
          if (isset($direccion) and $direccion !== null and $direccion !== '') {
            $where[] = '(' . empresaTableClass::getNameField(empresaTableClass::DIRECCION) . ' LIKE ' . '\'' . $direccion . '%\'  '
                    . 'OR ' . empresaTableClass::getNameField(empresaTableClass::DIRECCION) . ' LIKE ' . '\'%' . $direccion . '%\' '
                    . 'OR ' . empresaTableClass::getNameField(empresaTableClass::DIRECCION) . ' LIKE ' . '\'%' . $direccion . '\') ';
          }//cierre del filtro nombre
        }//cierre del filtro documento
         }



        if (isset($filter['fechaIni']) and $filter['fechaIni'] !== null and $filter['fechaIni'] !== '' and ( isset($filter['fechaFin']) and $filter['fechaFin'] !== null and $filter['fechaFin'] !== '')) {
          $where[empresaTableClass::CREATED_AT] = array(
              date(config::getFormatTimestamp(), strtotime($filter['fechaIni'] . ' 00:00:00')),
              date(config::getFormatTimestamp(), strtotime($filter['fechaFin'] . ' 23:59:59'))
          );
        }
//       session::getInstance()->setAttribute('empresaIndexFilters', $where);
//       }else if(session::getInstance()->hasAttribute('empresaIndexFilters')){
//        $where = session::getInstance()->getAttribute('empresaIndexFilters');
//    
        }


      $fields = array(
          empresaTableClass::ID,
          empresaTableClass::NOMBRE,
          empresaTableClass::DIRECCION,
          empresaTableClass::TELEFONO,
          empresaTableClass::EMAIL,
      );
      $orderBy = array(
          empresaTableClass::ID
      );
     $page = 0;
      if (request::getInstance()->hasGet('page')) {
        $this->page = request::getInstance()->getGet('page');
        $page = request::getInstance()->getGet('page') - 1;
        $page = $page * config::getRowGrid();
      }
      $this->cntPages = empresaTableClass::getTotalPages(config::getRowGrid(), $where);
      $this->objEmpresa = empresaTableClass::getAll($fields, true, $orderBy, 'ASC', config::getRowGrid(), $page, $where);


      $this->defineView('index', 'empresa', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      routing::getInstance()->redirect('empresa', 'index');
//      echo $exc->getMessage();
//      echo '<br>';
//      echo $exc->getTraceAsString();
    }
  }

}
