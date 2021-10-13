<?php
class Matricula extends Controller
{
  public $modeloMatricula;
  public function __construct(){
    $this->modeloMatricula = $this->loadModel("mdlMatricula");
  }
  public function adminMatricula()
  {
    if (isset($_POST['btnGuardar'])) {
        $estado = 1; $fecha = new DateTime($_POST['txtFechaMatricula']); $fechaF = new DateTime($fecha->format("Y-m-d"));
        $this->modeloMatricula->__SET('fechaMatricula', $_POST['txtFechaMatricula']);
        $this->modeloMatricula->__SET('estado', $estado);
        $this->modeloMatricula->__SET('idCurso', $_POST['selCursos']);
        $this->modeloMatricula->__SET('idEstudiante', $_POST['selEstudiantes']);
        $this->modeloMatricula->__SET('idUsuario', $_SESSION['idUsuario']);

        //var_dump($_POST['txtUsuario'], $_POST['txtClave'], $_POST['txtNombres']
        //,$_POST['txtCorreo'], $linea,$estado,$_POST['selRoles'],$_POST['txtDocumento']); exit;
        $insert = $this->modeloMatricula->crearMatricula();
        if ($insert == true) {
            $_SESSION['alerta'] ='
                  swal({
                    title: "Registro exitoso",
                    text: "La matricula ha sido registrado correctamente",
                    type: "success",
                    confirmButtonText: "Aceptar",
                    closeOnConfirm: false,
                    closeOnCancel: false
                  });
            ';
            header("Location:".URL."Matricula/adminMatricula");
            exit();
        }else{
          $_SESSION['alerta'] ='
                swal({
                  title: "Error!!!",
                  text: "Ha ocurrido un error al registrar por favor comuniquese a soporte tecnico",
                  type: "error",
                  confirmButtonText: "Aceptar",
                  closeOnConfirm: false,
                  closeOnCancel: false
                });
          ';
          header("Location:".URL."Matricula/adminMatricula");
          exit();
        }

      }

    $cursos = $this->modeloMatricula->listaCursos();
    $estudiantes = $this->modeloMatricula->listaEstudiantes();
    $matriculas = $this->modeloMatricula->listaMatriculas();
    require APP . 'view/_templates/header.php';
    require APP . 'view/matricula/adminMatricula.php';
    require APP . 'view/_templates/footer.php';

  }

  public function cambiarEstado(){
      $this->modeloMatricula->__SET("idMatricula", $_POST['id']);
      $es = $this->modeloMatricula->cambiarEstado();
      if ($es) {
        echo "1";
      }else {
        echo "0";
      }
    }

}

 ?>
