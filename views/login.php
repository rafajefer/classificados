<div class="container mt-5" id="area-login">
	<div class="row justify-content-center">
		<div class="col-6 col-sm-4 col-md-6 ">
			
			<?php 
				if(!empty($_SESSION['alert'])) {
					echo '<div class="alert alert-'.$_SESSION['alert']['color'].' alert-dismissible fade show">';
		    		echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
		    		echo $_SESSION['alert']['msg'];
		    		echo '</div>';
				}
			?>	
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