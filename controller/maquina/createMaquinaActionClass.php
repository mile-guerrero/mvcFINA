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
class createMaquinaActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $nombre = trim(request::getInstance()->getPost(maquinaTableClass::getNameField(maquinaTableClass::NOMBRE, true)));
        $descripcion = trim(request::getInstance()->getPost(maquinaTableClass::getNameField(maquinaTableClass::DESCRIPCION, true)));
        $tipo = trim(request::getInstance()->getPost(maquinaTableClass::getNameField(maquinaTableClass::TIPO_USO_ID, true)));
        $origen = trim(request::getInstance()->getPost(maquinaTableClass::getNameField(maquinaTableClass::ORIGEN_ID, true)));
        $proveedor = trim(request::getInstance()->getPost(maquinaTableClass::getNameField(maquinaTableClass::PROVEEDOR_ID, true)));

        $this->validate($nombre, $descripcion, $tipo, $origen, $proveedor);

        $data = array(
            maquinaTableClass::NOMBRE => $nombre,
            maquinaTableClass::DESCRIPCION => $descripcion,
            maquinaTableClass::TIPO_USO_ID => $tipo,
            maquinaTableClass::ORIGEN_ID => $origen,
            maquinaTableClass::PROVEEDOR_ID => $proveedor    
        );
        maquinaTableClass::insert($data);
        routing::getInstance()->redirect('maquina', 'indexMaquina');
      } else {
        routing::getInstance()->redirect('maquina', 'indexMaquina');
      }
    } catch (PDOException $exc) {
     routing::getInstance()->redirect('maquina', 'insertMaquina');
      session::getInstance()->setFlash('exc', $exc);
    }
  }

public function validate($nombre, $descripcion) {

    $flag = false;
     if (strlen($nombre) > maquinaTableClass::NOMBRE_LENGTH) {
         session::getInstance()->setError(i18n::__(00001, null, 'errors', array(':longitud' => maquinaTableClass::NOMBRE_LENGTH)), 00001);
        routing::getInstance()->redirect('maquina', 'insertMaquina');
         
        }
        
        if (!preg_match("/^[a-z]+$/i", $nombre)) {
      session::getInstance()->setError(i18n::__(00012, null, 'errors', array(':letras' => $nombre)), 00012);
      $flag = true;
      session::getInstance()->setFlash(maquinaTableClass::getNameField(maquinaTableClass::NOMBRE, true), true);
      
       }

      if (strlen($nombre) == "") {
      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => maquinaTableClass::NOMBRE)), 00009);
      $flag = true;
      session::getInstance()->setFlash(maquinaTableClass::getNameField(maquinaTableClass::NOMBRE, true), true);
    
      }
      
      if (strlen($descripcion) > maquinaTableClass::DESCRIPCION_LENGTH) {
         session::getInstance()->setError(i18n::__(00004, null, 'errors', array(':longitud' => maquinaTableClass::DESCRIPCION_LENGTH)), 00004);
        routing::getInstance()->redirect('maquina', 'insertMaquina');
         
        }
    
     if (!preg_match("/^[a-z]+$/i", $descripcion)) {
      session::getInstance()->setError(i18n::__(00012, null, 'errors', array(':letras' => $descripcion)), 00012);
      $flag = true;
      session::getInstance()->setFlash(maquinaTableClass::getNameField(maquinaTableClass::DESCRIPCION, true), true);
      
       }

      if (strlen($descripcion) == "") {
      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => maquinaTableClass::DESCRIPCION)), 00009);
      $flag = true;
      session::getInstance()->setFlash(maquinaTableClass::getNameField(maquinaTableClass::DESCRIPCION, true), true);
    }
    
      if ($flag === true){
      request::getInstance()->setMethod('GET');
      routing::getInstance()->forward('maquina', 'insertMaquina');
    }
}

}