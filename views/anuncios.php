
<div class="container mt-5">
	<div class="row justify-content-center">
		<div class="col-12">
			<h1>Meus Anúncios</h1>
			<div class="clearfix">
				<div class="float-right">
					<a href="#" class="btn btn-secondary" data-toggle="modal" data-target="#modalAnuncioAdicionar">Adicionar Anúncio</a>
				</div>
			</div>
			<table class="table mt-3 table-striped">
			    <thead class="thead-dark">
			      <tr>
			        <th>Foto</th>
			        <th>Título</th>
			        <th>Valor</th>
			        <th>Ações</th>
			      </tr>
			    </thead>
			    <tbody>
			    <?php foreach($anuncios as $anuncio): ?> 
			      <tr >
			        <td width="150">
			        	<?php if(!empty($anuncio['url'])): ?>
			        	<img src="<?php echo BASE_URL."assets/images/anuncios/".$anuncio['url']; ?>" height="50" />
			        	<?php else: ?>
			        	<img src="<?php echo BASE_URL."assets/images/anuncios/default.jpg"; ?>" height="50" />
			        	<?php endif; ?>
			        </td>
			        <td class="align-middle"><?php echo $anuncio['titulo']; ?></td>
			        <td class="align-middle"><?php echo "R$". number_format($anuncio['valor'], 2, ",", "."); ?></td>
			        <td width="167" class="align-middle">
			        	<a href="<?php echo BASE_URL."anuncios/editar/".$anuncio['id'];?>" class="btn btn-sm btn-info" role="button" data-toggle="modal" data-target="#modalAnuncioEditar">Editar</a>
			        	<a href="<?php echo BASE_URL."anuncios/excluir/".$anuncio['id'];?>" class="btn btn-sm btn-danger"> Excluir</a>
			        </td>
			      </tr>
			    <?php endforeach; ?>
			    </tbody>
			  </table>
		</div>
	</div>
</div>


<!-- The Modal -->
  <div class="modal fade" id="modalAnuncioAdicionar">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Adicionar Anúncio</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          	<form action="<?php echo BASE_URL;?>anuncios/adicionar" method="POST">
          		<div class="row">
          			<div class="col-md-4">
						<div class="form-group">
						    <label for="categoria">Categoria:</label>
						    <select name="categoria" class="form-control">
						    	<?php foreach ($categorias as $cat): ?>
						    		<option value="<?php echo $cat['id'];?>"><?php echo $cat['nome']; ?></option>
						    	<?php endforeach;?>
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
						<button type="submit" class="btn btn-primary">Adicionar</button>
					</div>
				</div>
			</form>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
        </div>
        
      </div>
    </div>