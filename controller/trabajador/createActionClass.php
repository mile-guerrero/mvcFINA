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
 * @author Andres Eduardo Bahamon, Elcy Milena Gerrero, Gonzalo Andres Bejarano
 */
class createActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        
        $documento = request::getInstance()->getPost(trabajadorTableClass::getNameField(trabajadorTableClass::DOCUMENTO, true));
        $nombre = request::getInstance()->getPost(trabajadorTableClass::getNameField(trabajadorTableClass::NOMBRET, true));
        $apellido = request::getInstance()->getPost(trabajadorTableClass::getNameField(trabajadorTableClass::APELLIDO, true));
        $direccion = request::getInstance()->getPost(trabajadorTableClass::getNameField(trabajadorTableClass::DIRECCION, true));
        $telefono = request::getInstance()->getPost(trabajadorTableClass::getNameField(trabajadorTableClass::TELEFONO, true));
        $email = request::getInstance()->getPost(trabajadorTableClass::getNameField(trabajadorTableClass::EMAIL, true));
        $idTipo = request::getInstance()->getPost(trabajadorTableClass::getNameField(trabajadorTableClass::ID_TIPO_ID, true));
        $idCiudad = request::getInstance()->getPost(trabajadorTableClass::getNameField(trabajadorTableClass::ID_CIUDAD, true));
        $idCredencial = request::getInstance()->getPost(trabajadorTableClass::getNameField(trabajadorTableClass::ID_CREDENCIAL, true));

//        if (strlen($nombre) > clienteTableClass::NOMBRE_LENGTH) {
//          throw new PDOException(i18n::__(00001, null, 'errors', array(':longitud' => clienteTableClass::NOMBRE_LENGTH)), 00001);
//        }

        $data = array(
            trabajadorTableClass::DOCUMENTO => $documento,
            trabajadorTableClass::NOMBRET => $nombre,
            trabajadorTableClass::APELLIDO => $apellido,
            trabajadorTableClass::DIRECCION => $direccion,
            trabajadorTableClass::TELEFONO => $telefono,
            trabajadorTableClass::EMAIL => $email,
            trabajadorTableClass::ID_TIPO_ID => $idTipo,
            trabajadorTableClass::ID_CIUDAD => $idCiudad,
            trabajadorTableClass::ID_CREDENCIAL => $idCredencial
        );
        trabajadorTableClass::insert($data);
        session::getInstance()->setSuccess('El registro fue Exitoso');
        routing::getInstance()->redirect('trabajador', 'index');
      } else {
        routing::getInstance()->redirect('trabajador', 'index');
      }
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}
