<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of cooperativaTableClass
 *
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
 */
class cooperativaTableClass extends cooperativaBaseTableClass {

    public static function getTotalPages($lines, $where) {
        try {
            $sql = 'SELECT count(' . cooperativaTableClass::ID . ') AS cantidad ' .
                    ' FROM ' . cooperativaTableClass::getNameTable() .
                    ' WHERE ' . cooperativaTableClass::DELETED_AT . ' IS NULL ';
            
            if (is_array($where) === true){
          foreach ($where as $field => $value){
              if (is_array($value)){
                  $sql = $sql . ' AND ' . $field . ' BETWEEN ' . ((is_numeric($value[0])) ? $value[0] : "'$value[0]'") . ' AND ' . ((is_numeric($value[1]) ? $value[1] : "'$value[1]'"));
              }  if(is_numeric($field)) {
                  $sql = $sql . 'AND ' . $value;
              } else {
                  $sql = $sql . ' AND ' . ' = ' . ((is_numeric($value)) ? $value : "'$value'");
              }
          }
      }
            
            $answer = model::getInstance()->prepare($sql);
            $answer->execute();
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
            return ceil($answer[0]->cantidad / $lines);
        } catch (PDOException $exc) {
            throw $exc;
        } catch (PDOException $exc) {
            throw $exc;
        }
    }

    public static function getNameCooperativa($id) {
        try {
            $sql = 'SELECT ' . cooperativaTableClass::NOMBRE . ' As descripcion  '
                    . '  FROM ' . cooperativaTableClass::getNameTable() . '  '
                    . '  WHERE ' . cooperativaTableClass::ID . ' = :id';
            $params = array(
                ':id' => $id
            );
            $answer = model::getInstance()->prepare($sql);
            $answer->execute($params);
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
            return $answer[0]->descripcion;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

}
