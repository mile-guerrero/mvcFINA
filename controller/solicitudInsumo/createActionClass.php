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
class createActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $fecha = request::getInstance()->getPost(solicitudInsumoTableClass::getNameField(solicitudInsumoTableClass::FECHA_HORA, true));
        $trabajador = request::getInstance()->getPost(solicitudInsumoTableClass::getNameField(solicitudInsumoTableClass::TRABAJADOR_ID, true));
        $cantidad = request::getInstance()->getPost(solicitudInsumoTableClass::getNameField(solicitudInsumoTableClass::CANTIDAD, true));
        $idProducto = request::getInstance()->getPost(solicitudInsumoTableClass::getNameField(solicitudInsumoTableClass::PRODUCTO_INSUMO_ID, true));
        $idLote = request::getInstance()->getPost(solicitudInsumoTableClass::getNameField(solicitudInsumoTableClass::LOTE_ID, true));
//        if (strlen($nombre) > credencialTableClass::NOMBRE_LENGTH) {
//          throw new PDOException(i18n::__(00001, null, 'errors', array(':longitud' => credencialTableClass::NOMBRE_LENGTH)), 00001);
//        }
        $this->validate($cantidad);

        $data = array(
            solicitudInsumoTableClass::FECHA_HORA => $fecha,
            solicitudInsumoTableClass::TRABAJADOR_ID => $trabajador,
            solicitudInsumoTableClass::CANTIDAD => $cantidad,
            solicitudInsumoTableClass::PRODUCTO_INSUMO_ID => $idProducto,
            solicitudInsumoTableClass::LOTE_ID => $idLote
        );
        solicitudInsumoTableClass::insert($data);
        session::getInstance()->setSuccess('El registro fue exitoso');
        routing::getInstance()->redirect('solicitudInsumo', 'index');
      } else {
        routing::getInstance()->redirect('solicitudInsumo', 'index');
      }
    } catch (PDOException $exc) {
      routing::getInstance()->redirect('solicitudInsumo', 'insert');
      session::getInstance()->setFlash('exc', $exc);
    }
  }

public function validate($cantidad) {

    $flag = false;
    $patron = "/^[[:digit:]]+$/";
//---------------------validacion descripcion----------------------------------- 
    
    if (strlen($cantidad) > solicitudInsumoTableClass::CANTIDAD_LENGTH) {
      session::getInstance()->setError(i18n::__(00004, null, 'errors', array(':longitud' => solicitudInsumoTableClass::CANTIDAD_LENGTH)), 00004);
      $flag = true;
    } 
    
    if (!is_numeric($cantidad) == "" ) {
      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => solicitudInsumoTableClass::CANTIDAD)), 00009);
      $flag = true;
    }
    
    if (!preg_match($patron, $cantidad)) {
      session::getInstance()->setError(i18n::__(00010, null, 'errors', array(':numeros' => $cantidad)), 00010);
      $flag = true;
       }
//-----------------------validacion --------------------------------------------    
    if ($flag === true){
      request::getInstance()->setMethod('GET');
      routing::getInstance()->forward('solicitudInsumo', 'insert');
    }
  }

}
