<!-- Modal -->
<div class="modal fade" id="agregaRol" name="agregaRol">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">ALTA USUARIO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div class="row">
    
  
            <div class="col-md-12 form-group" >
              <label class="col-form-label-sm" for="claverolx">ROL:</label>
              <select class="form-control form-control-sm"id="claverolx" name="claverolx">
                <option value="">SELECCIONE UN ROL</option>
                <option value="RFINPRESUP">INFORMACIÓN FINANCIERA</option>
                <option value="RFINCONTABLE">INFORMACIÓN CONTABLE</option>
                <option value="RFINADM">INFORMACIÓN FINANCIERA/CONTABLE</option>
              </select> 
            </div>
          </div>
        </div>
        
      <div class="modal-footer" id="botones">
        <button type="button" class="btn btn-success" id="guardaUsuario" name="guardaUsuario">Guardar</button>
        <button type="button" class="btn btn-info" id="guardaUsuario" name="guardaUsuario">AgregarRol</button>
        <button type="button" class="cancan btn btn-danger" data-dismiss="modal" onclick="">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!--Me agradaria poner opciones apra exporta la informacion a diferentes tipos de archivo-->
