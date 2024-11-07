<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class controller_panelprincipal extends CI_Controller {

	//---------MÉTODO PARA LA VISTA PRINCIPAL EL SOFTWARE--------//

	public function index()
	{

		$this->load->view('recursos/headergentelella');
		$this->load->view('recursos/sidebargentelella');
		$this->load->view('recursos/topbargentelella');
		$this->load->view('read/panelprincipal');
		$this->load->view('recursos/creditosgentelella');
		$this->load->view('recursos/footergentelella');
	}

	
}
