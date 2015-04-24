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
        $documento = trim(request::getInstance()->getPost(clienteTableClass::getNameField(clienteTableClass::DOCUMENTO, true)));
        $direccion = trim(request::getInstance()->getPost(clienteTableClass::getNameField(clienteTableClass::DIRECCION, true)));
        $telefono = trim(request::getInstance()->getPost(clienteTableClass::getNameField(clienteTableClass::TELEFONO, true)));
        $idTipo = trim(request::getInstance()->getPost(clienteTableClass::getNameField(clienteTableClass::ID_TIPO_ID, true)));
        $idCiudad = trim(request::getInstance()->getPost(clienteTableClass::getNameField(clienteTableClass::ID_CIUDAD, true)));

        $this->validate($nombre, $apellido, $documento, $direccion, $telefono, $idTipo, $idCiudad);

        $data = array(
            clienteTableClass::NOMBRE => $nombre,
            clienteTableClass::APELLIDO => $apellido,
            clienteTableClass::DOCUMENTO => $documento,
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

  public function validate($nombre, $apellido, $documento, $direccion, $telefono, $idTipo, $idCiudad) {

    $flag = false;
    
    if (strlen($nombre) > clienteTableClass::NOMBRE_LENGTH) {
      session::getInstance()->setError(i18n::__(00001, null, 'errors', array(':longitud' => clienteTableClass::NOMBRE_LENGTH)), 00001);
      $flag = true;
      session::getInstance()->setFlash(usuarioTableClass::getNameField(clienteTableClass::NOMBRE, true),true);
      }

    if (strlen($nombre) == null) {
      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => clienteTableClass::NOMBRE)), 00009);
      $flag = true;
      session::getInstance()->setFlash(clienteTableClass::getNameField(clienteTableClass::NOMBRE, true), true);
     }
     
    
    if (!preg_match("/^[a-z]+$/i", $nombre)){         
      session::getInstance()->setError(i18n::__(00012, null, 'errors', array(':letras' => clienteTableClass::NOMBRE)), 00012);
      $flag = true;
      session::getInstance()->setFlash(clienteTableClass::getNameField(clienteTableClass::NOMBRE, true), true);
      }
      
 //--------------------------------------------------------------------   
    if (strlen($apellido) > clienteTableClass::APELLIDO_LENGTH) {
      session::getInstance()->setError(i18n::__(00002, null, 'errors', array(':longitud' => clienteTableClass::APELLIDO_LENGTH)), 00002);
      $flag = true;
      session::getInstance()->setFlash(clienteTableClass::getNameField(clienteTableClass::APELLIDO, true), true);
     }
    
     if (strlen($apellido) == null) {
      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => clienteTableClass::APELLIDO)), 00009);
      $flag = true;
      session::getInstance()->setFlash(clienteTableClass::getNameField(clienteTableClass::APELLIDO, true), true);
     }
     
     if (!preg_match("/^[a-z]+$/i", $apellido )) {
      session::getInstance()->setError(i18n::__(00012, null, 'errors', array(':letras' => clienteTableClass::APELLIDO)), 00012);
      $flag = true;
      session::getInstance()->setFlash(clienteTableClass::getNameField(clienteTableClass::APELLIDO, true), true);
     }
     //-------------------------------------------------------------------
     if (strlen($direccion) > clienteTableClass::DIRECCION_LENGTH) {
      session::getInstance()->setError(i18n::__(00002, null, 'errors', array(':longitud' => clienteTableClass::DIRECCION_LENGTH)), 00002);
      $flag = true;
      session::getInstance()->setFlash(clienteTableClass::getNameField(clienteTableClass::DIRECCION, true), true);
     }
     
     if (strlen($direccion) == null) {
      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => clienteTableClass::DIRECCION)), 00009);
      $flag = true;
      session::getInstance()->setFlash(clienteTableClass::getNameField(clienteTableClass::DIRECCION, true), true);
     }
 //-------------------------------------------------------------------
 if (strlen($documento) > clienteTableClass::DOCUMENTO_LENGTH) {
      session::getInstance()->setError(i18n::__(00015, null, 'errors', array(':longitud' => clienteTableClass::DOCUMENTO_LENGTH)), 00015);
      $flag = true;
      session::getInstance()->setFlash(clienteTableClass::getNameField(clienteTableClass::DOCUMENTO, true), true);
     }
 if (strlen($documento) == null) {
      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => clienteTableClass::DOCUMENTO)), 00009);
      $flag = true;
      session::getInstance()->setFlash(clienteTableClass::getNameField(clienteTableClass::DOCUMENTO, true), true);
     }
  //-----------------------------------------------------------------
  if (strlen($telefono) > clienteTableClass::TELEFONO_LENGTH) {
      session::getInstance()->setError(i18n::__(00014, null, 'errors', array(':longitud' => clienteTableClass::TELEFONO_LENGTH)), 00014);
      $flag = true;
      session::getInstance()->setFlash(clienteTableClass::getNameField(clienteTableClass::TELEFONO, true), true);
     }
  if (strlen($telefono) == null) {
      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => clienteTableClass::TELEFONO)), 00009);
      $flag = true;
      session::getInstance()->setFlash(clienteTableClass::getNameField(clienteTableClass::TELEFONO, true), true);
     }
//  pasar el campo a numerico
//    if (!preg_match("/[0-9]{9}$/", $telefono )) {
//      session::getInstance()->setError(i18n::__(00010, null, 'errors', array(':numeros' => $telefono)), 00010);
//      session::getInstance()->setFlash(clienteTableClass::getNameField(clienteTableClass::TELEFONO, true), true);
// 
//    }


    if ($flag === true){
    request::getInstance()->setMethod('GET');
    routing::getInstance()->forward('cliente', 'insertCliente');
  }
  }

}

