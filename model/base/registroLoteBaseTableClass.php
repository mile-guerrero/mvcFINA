<?php

use mvc\model\table\tableBaseClass;

/**
 * Description of loteClass
 *
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
 */
class registroLoteBaseTableClass extends tableBaseClass {
  
  private $id;
  private $ubicacion;
  private $unidadMedidaId;
  private $fechaRiego;
  private $numeroPlantulas;
  private $produccion;
  private $productoInsumoId;
  private $createdAt;

  const ID = 'id';
  const UBICACION = 'ubicacion';
  const UBICACION_LENGTH = 400;
  const NUMERO_PLANTULAS = 'numero_plantulas';
  const NUMERO_PLANTULAS_LENGTH = 30;
  const PRODUCCION = 'produccion';
  const PRODUCCION_LENGTH = 30;
  const UNIDAD_MEDIDA_ID = 'unidad_medida_id'; 
  const FECHA_RIEGO = 'fecha_riego';
  const PRODUCTO_INSUMO_ID = 'producto_insumo_id';
  const CREATED_AT = 'created_at';

 
  public function get_id() {
    return $this->id;
  }

  public function get_ubicacion() {
    return $this->ubicacion;
  }

  public function get_unidadMedidaId() {
    return $this->unidadMedidaId;
  }

  public function get_fechaRiego() {
    return $this->fechaRiego;
  }

  public function get_numeroPlantulas() {
    return $this->numeroPlantulas;
  }

  public function get_produccion() {
    return $this->produccion;
  }

  public function get_productoInsumoId() {
    return $this->productoInsumoId;
  }

  public function get_createdAt() {
    return $this->createdAt;
  }

  public function set_id($id) {
    $this->id = $id;
  }

  public function set_ubicacion($ubicacion) {
    $this->ubicacion = $ubicacion;
  }

  public function set_unidadMedidaId($unidadMedidaId) {
    $this->unidadMedidaId = $unidadMedidaId;
  }

  public function set_fechaRiego($fechaRiego) {
    $this->fechaRiego = $fechaRiego;
  }

  public function set_numeroPlantulas($numeroPlantulas) {
    $this->numeroPlantulas = $numeroPlantulas;
  }

  public function set_produccion($produccion) {
    $this->produccion = $produccion;
  }

  public function set_productoInsumoId($productoInsumoId) {
    $this->productoInsumoId = $productoInsumoId;
  }

  public function set_createdAt($createdAt) {
    $this->createdAt = $createdAt;
  }

        
  /**
   * Obtiene el nombre de la tabla
   * @return string
   */
  static public function getNameTable() {
    return 'registro_lote';
  }

  /**
   * Método para obtener el nombre del campo más la tabla ya sea en formato
   * DB (.) o en formato HTML (_)
   *
   * @param string $field Nombre del campo
   * @param string $html [optional] Por defecto traerá el nombre del campo en
   * versión DB
   * @return string
   */
  public static function getNameField($field, $html = false, $table = null) {
    return parent::getNameField($field, self::getNameTable(), $html);
  }

  /**
   * Método para borrar un registro de una tabla X en la base de datos
   *
   * @param array $ids Array con los campos por posiciones
   * asociativas y los valores por valores a tener en cuenta para el borrado.
   * Ejemplo $fieldsAndValues['id'] = 1
   * @param boolean $deletedLogical [optional] Borrado lógico o
   * borrado físico [por defecto] de un registro en una tabla de la base de datos
   * @return \PDOException|boolean
   */
  public static function delete($ids, $deletedLogical = true, $table = null) {
    return parent::delete($ids, $deletedLogical, self::getNameTable());
  }

  /**
   * Método para insertar en una tabla usuario
   *
   * @param array $data Array asociativo donde las claves son los nombres de
   * los campos y su valor sería el valor a insertar. Ejemplo:
   * $data['nombre'] = 'Erika'; $data['apellido'] = 'Galindo';
   * @return \PDOException|boolean
   */
  public static function insert($data, $table = null) {
    return parent::insert(self::getNameTable(), $data);
  }

  /**
   * Método para leer todos los registros de una tabla
   *
   * @param array $fields Array con los nombres de los campos a solicitar
   * @param boolean $deletedLogical [optional] Indicación de borrado lógico
   * o borrado físico
   * @param array $orderBy [optional] Array con el o los nombres de los campos
   * por los cuales se ordenará la consulta
   * @param string $order [optional] Forma de ordenar la consulta
   * (por defecto NULL), pude ser ASC o DESC
   * @param integer $limit [optional] Cantidad de resultados a mostrar
   * @param integer $offset [optional] Página solicitadad sobre la cantidad
   * de datos a mostrar
   * @return mixed una instancia de una clase estandar, la cual tendrá como
   * variables publica los nombres de las columnas de la consulta o una
   * instancia de \PDOException en caso de fracaso.
   */
  public static function getAll($fields, $deletedLogical = true, $orderBy = null, $order = null, $limit = null, $offset = null,$where = null, $table = null) {
    return parent::getAll(self::getNameTable(), $fields, $deletedLogical, $orderBy, $order, $limit, $offset, $where, $table);
  }

  /**
   * Método para actualizar un registro en una tabla de una base de datos
   *
   * @param array $ids Array asociativo con las posiciones por nombres de los
   * campos y los valores son quienes serían las llaves a buscar.
   * @param array $data Array asociativo con los datos a modificar,
   * las posiciones por nombres de las columnas con los valores por los nuevos
   * datos a escribir
   * @return \PDOException|boolean
   */
  public static function update($ids, $data, $table = null) {
    return parent::update($ids, $data, self::getNameTable());
  }

}
