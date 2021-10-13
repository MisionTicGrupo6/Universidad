<div class="box box-solid">
  <div class="box-header with-border">
    <h3 class="box-title">Gestión de matriculas</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <div class="box-group" id="accordion">
      <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
      <div class="panel box box-danger">
        <div class="box-header with-border">
          <h4 class="box-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
              Registrar Matricula
            </a>
          </h4>
        </div>
        <div id="collapseOne" class="panel-collapse collapse in">
          <div class="box-body">
            <form class="" method="post">
              <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                        <label for="txtFechaMatricula">Fecha de Matricula</label>
                        <input type="date" name="txtFechaMatricula" class="form-control" value="" required>
                      </div>
                      <div class="form-group">
                        <label for="selCursos">Curso</label>
                        <select class="form-control" name="selCursos">
                          <option value="" selected="selected">Seleccione</option>
                          <?php foreach ($cursos as $value): ?>
                            <option value="<?= $value['IdCurso']; ?>"> <?= $value['Curso']; ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="selEstudiantes">Estudiante</label>
                        <select class="form-control" name="selEstudiantes">
                          <option value="" selected="selected">Seleccione</option>
                          <?php foreach ($estudiantes as $value): ?>
                            <option value="<?= $value['IdEstudiante']; ?>"> <?= $value['Nombres']; ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                  <div class="col-md-6">
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
      <div class="panel box box-danger">
        <div class="box-header with-border">
          <h4 class="box-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
              Lista de Matriculas
            </a>
          </h4>
        </div>
        <div id="collapseTwo" class="panel-collapse collapse">
          <div class="box-body">
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                          <th>Codigo</th>
                          <th>Fecha Matricula</th>
                          <th>Curso</th>
                          <th>Documento</th>
                          <th>Nombre Estudiante</th>
                          <th>Estado</th>
                          <th>Opciones</th>
                        </thead>
                        <tbody>
                          <?php foreach ($matriculas as $data): ?>
                          <tr>
                            <td><?= $data["IdMatricula"]; ?></td>
                            <td><?= $data["FechaMatricula"]; ?></td>
                            <td><?= $data["Curso"]; ?></td>
                            <td><?= $data["Documento"]; ?></td>
                            <td><?= $data["Nombres"]; ?></td>
                            <td><?php if($data["Estado"]==1) : ?>
                                <label class="label label-success">Activo</label>
                              <?php else: ?>
                                <label class="label label-danger">Inactivo</label>
                              <?php endif; ?>
                            </td>
                            <td>
                              <?php if ($data["Estado"] == 0) : ?>
                              <button type="button" class="btn btn-info btn-xs" title="Cambiar Estado" onclick="cambiarEstado('<?= $data["IdMatricula"]; ?>');"><i class="fa fa-check"></i></button>
                              <?php else: ?>
                              <button type="button" class="btn btn-danger btn-xs" title="Cambiar Estado" onclick="cambiarEstado('<?= $data["IdMatricula"]; ?>');"><i class="fa fa-times"></i></button>
                              <?php endif; ?>
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
  </div>
  <!-- /.box-body -->
</div>

<script type="text/javascript">
  //Cambiar estado
  function cambiarEstado(id){
    //alert(id);
    swal({
      title: "¿Estas seguro de cambiar el estado de la matricula?",
      type: "warning",
      cancelButtonText: "Cancelar",
      showCancelButton: true,
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Aceptar",
      closeOnConfirm: false
    },
    function(isConfirm){
      if (isConfirm) {
        swal({
          title: "Estado Cambiado",
          tyoe: "Success",
          confirmButtonText: "Aceptar",
          closeOnConfirm: false,
          closeOnCancel: false
        },
        function(isConfirm){
          $.ajax({
            type: "POST",
            url: url+"Matricula/cambiarEstado",
            data: {'id': id}
          }).done(function(respuesta){
            if (respuesta == "1") {
              window.location = url+"Matricula/adminMatricula";
            }else {
              sweetAlert("Error al cambiar el estado");
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
