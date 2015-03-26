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
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class updateProveedorActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {
        $id = request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::ID, true));
        $nombre = request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::NOMBREP, true));
        $apellido = request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::APELLIDO, true));
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
            proveedorTableClass::DIRECCION => $direccion,
            proveedorTableClass::TELEFONO => $telefono,
            proveedorTableClass::EMAIL => $email,
            proveedorTableClass::ID_CIUDAD => $id_ciudad
        );

        proveedorTableClass::update($ids, $data);
      }
      routing::getInstance()->redirect('maquina', 'indexProveedor');
//            if (request::getInstance()->hasRequest(usuarioTableClass::ID)) {
//                $fields = array(
//                    usuarioTableClass::ID,
//                    usuarioTableClass::USUARIO,
//                    usuarioTableClass::PASSWORD
//                );
//                $where = array(
//                usuarioTableClass::ID => request::getInstance()->getRequest(usuarioTableClass::ID)
//                );
//                $this->objUsuario = usuarioTableClass::getAll($fields, true, null, null, null, null, $where);
//                $this->defineView('edit', 'default', session::getInstance()->getFormatOutput());
//            }else{
//                routing::getInstance()->redirect('default', 'index');
// 
//            }
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}
