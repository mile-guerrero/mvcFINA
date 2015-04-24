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
class createLoteActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $ubicacion = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::UBICACION, true));
        $tamano = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::TAMANO, true));
        $unidadDistancia = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::UNIDAD_DISTANCIA_ID, true));
        $descripcion = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::DESCRIPCION, true));
        $fechaSiembra = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::FECHA_INICIO_SIEMBRA, true));
        $numero = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::NUMERO_PLANTULAS, true));
        $presupuesto = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::PRESUPUESTO, true));
        $insumo = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::PRODUCTO_INSUMO_ID, true));
        $idCiudad = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::ID_CIUDAD, true));
       
        $this->validate($ubicacion, $tamano, $descripcion, $numero, $presupuesto);
//        
 
        $data = array(
            loteTableClass::UBICACION => $ubicacion,
            loteTableClass::TAMANO => $tamano,
            loteTableClass::UNIDAD_DISTANCIA_ID => $unidadDistancia,
            loteTableClass::DESCRIPCION => $descripcion,
            loteTableClass::FECHA_INICIO_SIEMBRA => $fechaSiembra,
            loteTableClass::NUMERO_PLANTULAS => $numero,
            loteTableClass::PRESUPUESTO => $presupuesto,
            loteTableClass::PRODUCTO_INSUMO_ID => $insumo,
            loteTableClass::ID_CIUDAD => $idCiudad
        );
       

        loteTableClass::insert($data);
        session::getInstance()->setSuccess('El registro fue exitoso');
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

 public function validate($ubicacion, $tamano, $descripcion, $numero, $presupuesto){

    $flag = false;

if (strlen($ubicacion) > loteTableClass::UBICACION_LENGTH) {
         session::getInstance()->setError(i18n::__(00005, null, 'errors', array(':longitud' =>  loteTableClass::UBICACION_LENGTH)), 00005);
        routing::getInstance()->redirect('lote', 'insertLote');
         
        }
        
        if (strlen($tamano) > loteTableClass::TAMANO_LENGTH) {
         session::getInstance()->setError(i18n::__(00006, null, 'errors', array(':longitud' => loteTableClass::TAMANO_LENGTH)), 00006);
        routing::getInstance()->redirect('lote', 'insertLote');
         
        }
        
        if (strlen($tamano) > loteTableClass::DESCRIPCION_LENGTH) {
         session::getInstance()->setError(i18n::__(00004, null, 'errors', array(':longitud' => loteTableClass::DESCRIPCION_LENGTH)), 00004);
        routing::getInstance()->redirect('lote', 'insertLote');
         
        }
          if (strlen($numero) > loteTableClass::NUMERO_PLANTULAS_LENGTH) {
      session::getInstance()->setError(i18n::__(00001, null, 'errors', array(':longitud' =>loteTableClass::NUMERO_PLANTULAS_LENGTH)), 00001);
      $flag = true;
      session::getInstance()->setFlash(loteTableClass::getNameField(loteTableClass::NUMERO_PLANTULAS, true),true);
      }

    if (strlen($numero) == null) {
      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => loteTableClass::NUMERO_PLANTULAS)), 00009);
      $flag = true;
      session::getInstance()->setFlash(loteTableClass::getNameField(loteTableClass::NUMERO_PLANTULAS, true), true);
     }
     if ($flag === true){
    request::getInstance()->setMethod('GET');
    routing::getInstance()->forward('lote', 'insert');
  }
}
}