<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\clienteValidatorClass as validator;
use hook\log\logHookClass as log;

/**
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon 
 * @date: fecha de inicio del desarrollo.
 * @category: modulo de cliente.
 */
class createClienteActionClass extends controllerClass implements controllerActionInterface {

  /**
   * @author: Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon .
   * @date: fecha de inicio del desarrollo.
   * @return   clienteTableClass::NOMBRE retorna $nombre (string),
    clienteTableClass::APELLIDO retorna $apellido (string),
    clienteTableClass::DOCUMENTO retorna $documento (integer),
    clienteTableClass::DIRECCION retorna $direccion (string),
    clienteTableClass::TELEFONO retorna $telefono (integer),
    clienteTableClass::ID_TIPO_ID retorna $idTipo (integer),
    clienteTableClass::ID_CIUDAD retorna $idCiudad (integer),
   * estos datos retornan en la variable $data
   */
  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $nombre = trim(request::getInstance()->getPost(clienteTableClass::getNameField(clienteTableClass::NOMBRE, true)));
        $apellido = trim(request::getInstance()->getPost(clienteTableClass::getNameField(clienteTableClass::APELLIDO, true)));
        $documento = trim(request::getInstance()->getPost(clienteTableClass::getNameField(clienteTableClass::DOCUMENTO, true)));
        $direccion = trim(request::getInstance()->getPost(clienteTableClass::getNameField(clienteTableClass::DIRECCION, true)));
        $telefono = trim(request::getInstance()->getPost(clienteTableClass::getNameField(clienteTableClass::TELEFONO, true)));
        $idTipo = trim(request::getInstance()->getPost(clienteTableClass::getNameField(clienteTableClass::ID_TIPO_ID, true)));
        $idCiudad = trim(request::getInstance()->getPost(clienteTableClass::getNameField(clienteTableClass::ID_CIUDAD, true)));

        //llamar la funcion validateInsert()
        validator::validateInsert();


        $data = array(
            clienteTableClass::NOMBRE => $nombre,
            clienteTableClass::APELLIDO => $apellido,
            clienteTableClass::DOCUMENTO => $documento,
            clienteTableClass::DIRECCION => $direccion,
            clienteTableClass::TELEFONO => $telefono,
            clienteTableClass::ID_TIPO_ID => $idTipo,
            clienteTableClass::ID_CIUDAD => $idCiudad,
            '__sequence' => 'cliente_id_seq'
        );
        $id = clienteTableClass::insert($data);
        session::getInstance()->setSuccess('El registro fue exitoso');
        $observacion ='se ha insertando un nuevo cliente';
        log::register('Insertar', clienteTableClass::getNameTable(),$observacion,$id);
        routing::getInstance()->redirect('cliente', 'indexCliente');
      }//cierre del POST 
      else {
        routing::getInstance()->redirect('cliente', 'indexCliente');
      }//cierre del else
    } //cierre de la try
    catch (PDOException $exc) {
      routing::getInstance()->redirect('cliente', 'insertCliente');
      session::getInstance()->setFlash('exc', $exc);
    }//cierre del catch
  }//cierre de la funcion execute 
}//cierre de la clase




