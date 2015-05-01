
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
class updateLoteMasActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {
        $id = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::ID, true));
        $ubicacion = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::UBICACION, true));
        $tamano = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::TAMANO, true));
        $unidadDistancia = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::UNIDAD_DISTANCIA_ID, true));
        $descripcion = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::DESCRIPCION, true));
        $fechaSiembra = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::FECHA_INICIO_SIEMBRA, true));
        $idCiudad = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::ID_CIUDAD, true));
        $numero = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::NUMERO_PLANTULAS, true));
        $insumo = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::PRODUCTO_INSUMO_ID, true));
        $presupuesto = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::PRESUPUESTO, true));
        
        
        if (strlen($numero) == null or $numero =='') {
           $numero = 'null';
        }
        
        if (strlen($insumo) == null or $insumo =='') {
           $insumo = 'null';
        }
         
         if (strlen($presupuesto) == null or $presupuesto =='') {
           $presupuesto = 'null';
        }
        
        
        $this->validate($ubicacion, $tamano, $descripcion, $numero, $presupuesto);
        
        loteTableClass::loteupdateMas($id,$fechaSiembra,$numero,$insumo,$presupuesto);
        session::getInstance()->setSuccess('El registro fue exitoso');
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
    
     if ($flag === true){
    request::getInstance()->setMethod('GET');
    request::getInstance()->addParamGet(array(loteTableClass::ID => request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::ID, true))));
    routing::getInstance()->forward('lote', 'editLoteMas');
    
  }
}

}
