<?php

class mdlMatricula
{

  public $idMatricula;
  public $fechaMatricula;
  public $estado;
  public $idCurso;
  public $idEstudiante;
  public $idUsuario;
  public $db;

  public function __construct($db){
    try {
      $this->db = $db;

    } catch (PDOException $e) {
      exit("No se pudo conectar con la base de datos ".$e->getMessage());

    }

  }

  public function __SET($atributo, $valor){
      $this->$atributo = $valor;
  }

  public function __GET($atributo){
      return $this->$atributo;
  }

  public function listaCursos(){
    $sql = "CALL sp_listaCursos()";
    $consulta = $this->db->prepare($sql);
    $consulta->execute();
    return $consulta->fetchAll(PDO::FETCH_ASSOC);
  }

  public function listaEstudiantes(){
    $sql = "CALL sp_listaEstudiantes()";
    $consulta = $this->db->prepare($sql);
    $consulta->execute();
    return $consulta->fetchAll(PDO::FETCH_ASSOC);
  }

  public function crearMatricula(){
   $sql = "CALL sp_insertarMatricula(?,?,?,?,?)";
   $consulta = $this->db->prepare($sql);
   $consulta->bindParam(1, $this->fechaMatricula);
   $consulta->bindParam(2, $this->estado);
   $consulta->bindParam(3, $this->idCurso);
   $consulta->bindParam(4, $this->idEstudiante);
   $consulta->bindParam(5, $this->idUsuario);
   $res = $consulta->execute();
   return $res;
 }

 public function listaMatriculas(){
   $sql = "CALL sp_listaMatriculas()";
   $consulta = $this->db->prepare($sql);
   $consulta->execute();
   return $consulta->fetchAll(PDO::FETCH_ASSOC);
 }

 public function cambiarEstado(){
   $sql = "CALL sp_cambiarEstado(?)";
   $consulta = $this->db->prepare($sql);
   $consulta->bindParam(1, $this->idMatricula);
   $res = $consulta->execute();
   return $res;
 }

}

 ?>
