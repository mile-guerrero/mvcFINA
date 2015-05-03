
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
        
        
        $this->validate($numero, $presupuesto);
        
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
  public function validate($numero, $presupuesto){

    $flag = false;
    $patron = "/^[[:digit:]]+$/";

//-----------------validaciones de numero---------------------------------------
          if (strlen($numero) > loteTableClass::NUMERO_PLANTULAS_LENGTH) {
      session::getInstance()->setError(i18n::__(00001, null, 'errors', array(':longitud' =>loteTableClass::NUMERO_PLANTULAS_LENGTH)), 00001);
      $flag = true;
      } 
      
      if (!preg_match($patron, $numero)) {
      session::getInstance()->setError(i18n::__(00010, null, 'errors', array(':no permite letras' => loteTableClass::NUMERO_PLANTULAS)), 00010);
      $flag = true;
       }
//-----------------validaciones de presupuesto----------------------------------      
      if (strlen($presupuesto) > loteTableClass::PRESUPUESTO_LENGTH) {
         session::getInstance()->setError(i18n::__(00006, null, 'errors', array(':longitud' => loteTableClass::PRESUPUESTO_LENGTH)), 00006);
        $flag = true;
        }
        
      if (!preg_match($patron, $presupuesto)) {
      session::getInstance()->setError(i18n::__(00010, null, 'errors', array(':no permite letras' => loteTableClass::PRESUPUESTO)), 00010);
      $flag = true;
       }
    
//-----------------confirmacion de validacion-----------------------------------    
     if ($flag === true){
    request::getInstance()->setMethod('GET');
    request::getInstance()->addParamGet(array(loteTableClass::ID => request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::ID, true))));
    routing::getInstance()->forward('lote', 'editLoteMas');
    
  }
}

}
