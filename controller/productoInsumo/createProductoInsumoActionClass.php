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
class createProductoInsumoActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $descripcion = request::getInstance()->getPost(productoInsumoTableClass::getNameField(productoInsumoTableClass::DESCRIPCION, true));
        $iva = request::getInstance()->getPost(productoInsumoTableClass::getNameField(productoInsumoTableClass::IVA, true));
        $unidad = request::getInstance()->getPost(productoInsumoTableClass::getNameField(productoInsumoTableClass::UNIDAD_MEDIDA_ID, true));
        $tipo = request::getInstance()->getPost(productoInsumoTableClass::getNameField(productoInsumoTableClass::TIPO_PRODUCTO_INSUMO_ID, true));

        $this->validate($descripcion, $iva, $unidad, $tipo);

        $data = array(
             productoInsumoTableClass::DESCRIPCION => $descripcion,
             productoInsumoTableClass::IVA => $iva,
             productoInsumoTableClass::UNIDAD_MEDIDA_ID => $unidad,
             productoInsumoTableClass::TIPO_PRODUCTO_INSUMO_ID => $tipo
        );
         productoInsumoTableClass::insert($data);
         session::getInstance()->setSuccess('El Registro Fue Exitoso ');
        routing::getInstance()->redirect('productoInsumo', 'indexProductoInsumo');
      } else {
        routing::getInstance()->redirect('productoInsumo', 'indexProductoInsumo');
      }
    } catch (PDOException $exc) {
      routing::getInstance()->redirect('productoInsumo', 'insertProductoInsumo');
      session::getInstance()->setFlash('exc', $exc);
    }
  }
  
public function validate($descripcion, $iva, $unidad, $tipo) {

    $flag = false;
    if (strlen($descripcion) > productoInsumoTableClass::DESCRIPCION_LENGTH) {
      session::getInstance()->setError(i18n::__(00001, null, 'errors', array(':longitud' => productoInsumoTableClass::DESCRIPCION_LENGTH)), 00001);
      session::getInstance()->setFlash(productoInsumoTableClass::getNameField(productoInsumoTableClass::DESCRIPCION_LENGTH, true), true);
      
    }
    
    if (!preg_match("/^[a-z]+$/i", $descripcion)) {
      session::getInstance()->setError(i18n::__(00012, null, 'errors', array(':letras' => $descripcion)), 00012);
      $flag = true;
      session::getInstance()->setFlash(productoInsumoTableClass::getNameField(productoInsumoTableClass::DESCRIPCION, true), true);
      
    }

    if (strlen($descripcion) == "") {
      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => productoInsumoTableClass::DESCRIPCION)), 00009);
      $flag = true;
      session::getInstance()->setFlash(productoInsumoTableClass::getNameField(productoInsumoTableClass::DESCRIPCION, true), true);
      
    }
    
     if (!is_numeric($iva) === "" or $iva === null) {
      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => productoInsumoTableClass::IVA)), 00009);
      
    }

    if (!is_numeric($iva )) {
      session::getInstance()->setError(i18n::__(00010, null, 'errors', array(':numeros' => $iva)), 00010);
      $flag = true;
      session::getInstance()->setFlash(productoInsumoTableClass::getNameField(productoInsumoTableClass::IVA, true), true);
 
    }
    
    if ($flag === true){
      request::getInstance()->setMethod('GET');
      routing::getInstance()->forward('productoInsumo', 'insertProductoInsumo');
    }
  }

}
