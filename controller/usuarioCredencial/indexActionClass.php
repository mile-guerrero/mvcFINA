<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\usuarioCredencialValidatorClass as validator;

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
        //validar

        if ((isset($filter[usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::CREATED_AT, true) . '_1']) and empty($filter[usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::CREATED_AT, true) . '_1']) === false) and ( isset($filter[usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::CREATED_AT, true) . '_2']) and empty($filter[usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::CREATED_AT, true) . '_2']) === false)) {
          if (request::getInstance()->isMethod('POST')) {

            $fechaInicial = $filter[usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::CREATED_AT, true) . '_1'];
            $fechaFin = $filter[usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::CREATED_AT, true) . '_2'];

            validator::validateFiltroFecha($fechaInicial, $fechaFin);

            if ((isset($fechaInicial) and $fechaInicial !== null and $fechaInicial !== "") and ( isset($fechaFin) and $fechaFin !== null and $fechaFin !== "" )) {
              $where[] = '(' . usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::CREATED_AT) . ' BETWEEN ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaInicial . ' 00:00:00')) . "'" . ' AND ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaFin . ' 23:59:59')) . "'" . ' ) ';
            }
          }
        }


        if (isset($filter[usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::USUARIO_ID, true)]) and empty($filter[usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::USUARIO_ID, true)]) === false) {
          if (request::getInstance()->isMethod('POST')) {

            $usuario = $filter[usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::USUARIO_ID, true)];

            if (isset($usuario) and $usuario !== null and $usuario !== "") {
              $where[] = '(' . usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::USUARIO_ID) . ' = ' . $usuario . ' ) ';
            }
          }
        }

 if (isset($filter[usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::CREDENCIAL_ID, true)]) and empty($filter[usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::CREDENCIAL_ID, true)]) === false) {
          if (request::getInstance()->isMethod('POST')) {

            $credencial = $filter[usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::CREDENCIAL_ID, true)];

            if (isset($credencial) and $credencial !== null and $credencial !== "") {
              $where[] = '(' . usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::CREDENCIAL_ID) . ' = ' . $credencial . ' ) ';
            }
          }
        }


        

//      session::getInstance()->setAttribute('usuarioCredencialIndexFilters', $where);
//       }else if(session::getInstance()->hasAttribute('usuarioCredencialIndexFilters')){
//        $where = session::getInstance()->getAttribute('usuarioCredencialIndexFilters');
//     
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
      $this->cntPages = usuarioCredencialTableClass::getTotalPages(config::getRowGrid(), $where);


      $this->objUC = usuarioCredencialTableClass::getAll($fields, false, $orderBy, 'ASC', config::getRowGrid(), $page, $where);

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
      routing::getInstance()->redirect('usuarioCredencial', 'index');
//      echo $exc->getMessage();
//      echo '<br>';
//      echo $exc->getTraceAsString();
    }
  }

}
