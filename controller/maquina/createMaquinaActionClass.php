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

        $nombre = request::getInstance()->getPost(maquinaTableClass::getNameField(maquinaTableClass::NOMBRE, true));
        $descripcion = request::getInstance()->getPost(maquinaTableClass::getNameField(maquinaTableClass::DESCRIPCION, true));
        $tipo = request::getInstance()->getPost(maquinaTableClass::getNameField(maquinaTableClass::TIPO_USO_ID, true));
        $origen = request::getInstance()->getPost(maquinaTableClass::getNameField(maquinaTableClass::ORIGEN_ID, true));
        $proveedor = request::getInstance()->getPost(maquinaTableClass::getNameField(maquinaTableClass::PROVEEDOR_ID, true));

         if (strlen($nombre) > maquinaTableClass::NOMBRE_LENGTH) {
         session::getInstance()->setError(i18n::__(00001, null, 'errors', array(':longitud' => maquinaTableClass::NOMBRE_LENGTH)), 00001);
        routing::getInstance()->redirect('maquina', 'insertMaquina');
         
        }
        
        if (strlen($descripcion) > maquinaTableClass::DESCRIPCION_LENGTH) {
         session::getInstance()->setError(i18n::__(00004, null, 'errors', array(':longitud' => maquinaTableClass::DESCRIPCION_LENGTH)), 00004);
        routing::getInstance()->redirect('maquina', 'insertMaquina');
         
        }

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
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}