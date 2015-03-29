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
class editProveedorActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->hasRequest(proveedorTableClass::ID)) {
        $fields = array(
            proveedorTableClass::ID,
            proveedorTableClass::NOMBREP,
            proveedorTableClass::APELLIDO,
            proveedorTableClass::DIRECCION,
            proveedorTableClass::TELEFONO,
            proveedorTableClass::EMAIL,
            proveedorTableClass::ID_CIUDAD
        );
        $where = array(
            proveedorTableClass::ID => request::getInstance()->getRequest(proveedorTableClass::ID)
        );
         
        $this->objProveedor = proveedorTableClass::getAll($fields, true, null, null, null, null, $where);
        $fields = array(
            ciudadTableClass::ID,
            ciudadTableClass::NOMBRE_CIUDAD
        );
        $orderBy = array(
            ciudadTableClass::NOMBRE_CIUDAD
        );
        $this->objCiudad = ciudadTableClass::getAll($fields, false, $orderBy, 'ASC');
        $this->defineView('editProveedor', 'maquina', session::getInstance()->getFormatOutput());
      } else {
        routing::getInstance()->redirect('maquina', 'indexProveedor');

//      if (request::getInstance()->isMethod('POST')) {
//
//        $usuario = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::USUARIO, true));
//        $password = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::PASSWORD, true));
//
//        if (strlen($usuario) > usuarioTableClass::USUARIO_LENGTH) {
//          throw new PDOException(i18n::__(00001, null, 'errors', array(':longitud' => usuarioTableClass::USUARIO_LENGTH)), 00001);
//        }
//
//        $data = array(
//            usuarioTableClass::USUARIO => $usuario,
//            usuarioTableClass::PASSWORD => md5($password)
//        );
//        usuarioTableClass::insert($data);
//        routing::getInstance()->redirect('default', 'index');
//      } else {
//        routing::getInstance()->redirect('default', 'index');
      }
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}
