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
class updateProveedorActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {
        $id = trim(request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::ID, true)));
        $nombre = trim(request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::NOMBREP, true)));
        $apellido = trim(request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::APELLIDO, true)));
        $documento = trim(request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::DOCUMENTO, true)));
        $direccion = trim(request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::DIRECCION, true)));
        $telefono = trim(request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::TELEFONO, true)));
        $email = trim(request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::EMAIL, true)));
        $idCiudad = trim(request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::ID_CIUDAD, true)));


        $this->validate($nombre, $apellido, $direccion, $telefono, $email, $idCiudad);
        
        $ids = array(
            proveedorTableClass::ID => $id
        );

        $data = array(
            proveedorTableClass::NOMBREP => $nombre,
            proveedorTableClass::APELLIDO => $apellido,
            proveedorTableClass::DOCUMENTO => $documento,
            proveedorTableClass::DIRECCION => $direccion,
            proveedorTableClass::TELEFONO => $telefono,
            proveedorTableClass::EMAIL => $email,
            proveedorTableClass::ID_CIUDAD => $idCiudad
        );

        proveedorTableClass::update($ids, $data);
      }
      session::getInstance()->setSuccess('La Actualizacion fue Exitoso');
      routing::getInstance()->redirect('maquina', 'indexProveedor');
    } catch (PDOException $exc) {
      routing::getInstance()->redirect('maquina', 'editProveedor');
      session::getInstance()->setFlash('exc', $exc);
    }
  }

  public function validate($nombre, $apellido, $direccion, $telefono, $email, $idCiudad) {
    if (strlen($nombre) > proveedorTableClass::NOMBREP_LENGTH) {
      session::getInstance()->setError(i18n::__(00001, null, 'errors', array(':longitud' => proveedorTableClass::NOMBREP_LENGTH)), 00001);
      session::getInstance()->setFlash(proveedorTableClass::getNameField(proveedorTableClass::NOMBREP_LENGTH, true), true);
    }

    if (!preg_match("/^[a-z]+$/i", $nombre)) {
      session::getInstance()->setError(i18n::__(00012, null, 'errors', array(':letras' => $nombre)), 00012);
      $flag = true;
      session::getInstance()->setFlash(proveedorTableClass::getNameField(proveedorTableClass::NOMBREP, true), true);
    }

    if (strlen($nombre) == "") {
      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => proveedorTableClass::NOMBREP)), 00009);
      $flag = true;
      session::getInstance()->setFlash(proveedorTableClass::getNameField(proveedorTableClass::NOMBREP, true), true);
    }

    if (strlen($apellido) > proveedorTableClass::APELLIDO_LENGTH) {
      session::getInstance()->setError(i18n::__(00002, null, 'errors', array(':longitud' => proveedorTableClass::APELLIDO_LENGTH)), 00002);
      $flag = true;
      session::getInstance()->setFlash(proveedorTableClass::getNameField(proveedorTableClass::APELLIDO, true), true);
    }

    if (!preg_match("/^[a-z]+$/i", $apellido)) {
      session::getInstance()->setError(i18n::__(00012, null, 'errors', array(':letras' => $apellido)), 00012);
      $flag = true;
      session::getInstance()->setFlash(proveedorTableClass::getNameField(proveedorTableClass::APELLIDO, true), true);
    }

    if (!is_numeric($telefono) === "" or $telefono === null) {
      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => proveedorTableClass::TELEFONO)), 00009);
    }

    if (!is_numeric($telefono)) {
      session::getInstance()->setError(i18n::__(00010, null, 'errors', array(':numeros' => $telefono)), 00010);
      $flag = true;
      session::getInstance()->setFlash(proveedorTableClass::getNameField(proveedorTableClass::TELEFONO, true), true);
    }

    if (!eregi("^([a-zA-Z0-9._]+)@([a-zA-Z0-9.-]+).([a-zA-Z]{2,4})$", $email)) {
      session::getInstance()->setError(i18n::__(00011, null, 'errors', array(':correo' => $email), 00011));
      $flag = true;
      session::getInstance()->setFlash(proveedorTableClass::getNameField(proveedorTableClass::EMAIL, true), true);
    }

    if ($flag === true) {
      request::getInstance()->setMethod('GET');
      routing::getInstance()->forward('maquina', 'editProveedor');
    }
  }

}
