
<div class="container mt-5">
	<div class="row justify-content-center">
		<div class="col-12">
			<h1>Meus Anúncios</h1>
			<div class="clearfix">
				<div class="float-right">
					<a href="<?php echo BASE_URL."anuncios/adicionar";?>" class="btn btn-secondary modal_ajax" data-ajax="add_anuncio">Adicionar Anúncio</a>
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
			        	<a href="<?php echo BASE_URL."anuncios/editar/".$anuncio['id'];?>" class="btn btn-sm btn-info modal_ajax" data-ajax="edit_anuncio">Editar</a>
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
  <div class="modal fade" id="modalAnuncioAdicionar"  tabindex='-1'>
    <div class="modal-dialog modal-lg">
      <div class="modal-content">      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title"></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>        
        <!-- Modal body -->
        <div class="modal-body">
          	
        </div>        
      </div>
    </div>