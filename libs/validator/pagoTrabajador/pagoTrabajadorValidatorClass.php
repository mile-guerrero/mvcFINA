<?php

namespace mvc\validator {

    use mvc\validator\validatorClass;
    use mvc\session\sessionClass as session;
    use mvc\request\requestClass as request;
    use mvc\routing\routingClass as routing;
    use mvc\config\myConfigClass as config;

    /**
     * Description of manoObraValidatorClass
     *
     * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
     */
    class pagoTrabajadorValidatorClass extends validatorClass {

        public static function validateInsert() {
            $flag = false;
//      $soloNumeros = "/^[[:digit:]]+$/";
      $soloLetras = "/^[a-z]+$/i";
      $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
      $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';
      
      //------------------------------------campo cantida horas extras---------------------
                //----campo nulo----
            if (self::notBlank(request::getInstance()->getPost(\pagoTrabajadorTableClass::getNameField(\pagoTrabajadorTableClass::CANTIDAD_HORAS_EXTRAS, true)))) {
                $flag = true;
                session::getInstance()->setFlash('inputCantidad', true);
                session::getInstance()->setError('La cantidad del documento es requerida', 'inputCantidad');
            } //----campo solo numeros----
              else if (!is_numeric(request::getInstance()->getPost(\pagoTrabajadorTableClass::getNameField(\pagoTrabajadorTableClass::CANTIDAD_HORAS_EXTRAS, true)))) {
                $flag = true;
                session::getInstance()->setFlash('inputCantidad', true);
                session::getInstance()->setError('La cantidad no puede ser letras', 'inputCantidad');
            } //----campo sobre pasa caracteres----
            else if(strlen(request::getInstance()->getPost(\pagoTrabajadorTableClass::getNameField(\pagoTrabajadorTableClass::CANTIDAD_HORAS_EXTRAS, true))) > \pagoTrabajadorTableClass::CANTIDAD_HORAS_EXTRAS_LENGTH) {
                $flag = true;
                session::getInstance()->setFlash('inputCantidad', true);
                session::getInstance()->setError('La catidad digitada sobre pasa los caracteres permitidos', 'inputCantidad');
            }  ///--------------- campo valor salario -----------------------------------  
              //----campo nulo----
            if (self::notBlank(request::getInstance()->getPost(\pagoTrabajadorTableClass::getNameField(\pagoTrabajadorTableClass::VALOR_SALARIO, true)))) {
                $flag = true;
                session::getInstance()->setFlash('inputValor', true);
                session::getInstance()->setError('El valor es requerido', 'inputValor');
            } else if (!is_numeric(request::getInstance()->getPost(\pagoTrabajadorTableClass::getNameField(\pagoTrabajadorTableClass::VALOR_SALARIO, true)))) {
                $flag = true;
                session::getInstance()->setFlash('inputValor', true);
                session::getInstance()->setError('El valor no puede ser letras', 'inputValor');
            } else if(strlen(request::getInstance()->getPost(\pagoTrabajadorTableClass::getNameField(\pagoTrabajadorTableClass::VALOR_SALARIO, true))) > \pagoTrabajadorTableClass::VALOR_SALARIO_LENGTH) {
                $flag = true;
                session::getInstance()->setFlash('inputValor', true);
                session::getInstance()->setError('La catidad digitado sobre pasa los caracteres permitidos', 'inputValor');
            }    //--------------------campo valor horas extras----------------------
            if (self::notBlank(request::getInstance()->getPost(\pagoTrabajadorTableClass::getNameField(\pagoTrabajadorTableClass::VALOR_HORAS_EXTRAS, true)))) {
                $flag = true;
                session::getInstance()->setFlash('inputHoras', true);
                session::getInstance()->setError('Las horas extras son requeridas', 'inputHoras');
            } else if (!is_numeric(request::getInstance()->getPost(\pagoTrabajadorTableClass::getNameField(\pagoTrabajadorTableClass::VALOR_HORAS_EXTRAS, true)))) {
                $flag = true;
                session::getInstance()->setFlash('inputHoras', true);
                session::getInstance()->setError('Las horas extras no puede ser letras', 'inputHoras');
            } else if(strlen(request::getInstance()->getPost(\pagoTrabajadorTableClass::getNameField(\pagoTrabajadorTableClass::VALOR_HORAS_EXTRAS, true))) > \pagoTrabajadorTableClass::VALOR_HORAS_EXTRAS_LENGTH) {
                $flag = true;
                session::getInstance()->setFlash('inputHoras', true);
                session::getInstance()->setError('La catidad digitado sobre pasa los caracteres permitidos', 'inputHoras');
            }  //-------------------------------- campo horas perdidas ---------------------------  
            if (self::notBlank(request::getInstance()->getPost(\pagoTrabajadorTableClass::getNameField(\pagoTrabajadorTableClass::HORAS_PERDIDAS, true)))) {
                $flag = true;
                session::getInstance()->setFlash('inputHorasPerdidas', true);
                session::getInstance()->setError('Las horas perdidas son requeridas', 'inputHorasPerdidas');
            } else if (!is_numeric(request::getInstance()->getPost(\pagoTrabajadorTableClass::getNameField(\pagoTrabajadorTableClass::HORAS_PERDIDAS, true)))) {
                $flag = true;
                session::getInstance()->setFlash('inputHorasPerdidas', true);
                session::getInstance()->setError('Las horas perdidas no puede ser letras', 'inputHorasPerdidas');
            } else if(strlen(request::getInstance()->getPost(\pagoTrabajadorTableClass::getNameField(\pagoTrabajadorTableClass::HORAS_PERDIDAS, true))) > \pagoTrabajadorTableClass::HORAS_PERDIDAS_LENGTH) {
                $flag = true;
                session::getInstance()->setFlash('inputHorasPerdidas', true);
                session::getInstance()->setError('La catidad digitado sobre pasa los caracteres permitidos', 'inputHorasPerdidas');
            }//--------------------------campo total pagar -----------------------------------
            if (self::notBlank(request::getInstance()->getPost(\pagoTrabajadorTableClass::getNameField(\pagoTrabajadorTableClass::TOTAL_PAGAR, true)))) {
                $flag = true;
                session::getInstance()->setFlash('inputTotal', true);
                session::getInstance()->setError('El total es requerido', 'inputTotal');
            } else if (!is_numeric(request::getInstance()->getPost(\pagoTrabajadorTableClass::getNameField(\pagoTrabajadorTableClass::TOTAL_PAGAR, true)))) {
                $flag = true;
                session::getInstance()->setFlash('inputTotal', true);
                session::getInstance()->setError('El total no puede ser letras', 'inputTotal');
            } else if(strlen(request::getInstance()->getPost(\pagoTrabajadorTableClass::getNameField(\pagoTrabajadorTableClass::TOTAL_PAGAR, true))) > \pagoTrabajadorTableClass::TOTAL_PAGAR_LENGTH) {
               
              //---------------------condiccion de bandera true----------------------------
              $flag = true;
                session::getInstance()->setFlash('inputTotal', true);
                session::getInstance()->setError('La catidad digitado sobre pasa los caracteres permitidos', 'inputTotal');
               }

            if ($flag === true) {
                //request::getInstance()->setMethod('GET');
                routing::getInstance()->forward('pagoTrabajador', 'insert');
            }
        }

    }

}