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

        $nombre = request::getInstance()->getPost(clienteTableClass::getNameField(clienteTableClass::NOMBRE, true));
        $apellido = request::getInstance()->getPost(clienteTableClass::getNameField(clienteTableClass::APELLIDO, true));
        $direccion = request::getInstance()->getPost(clienteTableClass::getNameField(clienteTableClass::DIRECCION, true));
        $telefono = request::getInstance()->getPost(clienteTableClass::getNameField(clienteTableClass::TELEFONO, true));
        $idTipo = request::getInstance()->getPost(clienteTableClass::getNameField(clienteTableClass::ID_TIPO_ID, true));
        $idCiudad = request::getInstance()->getPost(clienteTableClass::getNameField(clienteTableClass::ID_CIUDAD, true));

        if (strlen($nombre) > clienteTableClass::NOMBRE_LENGTH) {
         session::getInstance()->setError(i18n::__(00001, null, 'errors', array(':longitud' => clienteTableClass::NOMBRE_LENGTH)), 00001);
        routing::getInstance()->redirect('cliente', 'insertCliente');
         
        }
        
        if (strlen($apellido) > clienteTableClass::APELLIDO_LENGTH) {
         session::getInstance()->setError(i18n::__(00002, null, 'errors', array(':longitud' => clienteTableClass::APELLIDO_LENGTH)), 00002);
        routing::getInstance()->redirect('cliente', 'insertCliente');
         
        }
         

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
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}
