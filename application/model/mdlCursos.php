<?php

class mdlCursos
{
  public $idCurso;
  public $curso;
  public $horas;
  public $nivel;
  public $valorCurso;
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

  public function crearCurso(){
    $sql = "CALL sp_insertarCurso(?,?,?,?)";
    $consulta = $this->db->prepare($sql);
    $consulta->bindParam(1, $this->curso);
    $consulta->bindParam(2, $this->horas);
    $consulta->bindParam(3, $this->nivel);
    $consulta->bindParam(4, $this->valorCurso);
    $res = $consulta->execute();
    return $res;
  }

  public function listaCursos(){
    $sql = "CALL sp_listaCursos()";
    $consulta = $this->db->prepare($sql);
    $consulta->execute();
    return $consulta->fetchAll(PDO::FETCH_ASSOC);
  }

  public function editarCurso(){
    $sql = "CALL sp_editarCurso(?,?,?,?)";
    $consulta = $this->db->prepare($sql);
    $consulta->bindParam(1, $this->idCurso);
    $consulta->bindParam(2, $this->horas);
    $consulta->bindParam(3, $this->nivel);
    $consulta->bindParam(4, $this->valorCurso);
    $res = $consulta->execute();
    return $res;
  }

  public function eliminarC(){
    $sql = "CALL sp_eliminarCurso(?)";
    $consulta = $this->db->prepare($sql);
    $consulta->bindParam(1, $this->idCurso);
    $res = $consulta->execute();
    return $res;
  }

}

 ?>
