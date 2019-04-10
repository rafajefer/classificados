<form action="<?php echo BASE_URL;?>anuncios/insert" method="POST">
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
			    <label for="estado">Estado de Conservação:</label>
			    <select name="estado" class="form-control">
					   <option>Ruim</option>
					   <option>Bom</option>
					   <option>Ótimo</option>
				</select>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group">
			    <label for="descricao">Descrição:</label>
			    <textarea class="form-control" name="descricao" rows="5"></textarea>
			</div>
		</div>
		<div class="col-md-12 text-right">
			<button type="submit" class="btn btn-dark">Salvar</button>
		</div>
	</div>
</form>