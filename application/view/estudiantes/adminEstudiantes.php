
<div class="box box-solid">
  <div class="box-header with-border">
    <h3 class="box-title">Gestión de estudiantes</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <div class="box-group" id="accordion">
      <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
      <div class="panel box box-primary">
        <div class="box-header with-border">
          <h4 class="box-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
              Registrar Estudiante
            </a>
          </h4>
        </div>
        <div id="collapseOne" class="panel-collapse collapse in">
          <div class="box-body">
            <form class="" method="post">

            <div class="row">
              <div class="col-md-6">
                <div class="from-group">
                  <label for="txtDocumento">Documento</label>
                  <input type="text" name="txtDocumento" class="form-control" value="" required>
                </div>
                <div class="from-group">
                  <label for="txtNombres">Nombres</label>
                  <input type="text" name="txtNombres" class="form-control" value="" required>
                </div>
                <div class="from-group">
                  <label for="txtCorreo">Correo</label>
                  <input type="email" name="txtCorreo" class="form-control" value="" required>
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
              Lista de Estudiantes
            </a>
          </h4>
        </div>
        <div id="collapseTwo" class="panel-collapse collapse">
          <div class="box-body">
            <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                          <th>Código</th>
                          <th>Documento</th>
                          <th>Nombres</th>
                          <th>Correo</th>
                          <th>Opciones</th>
                        </thead>
                        <tbody>
                  <?php foreach ($estudiantes as $data): ?>
                      <tr>
                        <td><?= $data["IdEstudiante"]; ?></td>
                        <td><?= $data["Documento"]; ?></td>
                        <td><?= $data["Nombres"]; ?></td>
                        <td><?= $data["Correo"]; ?></td>
                        <td>
                            <button type="button" class="btn btn-primary btn-xs" title="Editar" onclick="editarE('<?= $data["IdEstudiante"]; ?>','<?=  $data["Documento"]; ?>','<?=  $data["Nombres"]; ?>','<?=  $data["Correo"]; ?>');
                              " data-toggle="modal" data-target="#modal-editar"><i class="fa fa-edit"></i> </button>
                            <button type="button" class="btn btn-danger btn-xs"  title="Eliminar" onclick="EliminarE('<?= $data["IdEstudiante"]; ?>');"><i class="fa fa-trash"></i> </button>
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
        <h4 class="modal-title">Edite el estudiante</h4>
      </div>
      <form method="post">
        <div class="modal-body">
          <div class="container-fluid">
            <div class="form-group">
              <label for="">Documento</label>
              <input type="text" name="txtDocumentoE" id="txtDocumentoE" class="form-control" readonly>
              <input type="text" name="txtIdEstudianteE" id="txtIdEstudianteE"  hidden>

            </div>
            <div class="form-group">
              <label for="">Nombres</label>
              <input type="text" name="txtNombresE" id="txtNombresE" class="form-control">
            </div>

            <div class="form-group">
              <label for="">Correo</label>
              <input type="text" name="txtCorreoE" id="txtCorreoE" class="form-control">
            </div>

          </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
        <button type="submit" name="btnActualizarE" class="btn btn-primary">Guardar Cambios</button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<script type="text/javascript">
function editarE(id, documento, nombres, correo){
  $('#txtIdEstudianteE').val(id);
  $('#txtDocumentoE').val(documento);
  $('#txtNombresE').val(nombres);
  $('#txtCorreoE').val(correo);

  }

</script>

<script type="text/javascript">
//Cambiar Estado
function EliminarE(id){
  //alert(id+"Eliminar");
  swal({
    title: "¿Esta seguro de eliminar el estudiante?",
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
        title: "Estudiante eliminado",
        type: "success",
        confirmButtonText: "Aceptar",
        closeOnConfirm: false,
        closeOnCancel: false
      },
      function(isConfirm){
        $.ajax({
            type: "POST",
            url: url+"Estudiante/eliminarE",
            data: {'id': id}
        }).done(function(respuesta){
          if(respuesta == "1"){
            window.location = url+"Estudiante/adminEstudiantes";
          }else{
            sweetAlert("Error al eliminar el estudiante");
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
