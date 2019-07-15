<!-- Modal -->
<div class="modal fade" id="editarUsu" name="editarUsu">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">EDITAR USUARIO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div class="row">
    
            <div class="col-md-12 form-group">
              <label class="col-form-label-sm">CENCOS-CT CLAVE</label>
              <select class="form-control form-control-sm" name="Eccoctcve" id="Eccoctcve"></select>
            </div>
    
            <div class="col-md-12 form-group" >
              <label class="col-form-label-sm" >CENCOS CLAVE</label>
              <select class="form-control form-control-sm"id="Ecvecencos" name="Ecvecencos">
                <option>SELECCIONE UN CENTRO DE TRABAJO</option>
              </select>          
            </div>
        
            <div class="col-md-12 form-group" >
              <label class="col-form-label-sm" for="numeronna">RH NUMNOMI:</label>
              <input class="form-control form-control-sm" type="number" name="Enumeronna" id="Enumeronna" >
            </div>
  
            <div class="col-md-12 form-group">
              <label class="col-form-label-sm" for="nombreusr">NOMBRE:</label>
              <input class="form-control form-control-sm" type="text" name="Enombreusr" id="Enombreusr" disabled="disabled">
            </div>
  
            <div class="col-md-12 form-group" >
              <label class="col-form-label-sm" for="usuarious">USUARIO:</label>
              <input class="form-control form-control-sm" type="text" name="Eusuarious" id="Eusuarious" disabled="disabled">
            </div>
  
            <div class="col-md-12 form-group" >
              <label class="col-form-label-sm" for="Econtrasen">CONTRASEÑA:</label>
              <div class="input-group mb-3 input-group-sm">
                <div class="input-group-prepend">
                  <a type="button" id="boton1" name="boton1" title=""><span class="input-group-text far fa-eye"></span></a>
                </div>
                <input type="text" class="form-control form-control-sm" name="Econtrasen" id="Econtrasen">
              </div>
            </div>
  
            <div class="col-md-12 form-group" >
              <label class="col-form-label-sm" for="Eclaverolx">ROL:</label>
              <select class="form-control form-control-sm"id="Eclaverolx" name="Eclaverolx">
                <option value="">SELECCIONE UN ROL</option>
                <option value="RFINPRESUP">INFORMACIÓN FINANCIERA</option>
                <option value="RFINCONTABLE">INFORMACIÓN CONTABLE</option>
                <option value="RFINADM">INFORMACIÓN FINANCIERA/CONTABLE</option>
              </select> 
            </div>
          </div>
        </div>
        
      <div class="modal-footer" id="botones">
        <button type="button" class="btn btn-success" id="actualizaUsuario" name="actualizaUsuario">Guardar</button>
        <button type="button" class="cancan btn btn-danger" data-dismiss="modal" onclick="limpiar()">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!--Me agradaria poner opciones apra exporta la informacion a diferentes tipos de archivo-->
