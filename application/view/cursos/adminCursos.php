
<div class="box box-solid">
  <div class="box-header with-border">
    <h3 class="box-title">Gestión de cursos</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <div class="box-group" id="accordion">
      <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
      <div class="panel box box-primary">
        <div class="box-header with-border">
          <h4 class="box-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
              Registrar Curso
            </a>
          </h4>
        </div>
        <div id="collapseOne" class="panel-collapse collapse in">
          <div class="box-body">
            <form class="" method="post">

            <div class="row">
              <div class="col-md-6">
                <div class="from-group">
                  <label for="txtCurso">Curso</label>
                  <input type="text" name="txtCurso" class="form-control" value="" required>
                </div>
                <div class="from-group">
                  <label for="txtHoras">Horas </label>
                  <input type="text" name="txtHoras" class="form-control" value="" required>
                </div>
                <div class="from-group">
                  <label for="txtNivel">Nivel</label>
                  <input type="text" name="txtNivel" class="form-control" value="" required>
                </div>
                <div class="from-group">
                  <label for="txtCosto">Costo</label>
                  <input type="text" name="txtCosto" class="form-control" value="" required>
                </div>
                <br>
                <div class="form-group">
                  <button type="submit" class="btn btn-success" name="btnGuardar">Guardar</button>
                  <button type="button" class="btn btn-default" name="btnCancelar">Cancelar</button>
                </div>
              </div>
            </div>
          </form>
          </div>
        </div>
      </div>
      <div class="panel box box-primary">
        <div class="box-header with-border">
          <h4 class="box-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
              Lista de cursos
            </a>
          </h4>
        </div>
        <div id="collapseTwo" class="panel-collapse collapse">
          <div class="box-body">
            <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                          <th>Código</th>
                          <th>Curso</th>
                          <th>Horas</th>
                          <th>Nivel</th>
                          <th>Costo</th>
                          <th>Opciones</th>
                        </thead>
                        <tbody>
                  <?php foreach ($cursos as $data): ?>
                      <tr>
                        <td><?= $data["IdCurso"]; ?></td>
                        <td><?= $data["Curso"]; ?></td>
                        <td><?= $data["Horas"]; ?></td>
                        <td><?= $data["Nivel"]; ?></td>
                        <td><?= $data["ValorCurso"]; ?></td>
                        <td>
                            <button type="button" class="btn btn-primary btn-xs" title="Editar" onclick="editarC('<?= $data["IdCurso"]; ?>','<?=  $data["Curso"]; ?>','<?=  $data["Horas"]; ?>','<?=  $data["Nivel"]; ?>','<?=  $data["ValorCurso"]; ?>');
                              " data-toggle="modal" data-target="#modal-editar"><i class="fa fa-edit"></i> </button>
                            <button type="button" class="btn btn-danger btn-xs"  title="Eliminar" onclick="EliminarC('<?= $data["IdCurso"]; ?>');"><i class="fa fa-trash"></i> </button>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>

          </div>
        </div>
      </div>

    </div>
  </div>
  <!-- /.box-body -->
</div>
</div>

<div class="modal fade" id="modal-editar">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edite su curso</h4>
      </div>
      <form method="post">
        <div class="modal-body">
          <div class="container-fluid">
            <div class="form-group">
              <label for="">Curso</label>
              <input type="text" name="txtCursoC" id="txtCursoC" class="form-control" readonly>
              <input type="text" name="txtIdCursoC" id="txtIdCursoC"  hidden>

            </div>
            <div class="form-group">
              <label for="">Horas</label>
              <input type="text" name="txtHorasC" id="txtHorasC" class="form-control">
            </div>

            <div class="form-group">
              <label for="">Nivel</label>
              <input type="text" name="txtNivelC" id="txtNivelC" class="form-control">
            </div>

            <div class="form-group">
              <label for="">Valor Curso</label>
              <input type="text" name="txtCostoC" id="txtCostoC" class="form-control">
            </div>
          </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
        <button type="submit" name="btnActualizarC" class="btn btn-primary">Guardar Cambios</button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<script type="text/javascript">
function editarC(id, curso, horas, nivel, valorCurso){
  $('#txtIdCursoC').val(id);
  $('#txtCursoC').val(curso);
  $('#txtHorasC').val(horas);
  $('#txtNivelC').val(nivel);
  $('#txtCostoC').val(valorCurso);

  }

</script>

<script type="text/javascript">
//Cambiar Estado
function EliminarC(id){
  //alert(id+"Eliminar");
  swal({
    title: "¿Esta seguro de eliminar el curso?",
    type: "warning",
    cancelButtonText: "Cancelar",
    showCancelButton: true,
    confirmButtonClass: "btn-danger",
    confirmButtonText: "Aceptar",
    closeOnConfirm: false
  },
  function(isConfirm){
    if (isConfirm){
      swal({
        title: "Curso eliminado",
        type: "success",
        confirmButtonText: "Aceptar",
        closeOnConfirm: false,
        closeOnCancel: false
      },
      function(isConfirm){
        $.ajax({
            type: "POST",
            url: url+"Cursos/eliminarC",
            data: {'id': id}
        }).done(function(respuesta){
          if(respuesta == "1"){
            window.location = url+"Cursos/adminCursos";
          }else{
            sweetAlert("Error al eliminar el curso");
          }

        }).fail(function(error){
          console.log("Error: "+error)

        });
      }

    );

    }

  }
);
}


</script>
