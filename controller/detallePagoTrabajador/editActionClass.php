
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
 * @author 
 */
class editActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
   
      if (request::getInstance()->hasRequest(detallePagoTrabajadorTableClass::ID)) {
        
        
        $fields = array(
           detallePagoTrabajadorTableClass::ID,
           detallePagoTrabajadorTableClass::PAGO_TRABAJADOR_ID
        );
        $where = array(
            detallePagoTrabajadorTableClass::ID => request::getInstance()->getRequest(detallePagoTrabajadorTableClass::ID)
        );
        $this->objDPTT = detallePagoTrabajadorTableClass::getAll($fields, false, null, null, null, null, $where);
        
        $fields = array(
            
          detallePagoTrabajadorTableClass::ID,
          detallePagoTrabajadorTableClass::VALOR_SALARIO,
          detallePagoTrabajadorTableClass::CANTIDAD_HORAS_EXTRAS,
          detallePagoTrabajadorTableClass::VALOR_HORAS_EXTRAS,
          detallePagoTrabajadorTableClass::HORAS_PERDIDAS,
          detallePagoTrabajadorTableClass::TOTAL_PAGAR,
          detallePagoTrabajadorTableClass::TRABAJADOR_ID,
          detallePagoTrabajadorTableClass::CREATED_AT,
          detallePagoTrabajadorTableClass::UPDATED_AT,
          detallePagoTrabajadorTableClass::PAGO_TRABAJADOR_ID
        );
        $where = array(
            detallePagoTrabajadorTableClass::ID => request::getInstance()->getRequest(detallePagoTrabajadorTableClass::ID)
        );
        $this->objDPT = detallePagoTrabajadorTableClass::getAll($fields, false, null, null, null, null, $where);
        
        $fields = array(
            pagoTrabajadorTableClass::ID,
            pagoTrabajadorTableClass::FECHA_INICIAL
        );
        
        $this->objPT = pagoTrabajadorTableClass::getAll($fields, false);
        
        $fields = array(
            trabajadorTableClass::ID,
            trabajadorTableClass::NOMBRET
        );
        
        $this->objTrabajador = trabajadorTableClass::getAll($fields, true);
       
         $fields = array(
            detallePagoTrabajadorTableClass::PAGO_TRABAJADOR_ID
        );
     
        $this->objDPTT = detallePagoTrabajadorTableClass::getAll($fields, false);
         
        $this->defineView('edit', 'detallePagoTrabajador', session::getInstance()->getFormatOutput());
     
      }else{
        routing::getInstance()->redirect('detallePagoTrabajador', 'index');
      }

    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}

