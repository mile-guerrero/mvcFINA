
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
class updateLoteActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {
        $id = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::ID, true));
        $ubicacion = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::UBICACION, true));
        $tamano = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::TAMANO, true));
        $unidadDistancia = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::UNIDAD_DISTANCIA_ID, true));
        $descripcion = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::DESCRIPCION, true));
        $idCiudad = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::ID_CIUDAD, true));

        $this->validate($ubicacion, $tamano, $descripcion);


        $ids = array(
            loteTableClass::ID => $id
        );
        $data = array(
            loteTableClass::UBICACION => $ubicacion,
            loteTableClass::TAMANO => $tamano,
            loteTableClass::UNIDAD_DISTANCIA_ID => $unidadDistancia,
            loteTableClass::DESCRIPCION => $descripcion,
            loteTableClass::ID_CIUDAD => $idCiudad
        );
        loteTableClass::update($ids, $data);
        session::getInstance()->setSuccess('El registro fue exitoso');
        routing::getInstance()->redirect('lote', 'indexLote');
      }
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

  public function validate($ubicacion, $tamano, $descripcion) {

    $flag = false;
//------------------validaciones de ubicacion-----------------------------------
    if (strlen($ubicacion) > loteTableClass::UBICACION_LENGTH) {
      session::getInstance()->setError(i18n::__(00005, null, 'errors', array(':longitud' => loteTableClass::UBICACION_LENGTH)), 00005);
      $flag = true;
    }
    
    if (strlen($ubicacion) == null) {
      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => loteTableClass::UBICACION)), 00009);
      $flag = true;
       }
     
//-----------------validaciones de tamaño---------------------------------------
    if (strlen($tamano) > loteTableClass::TAMANO_LENGTH) {
      session::getInstance()->setError(i18n::__(00006, null, 'errors', array(':longitud' => loteTableClass::TAMANO_LENGTH)), 00006);
      $flag = true;
    }
    
    if (strlen($tamano) == null) {
      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => loteTableClass::TAMANO)), 00009);
      $flag = true;
       }
       
  $patron = "/^[[:digit:]]+$/";
  
  if (!preg_match($patron, $tamano)) {
      session::getInstance()->setError(i18n::__(00010, null, 'errors', array(':no permite letras' => loteTableClass::TAMANO)), 00010);
      $flag = true;
       }
  
//-----------------validaciones de descripcion----------------------------------
    if (strlen($descripcion) > loteTableClass::DESCRIPCION_LENGTH) {
      session::getInstance()->setError(i18n::__(00004, null, 'errors', array(':longitud' => loteTableClass::DESCRIPCION_LENGTH)), 00004);
      $flag = true;
    }
    
    if (strlen($descripcion) == null) {
      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => loteTableClass::DESCRIPCION)), 00009);
      $flag = true;
  }

//-----------------respuesta a error--------------------------------------------
    if ($flag === true) {
      request::getInstance()->setMethod('GET');
      request::getInstance()->addParamGet(array(loteTableClass::ID => request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::ID, true))));
      routing::getInstance()->forward('lote', 'editLote');
    }
  }

}
