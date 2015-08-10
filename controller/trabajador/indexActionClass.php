<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\trabajadorValidatorClass as validator;

/**
 * Description of ejemploClass
 *
 * @author 
 */
class indexActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {

      $where = null;
      if (request::getInstance()->hasPost('filter')) {
        $filter = request::getInstance()->getPost('filter');
        //Validar datos

        if (request::getInstance()->hasPost(trabajadorTableClass::getNameField(trabajadorTableClass::DOCUMENTO, true)) and empty(mvc\request\requestClass::getInstance()->getPost(trabajadorTableClass::getNameField(trabajadorTableClass::DOCUMENTO, true))) === false) {

          if (request::getInstance()->isMethod('POST')) {
            $documento = request::getInstance()->getPost(trabajadorTableClass::getNameField(trabajadorTableClass::DOCUMENTO, true));
            validator::validateFiltro();
            if (isset($documento) and $documento !== null and $documento !== '') {
              $where[trabajadorTableClass::DOCUMENTO] = $documento;
            }//cierre del filtro usuario
          }//cierre del filtro ubicacion   
        }
        
        if (request::getInstance()->hasPost(trabajadorTableClass::getNameField(trabajadorTableClass::NOMBRET, true)) and empty(mvc\request\requestClass::getInstance()->getPost(trabajadorTableClass::getNameField(trabajadorTableClass::NOMBRET, true))) === false) {

          if (request::getInstance()->isMethod('POST')) {
            $nombre = request::getInstance()->getPost(trabajadorTableClass::getNameField(trabajadorTableClass::NOMBRET, true));
            validator::validateFiltroNombre();
            if (isset($nombre) and $nombre !== null and $nombre !== '') {
          $where[] = '(' . trabajadorTableClass::getNameField(trabajadorTableClass::NOMBRET) . ' LIKE ' . '\'' . $nombre . '%\'  '
                  . 'OR ' . trabajadorTableClass::getNameField(trabajadorTableClass::NOMBRET) . ' LIKE ' . '\'%' . $nombre . '%\' '
                  . 'OR ' . trabajadorTableClass::getNameField(trabajadorTableClass::NOMBRET) . ' LIKE ' . '\'%' . $nombre . '\') ';
        }//cierre del filtro usuario
          }//cierre del filtro ubicacion   
        }
        
        if (request::getInstance()->hasPost(trabajadorTableClass::getNameField(trabajadorTableClass::APELLIDO, true)) and empty(mvc\request\requestClass::getInstance()->getPost(trabajadorTableClass::getNameField(trabajadorTableClass::APELLIDO, true))) === false) {

          if (request::getInstance()->isMethod('POST')) {
            $apellido = request::getInstance()->getPost(trabajadorTableClass::getNameField(trabajadorTableClass::APELLIDO, true));
            validator::validateFiltroApellido();
            if (isset($apellido) and $apellido !== null and $apellido !== '') {
          $where[] = '(' . trabajadorTableClass::getNameField(trabajadorTableClass::APELLIDO) . ' LIKE ' . '\'' . $apellido . '%\'  '
                  . 'OR ' . trabajadorTableClass::getNameField(trabajadorTableClass::APELLIDO) . ' LIKE ' . '\'%' . $apellido . '%\' '
                  . 'OR ' . trabajadorTableClass::getNameField(trabajadorTableClass::APELLIDO) . ' LIKE ' . '\'%' . $apellido . '\') ';
        }
          }//cierre del filtro ubicacion   
        }

        if (isset($filter['ciudad']) and $filter['ciudad'] !== null and $filter['ciudad'] !== '') {
          $where[trabajadorTableClass::ID_CIUDAD] = $filter['ciudad'];
        }

        if (request::getInstance()->isMethod('POST')) {
//            echo 'dsasda';
//            exit();
            $fechaInicial = request::getInstance()->getPost(trabajadorTableClass::getNameField(trabajadorTableClass::CREATED_AT, true). '_1');
            
            $fechaFin = request::getInstance()->getPost(trabajadorTableClass::getNameField(trabajadorTableClass::CREATED_AT, true). '_2');
            
            if($fechaFin < $fechaInicial){
               session::getInstance()->setError('La fecha final no puede ser menor a la actual', 'inputFecha');
            }elseif($fechaFin == $fechaInicial){
                session::getInstance()->setError('La fecha final es igual a la inicial', 'inputFecha');
            }
            
        if ((isset($fechaInicial) and $fechaInicial !== null and $fechaInicial !== "") and ( isset($fechaFin) and $fechaFin !== null and $fechaFin !== "" )) {
          $where[trabajadorTableClass::CREATED_AT] = array(
              date(config::getFormatTimestamp(), strtotime($fechaInicial . ' 00:00:00')),
              date(config::getFormatTimestamp(), strtotime($fechaFin . ' 23:59:59'))
          );
        }
            
          }
//      session::getInstance()->setAttribute('trabajadorIndexFilters', $where);
//       }else if(session::getInstance()->hasAttribute('trabajadorIndexFilters')){
//        $where = session::getInstance()->getAttribute('trabajadorIndexFilters');
//     
        
       }

      $fields = array(
          trabajadorTableClass::ID,
          trabajadorTableClass::DOCUMENTO,
          trabajadorTableClass::NOMBRET,
          trabajadorTableClass::APELLIDO,
          trabajadorTableClass::DIRECCION,
          trabajadorTableClass::TELEFONO,
          trabajadorTableClass::EMAIL,
          trabajadorTableClass::ID_TIPO_ID,
          trabajadorTableClass::ID_CIUDAD,
          trabajadorTableClass::ID_CREDENCIAL,
          trabajadorTableClass::CREATED_AT,
          trabajadorTableClass::UPDATED_AT
      );
      $orderBy = array(
          trabajadorTableClass::NOMBRET
      );
        $page = 0;
      if (request::getInstance()->hasGet('page')) {
        $this->page = request::getInstance()->getGet('page');
        $page = request::getInstance()->getGet('page') - 1;
        $page = $page * config::getRowGrid();
      }

      $this->cntPages = trabajadorTableClass::getTotalPages(config::getRowGrid(), $where);

      $this->objTrabajador = trabajadorTableClass::getAll($fields, true, $orderBy, 'ASC', config::getRowGrid(), $page, $where);
      $fields = array(
          ciudadTableClass::ID,
          ciudadTableClass::NOMBRE_CIUDAD
      );
      $orderBy = array(
          ciudadTableClass::NOMBRE_CIUDAD
      );
      $this->objCC = ciudadTableClass::getAll($fields, false, $orderBy, 'ASC');
//      $this->objUsuarios = trabajadorTableClass::getAll($fields, true);
      $this->defineView('index', 'trabajador', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
       routing::getInstance()->redirect('trabajador', 'index');
//      echo $exc->getMessage();
//      echo '<br>';
//      echo $exc->getTraceAsString();
    }
  }

}
