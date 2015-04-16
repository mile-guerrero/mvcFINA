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
        $id = request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::ID, true));
        $nombre = request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::NOMBREP, true));
        $apellido = request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::APELLIDO, true));
        $documento = request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::DOCUMENTO, true));
        $direccion = request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::DIRECCION, true));
        $telefono = request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::TELEFONO, true));
        $email = request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::EMAIL, true));
        $id_ciudad = request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::ID_CIUDAD, true));

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
            proveedorTableClass::ID_CIUDAD => $id_ciudad
        );

        proveedorTableClass::update($ids, $data);
      }
      routing::getInstance()->redirect('maquina', 'indexProveedor');

    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}
