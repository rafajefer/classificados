<?php 

class logoutController extends Controller {

	// Método para deslogar usuário do sistema
	public function index()
	{
		unset($_SESSION['cLogin']);
		header("Location: ".BASE_URL);
		exit;
	}
}