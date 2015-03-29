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
class createProveedorActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $nombre = request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::NOMBREP, true));
        $apellido = request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::APELLIDO, true));
        $direccion = request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::DIRECCION, true));
        $telefono = request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::TELEFONO, true));
        $email = request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::EMAIL, true));
        $ciudad_id = request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::ID_CIUDAD, true));
        

//        if (strlen($usuario) > usuarioTableClass::USUARIO_LENGTH) {
//          throw new PDOException(i18n::__(00001, null, 'errors', array(':longitud' => usuarioTableClass::USUARIO_LENGTH)), 00001);
//        }
 if (strlen($nombre) > proveedorTableClass::NOMBREP_LENGTH) {
         session::getInstance()->setError(i18n::__(00001, null, 'errors', array(':longitud' => proveedorTableClass::NOMBREP_LENGTH)), 00001);
        routing::getInstance()->redirect('maquina', 'insertProveedor');
         
        }
        
        if (strlen($apellido) > proveedorTableClass::APELLIDO_LENGTH) {
         session::getInstance()->setError(i18n::__(00002, null, 'errors', array(':longitud' => proveedorTableClass::APELLIDO_LENGTH)), 00002);
        routing::getInstance()->redirect('maquina', 'insertProveedor');
         
        }
        $data = array(
            proveedorTableClass::NOMBREP => $nombre,
            proveedorTableClass::APELLIDO => $apellido,
            proveedorTableClass::DIRECCION => $direccion,
            proveedorTableClass::TELEFONO => $telefono,
            proveedorTableClass::EMAIL => $email,
            proveedorTableClass::ID_CIUDAD => $ciudad_id
            
        );
        proveedorTableClass::insert($data);
        routing::getInstance()->redirect('maquina', 'indexProveedor');
      } else {
        routing::getInstance()->redirect('maquina', 'indexProveedor');
      }
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}
