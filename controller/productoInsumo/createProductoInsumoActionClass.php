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
class createProductoInsumoActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $descripcion = request::getInstance()->getPost(productoInsumoTableClass::getNameField(productoInsumoTableClass::DESCRIPCION, true));
        $iva = request::getInstance()->getPost(productoInsumoTableClass::getNameField(productoInsumoTableClass::IVA, true));
        $unidad = request::getInstance()->getPost(productoInsumoTableClass::getNameField(productoInsumoTableClass::UNIDAD_MEDIDA_ID, true));
        $tipo = request::getInstance()->getPost(productoInsumoTableClass::getNameField(productoInsumoTableClass::TIPO_PRODUCTO_INSUMO_ID, true));

//        if (strlen($descripcion) > productoInsumoTableClass::DESCRIPCION_LENGTH) {
//          throw new PDOException(i18n::__(00001, null, 'errors', array(':longitud' =>  productoInsumoTableClass::DESCRIPCION_LENGTH)), 00001);
//        }
 if (strlen($descripcion) > productoInsumoTableClass::DESCRIPCION_LENGTH) {
         session::getInstance()->setError(i18n::__(00004, null, 'errors', array(':longitud' => productoInsumoTableClass::DESCRIPCION_LENGTH)), 00004);
        routing::getInstance()->redirect('productoInsumo', 'insertProductoInsumo');
         
        }
        
        
        $data = array(
             productoInsumoTableClass::DESCRIPCION => $descripcion,
             productoInsumoTableClass::IVA => $iva,
             productoInsumoTableClass::UNIDAD_MEDIDA_ID => $unidad,
             productoInsumoTableClass::TIPO_PRODUCTO_INSUMO_ID => $tipo
        );
         productoInsumoTableClass::insert($data);
        routing::getInstance()->redirect('productoInsumo', 'indexProductoInsumo');
      } else {
        routing::getInstance()->redirect('productoInsumo', 'indexProductoInsumo');
      }
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}
