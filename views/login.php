<div class="container mt-5">
	<div class="row justify-content-center">
		<div class="col- 6 col-sm-4 col-md-6 ">
			<div class="alert alert-danger alert-dismissible fade show <?php echo (!empty($_SESSION['msg']))? '' : 'd-none';?>">
		    	<button type="button" class="close" data-dismiss="alert">&times;</button>
		    	Usuário e/ou Senha errados!		  	</div>	
			<div class="card">
			  <div class="card-header">Login</div>
			  <div class="card-body">
			  	<form action="<?php echo BASE_URL;?>login/verificar" method="POST">
				  <div class="form-group">
				    <label for="email">Email address:</label>
				    <input type="email" class="form-control" name="email" id="email">
				  </div>
				  <div class="form-group">
				    <label for="senha">Password:</label>
				    <input type="password" class="form-control" name="senha" id="senha">
				  </div>
				  <div class="form-group form-check">
				    <label class="form-check-label">
				      <input class="form-check-input" type="checkbox"> Remember me
				    </label>
				  </div>
				  <button type="submit" class="btn btn-primary">Entrar</button>
				</form>

			  </div> 
			  <div class="card-footer">Footer</div>
			</div>
		</div>
	</div>
</div>