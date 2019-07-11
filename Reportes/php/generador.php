<!-- Modal -->
<div class="modal fade" id="generar" name="generar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">SALDOS DE INVERSIÓN Y DEPRECIACIÓN POR CUENTA CONTABLE</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-1"></div>
          <div class="col-md-10 form-group">
            <label>Centro de trabajo</label>
            <select class="custom-select form-control" name="clavectx" id="clavectx"></select>
          </div>
          <div class="col-md-1"></div>
        </div>
        <div class="row">
          <div class="col-md-1"></div>
          <div class="col-md-10 form-group" >
            <label for="fechai">Fecha inicial:</label>
            <input class="form-control" type="date" name="fechai" id="fechai">
          </div>
          <div class="col-md-1"></div>
        </div>
        <div class="row">
          <div class="col-md-1"></div>
          <div class="col-md-10 form-group" >
            <label for="fechaf">Fecha final:</label>
            <input class="form-control" type="date" name="fechaf" id="fechaf">
          </div>
          <div class="col-md-1"></div>
        </div>
      </div>
      <div class="modal-footer" id="botones">
        <button type="button" class="btn btn-success" onclick="generate()">Guardar</button>
        <button type="button" class="cancan btn btn-danger" data-dismiss="modal" onclick="cancels()">Cerrar</button>
      </div>
    </div>
  </div>
</div>


<!--Me agradaria poner opciones apra exporta la informacion a diferentes tipos de archivo-->
