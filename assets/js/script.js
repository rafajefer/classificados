$(function(){

	/* Carrega dados no modal do anuncio via ajax */
	$('.modal_ajax').bind('click', function(e) {
		// Cancela ação do href
		e.preventDefault();

		// pega o valor do atributo data-ajax
		var data_ajax = $(this).attr('data-ajax');

		// pega o valor do atributo href		
		var link = $(this).attr('href');

		// Altera o title de acordo com data_ajax
		if(data_ajax == 'add_anuncio') {
			var title = "Adicionar Anúncio";
		}else if(data_ajax == 'edit_anuncio'){
			var title = "Editar Anúncio";
		}
		// Altera o titulo antes de exibir o modal
		$('.modal .modal-header .modal-title').html(title);

		// Exibe o modal
		$('.modal').modal('show');

		// Busca os dados via ajax de acordo com link
		$.ajax({
			url: link,
			type: 'GET',
			success: function(html){
				$('.modal .modal-body').html(html);
			}
		});		
		
	});
});