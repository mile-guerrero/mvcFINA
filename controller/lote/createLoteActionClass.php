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
class createLoteActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $ubicacion = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::UBICACION, true));
        $tamano = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::TAMANO, true));
        $descripcion = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::DESCRIPCION, true));
        $idCiudad = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::ID_CIUDAD, true));

//        if (strlen($descripcion) > loteTableClass::DESCRIPCION_LENGTH) {
//          throw new PDOException(i18n::__(00001, null, 'errors', array(':longitud' => loteTableClass::DESCRIPCION_LENGTH)), 00001);
//        }

        $data = array(
            loteTableClass::UBICACION => $ubicacion,
            loteTableClass::TAMANO => $tamano,
            loteTableClass::DESCRIPCION => $descripcion,
            loteTableClass::ID_CIUDAD => $idCiudad
        );
        loteTableClass::insert($data);
        routing::getInstance()->redirect('lote', 'indexLote');
      } else {
        routing::getInstance()->redirect('lote', 'indexLote');
      }
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}
