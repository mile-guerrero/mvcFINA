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
          throw new PDOException(i18n::__(00001, null, 'errors', array(':longitud' => maquinaTableClass::NOMBRE_LENGTH)), 00001);
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
