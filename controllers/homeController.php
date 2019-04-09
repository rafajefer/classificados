<?php 

class homeController extends Controller {

	public function index()
	{


		$data['total_anuncios'] = 19;
		$data['total_usuarios'] = 5;
		$this->loadTemplate('home', $data);

		
	}
}