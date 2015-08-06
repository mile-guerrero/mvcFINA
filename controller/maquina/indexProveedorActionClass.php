<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\proveedorValidatorClass as validator;

/**
 * Description of ejemploClass
 *
 * @author 
 */
class indexProveedorActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      
       $where = null;
      if (request::getInstance()->hasPost('filter')) {
        $filter = request::getInstance()->getPost('filter');
        //Validar datos
if (request::getInstance()->hasPost(proveedorTableClass::getNameField(proveedorTableClass::DOCUMENTO, true)) and empty(mvc\request\requestClass::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::DOCUMENTO, true))) === false) {

          if (request::getInstance()->isMethod('POST')) {
            $documento = request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::DOCUMENTO, true));
            validator::validateFiltro();

            if (isset($documento) and $documento !== null and $documento !== '') {
              $where[proveedorTableClass::DOCUMENTO] = $documento;
            }//cierre del filtro documento
          }//cierre del filtro ubicacion   
        }
        
        if (request::getInstance()->hasPost(proveedorTableClass::getNameField(proveedorTableClass::NOMBREP, true)) and empty(mvc\request\requestClass::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::NOMBREP, true))) === false) {

          if (request::getInstance()->isMethod('POST')) {
            $nombre = request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::NOMBREP, true));
            validator::validateFiltroNombre();
            if (isset($nombre) and $nombre !== null and $nombre !== '') {
              $where[] = '(' . proveedorTableClass::getNameField(proveedorTableClass::NOMBREP) . ' LIKE ' . '\'' . $nombre . '%\'  '
                      . 'OR ' . proveedorTableClass::getNameField(proveedorTableClass::NOMBREP) . ' LIKE ' . '\'%' . $nombre . '%\' '
                      . 'OR ' . proveedorTableClass::getNameField(proveedorTableClass::NOMBREP) . ' LIKE ' . '\'%' . $nombre . '\') ';
            }//cierre del filtro nombre
          }//cierre del filtro ubicacion   
        }

        if (request::getInstance()->hasPost(proveedorTableClass::getNameField(proveedorTableClass::APELLIDO, true)) and empty(mvc\request\requestClass::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::APELLIDO, true))) === false) {

          if (request::getInstance()->isMethod('POST')) {
            $apellido = request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::APELLIDO, true));
            validator::validateFiltroApellido();
            if (isset($apellido) and $apellido !== null and $apellido !== '') {
              $where[] = '(' . proveedorTableClass::getNameField(proveedorTableClass::APELLIDO) . ' LIKE ' . '\'' . $apellido . '%\'  '
                      . 'OR ' . proveedorTableClass::getNameField(proveedorTableClass::APELLIDO) . ' LIKE ' . '\'%' . $apellido . '%\' '
                      . 'OR ' . proveedorTableClass::getNameField(proveedorTableClass::APELLIDO) . ' LIKE ' . '\'%' . $apellido . '\') ';
            }//cierre del filtro apellio   
          }//cierre del filtro ubicacion   
        }

        
        
        if (isset($filter['ciudad']) and $filter['ciudad'] !== null and $filter['ciudad'] !== '') {
          $where[proveedorTableClass::ID_CIUDAD] = $filter['ciudad'];
        }
        if (isset($filter['fecha1']) and $filter['fecha1'] !== null and $filter['fecha1'] !== '' and (isset($filter['fecha2']) and $filter['fecha2'] !== null and $filter['fecha2'] !== '')) {
          $where[proveedorTableClass::CREATED_AT] = array(
          date(config::getFormatTimestamp(), strtotime($filter['fecha1'] . ' 00:00:00')),
          date(config::getFormatTimestamp(), strtotime($filter['fecha2'] . ' 23:59:59'))
          );
        }
//      session::getInstance()->setAttribute('proveedorIndexFilters', $where);
//       }else if(session::getInstance()->hasAttribute('proveedorIndexFilters')){
//        $where = session::getInstance()->getAttribute('proveedorIndexFilters');
//     
//        
       }
      $fields = array(
          proveedorTableClass::ID,
          proveedorTableClass::NOMBREP,
          proveedorTableClass::APELLIDO,
          proveedorTableClass::DIRECCION,
          proveedorTableClass::DOCUMENTO,
          proveedorTableClass::TELEFONO,
          proveedorTableClass::EMAIL,
          proveedorTableClass::ID_CIUDAD
          
      );
      $orderBy = array(
          proveedorTableClass::NOMBREP
      );
      
      $page = 0;
      if (request::getInstance()->hasGet('page')) {
        $this->page = request::getInstance()->getGet('page');
        $page = request::getInstance()->getGet('page') - 1;
        $page = $page * config::getRowGrid();
      }

      $this->cntPages = proveedorTableClass::getTotalPages(config::getRowGrid(), $where);
      
      $this->objProveedor = proveedorTableClass::getAll($fields, true, $orderBy, 'ASC', config::getRowGrid(), $page, $where);
      
      $fields = array(     
      ciudadTableClass::ID, 
      ciudadTableClass::NOMBRE_CIUDAD
      );
      $orderBy = array(
      ciudadTableClass::NOMBRE_CIUDAD    
      ); 
      $this->objCC = ciudadTableClass::getAll($fields, false, $orderBy, 'ASC');
      $this->defineView('indexProveedor', 'maquina', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
       routing::getInstance()->redirect('maquina', 'indexProveedor');
//      echo $exc->getMessage();
//      echo '<br>';
//      echo $exc->getTraceAsString();
    }


    //$this->defineView('ejemplo', 'default', session::getInstance()->getFormatOutput());
  }

}
