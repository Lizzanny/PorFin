<!-- Modal -->
<div class="modal fade" id="agregarUsu" name="agregarUsu">
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
    
            <div class="col-md-12 form-group">
              <label class="col-form-label-sm">CENCOS-CT CLAVE</label>
              <select class="form-control form-control-sm" name="ccoctcve" id="ccoctcve"></select>
            </div>
    
            <div class="col-md-12 form-group" >
              <label class="col-form-label-sm" >CENCOS CLAVE</label>
              <select class="form-control form-control-sm"id="cvecencos" name="cvecencos">
                <option>SELECCIONE UN CENTRO DE TRABAJO</option>
              </select>          
            </div>
        
            <div class="col-md-12 form-group" >
              <label class="col-form-label-sm" for="numeronna">RH NUMNOMI:</label>
              <input class="form-control form-control-sm" type="number" name="numeronna" id="numeronna" >
            </div>
  
            <div class="col-md-12 form-group">
              <label class="col-form-label-sm" for="nombreusr">NOMBRE:</label>
              <input class="form-control form-control-sm" type="text" name="nombreusr" id="nombreusr" disabled="disabled">
            </div>
  
            <div class="col-md-12 form-group" >
              <label class="col-form-label-sm" for="usuarious">USUARIO:</label>
              <input class="form-control form-control-sm" type="text" name="usuarious" id="usuarious">
            </div>
  
            <div class="col-md-12 form-group" >
              <label class="col-form-label-sm" for="contrasen">CONTRASEÑA:</label>
              <input class="form-control form-control-sm" type="password" name="contrasen" id="contrasen">
            </div>
  
            <div class="col-md-12 form-group" >
              <label class="col-form-label-sm" for="claverolx">ROL:</label>
              <select class="form-control form-control-sm"id="claverolx" name="claverolx">
                <option value="">SELECCIONE UN ROL</option>
                <option value="RFINPRESUP">INFORMACIÓN FINANCIERA</option>
                <option value="RFINCONTABLE">INFORMACIÓN CONTABLE</option>
                <option value="AMBOS">INFORMACIÓN FINANCIERA/CONTABLE</option>
              </select> 
            </div>
          </div>
        </div>
        
      <div class="modal-footer" id="botones">
        <button type="button" class="btn btn-success" id="guardaUsuario" name="guardaUsuario">Guardar</button>
        <button type="button" class="cancan btn btn-danger" data-dismiss="modal" onclick="">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!--Me agradaria poner opciones apra exporta la informacion a diferentes tipos de archivo-->
