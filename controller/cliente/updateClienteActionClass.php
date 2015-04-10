
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
class updateClienteActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {
        $id = request::getInstance()->getPost(clienteTableClass::getNameField(clienteTableClass::ID, true));
        $nombre = request::getInstance()->getPost(clienteTableClass::getNameField(clienteTableClass::NOMBRE, true));
        $apellido = request::getInstance()->getPost(clienteTableClass::getNameField(clienteTableClass::APELLIDO, true));
        $direccion = request::getInstance()->getPost(clienteTableClass::getNameField(clienteTableClass::DIRECCION, true));
        $telefono = request::getInstance()->getPost(clienteTableClass::getNameField(clienteTableClass::TELEFONO, true));
        $idTipo = request::getInstance()->getPost(clienteTableClass::getNameField(clienteTableClass::ID_TIPO_ID, true));
        $idCiudad = request::getInstance()->getPost(clienteTableClass::getNameField(clienteTableClass::ID_CIUDAD, true));
       
        $ids = array(
            clienteTableClass::ID => $id
        );
        $data = array(
            clienteTableClass::NOMBRE => $nombre,
            clienteTableClass::APELLIDO => $apellido,
            clienteTableClass::DIRECCION => $direccion,
            clienteTableClass::TELEFONO => $telefono,
            clienteTableClass::ID_TIPO_ID => $idTipo,
            clienteTableClass::ID_CIUDAD => $idCiudad,
        );
        clienteTableClass::update($ids, $data);
         session::getInstance()->setSuccess('La actualizacion fue correcta');
        routing::getInstance()->redirect('cliente', 'indexCliente');
      }

    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
     
    }
  }

}
