
<div class="container mt-5">
	<div class="row">
		<div class="col-sm-12">
			<h2>Cadastre-se</h2>
			<div class="alert alert-success alert-dismissible fade show <?php echo (!empty($_SESSION['msg']))? '' : 'd-none';?>">
		    	<button type="button" class="close" data-dismiss="alert">&times;</button>
		    	<?=$_SESSION['msg']['emailExistente']?>
		  	</div>
			<div class="alert alert-dark alert-dismissible fade show d-none">
		    	<button type="button" class="close" data-dismiss="alert">&times;</button>
		    	<strong>Campos obrigatórios!</strong> Por favor, preencha todos os campos.
		  	</div>
		  	<div class="alert alert-success alert-dismissible fade show d-none">
		    	<button type="button" class="close" data-dismiss="alert">&times;</button>
		    	<strong>Parabéns!</strong> Cadastrado com sucesso. <a href="<?php BASE_URL;?>login" class="alert-link">Faça login agora</a>
		  	</div>
			<form action="<?php echo BASE_URL; ?>register/verificar" method="POST" id="form-register">
		    	<div class="form-group">
		      		<label for="nome">Nome:</label>
		      		<input type="text" class="form-control" id="nome" name="nome" autofocus="autofocus">
		    	</div>
		    	<div class="form-group">
		      		<label for="email">E-mail:</label>
		      		<input type="email" class="form-control" id="email" name="email">
		    	</div>
		    	<div class="form-group">
		      		<label for="senha">Senha:</label>
		      		<input type="password" class="form-control" id="senha" name="senha">
		    	</div>
		    	<div class="form-group">
		      		<label for="tel">Telefone:</label>
		      		<input type="text" class="form-control" id="tel" name="tel">
		    	</div>
		    	<button type="submit" class="btn btn-dark" id="register">Cadastrar</button>
		  </form>
		</div>
	</div>
</div>
