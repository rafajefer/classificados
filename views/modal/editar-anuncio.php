<!-- The Modal -->
  <div class="modal fade" id="modalAnuncioEditar">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Editar Anúncio</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          	<form action="<?php echo BASE_URL;?>anuncios/editar" method="POST">
          		<div class="row">
          			<div class="col-md-4">
						<div class="form-group">
						    <label for="categoria">Categoria:</label>
						    <select name="categoria" class="form-control">
						    	<option value="1">t</option>
						    </select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
						    <label for="titulo">Título:</label>
						    <input type="text" class="form-control" name="titulo" id="titulo">
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
						    <label for="valor">Valor:</label>
						    <input type="text" class="form-control" name="valor" id="valor">
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
						    <label for="conservacao">Estado de Conservação:</label>
						    <select name="conservacao" class="form-control">
								   <option value="1">Ruim</option>
								   <option value="2">Bom</option>
								   <option value="3">Ótimo</option>
							</select>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
						    <label for="descricao">Descrição:</label>
						    <textarea class="form-control" name="descricao" rows="5"></textarea>
						</div>
					</div>
					<div class="col-md-12">
						<button type="submit" class="btn btn-primary">Entrar</button>
					</div>
				</div>
			</form>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>