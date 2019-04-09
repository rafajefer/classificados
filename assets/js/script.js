$(function(){


	/* 
	//Exibe texto campo obrigatório no input nome
	$("#form-register [name=nome]").bind('blur', function(){
		var teste = $(this).val();
		if(teste == '') {
			$(this).css("border", "2px solid red");
			var labelFor = $("label[for=nome]").html() + "Rafael";

			$("label[for=nome]").append(" <sup style='color:red'>*Campo obrigatório</sup>");
		}
	});
	*/
	$("#register2").bind('click', function(e){
		e.preventDefault();

		var nome = $("#form-register [name=nome]").val();
		var email = $("#form-register [name=email]").val();
		var senha = $("#form-register [name=senha]").val();
		var tel = $("#form-register [name=tel]").val();

		
		var link = $("#form-register").attr('action');

		$.ajax({
			url: link,
			type: 'POST',
			success: function() {
				var novaURL = "http://localhost/cursos/php/poo/mvc/classificados/register/success";
				$(window.document.location).attr('href', novaURL);
			}
			error:  function(){
				var novaURL = "http://localhost/cursos/php/poo/mvc/classificados/register/error";
				$(window.document.location).attr('href', novaURL);
			}
		});
	});
});