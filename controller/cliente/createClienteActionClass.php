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
class createClienteActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $nombre = trim(request::getInstance()->getPost(clienteTableClass::getNameField(clienteTableClass::NOMBRE, true)));
        $apellido = trim(request::getInstance()->getPost(clienteTableClass::getNameField(clienteTableClass::APELLIDO, true)));
        $direccion = trim(request::getInstance()->getPost(clienteTableClass::getNameField(clienteTableClass::DIRECCION, true)));
        $telefono = trim(request::getInstance()->getPost(clienteTableClass::getNameField(clienteTableClass::TELEFONO, true)));
        $idTipo = trim(request::getInstance()->getPost(clienteTableClass::getNameField(clienteTableClass::ID_TIPO_ID, true)));
        $idCiudad = trim(request::getInstance()->getPost(clienteTableClass::getNameField(clienteTableClass::ID_CIUDAD, true)));

        $this->validate($nombre, $apellido, $direccion, $telefono, $idTipo, $idCiudad);

        $data = array(
            clienteTableClass::NOMBRE => $nombre,
            clienteTableClass::APELLIDO => $apellido,
            clienteTableClass::DIRECCION => $direccion,
            clienteTableClass::TELEFONO => $telefono,
            clienteTableClass::ID_TIPO_ID => $idTipo,
            clienteTableClass::ID_CIUDAD => $idCiudad,
        );
        clienteTableClass::insert($data);
        session::getInstance()->setSuccess('El registro fue exitoso');
        routing::getInstance()->redirect('cliente', 'indexCliente');
      } else {
        routing::getInstance()->redirect('cliente', 'indexCliente');
      }
    } catch (PDOException $exc) {
      routing::getInstance()->redirect('cliente', 'insertCliente');
      session::getInstance()->setFlash('exc', $exc);
    }
  }

}
