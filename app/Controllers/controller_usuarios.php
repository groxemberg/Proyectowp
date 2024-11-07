<?php

namespace App\Controllers;
use App\Models\Usuario_Model;
use CodeIgniter\Validation\Rules;

class controller_usuarios extends BaseController {

	public function index()
	{
		$session=session();
		$usuarioModel= new Usuario_Model();

		// MÉTODO PARA LA VISTA DE USUARIOS
		if($session->get('tipo')=='jefe')
		{
			$listausuario=$usuarioModel->usuarios();
			$data['usuario']=$listausuario;
			return view('read/view_usuarios', $data);
		}
		else
		{
			return redirect()->to('usuarios/panel');
		}
	}

	// MÉTODO PARA LA VISTA DE MODIFICAR CONTRASEÑAS

	public function modificarcontrasena()
	{
		$session=session();
		$usuarioModel= new Usuario_Model();

		if($session->get('tipo')=='jefe')
		{
			error_reporting(0);
			if ($_POST ['idUsuario']=='') {
				return redirect()->to('usuariosindex');
			} else{
				$idUsuario=$this->request->getPost('idUsuario');

				$data['infousuario']=$usuarioModel->recuperarusuario($idUsuario);
				return view('update/modificar_contrasena', $data);
			}
		}
		else
		{
			return redirect()->to('usuarios/panel');
		}
	}

	// MÉTODO PARA MODIFICAR CONTRASEÑAS EN LA BASE DE DATOS SEGÚN EL PERFIL
	public function modificarcontrasenabd()
	{
		$session=session();
		$usuarioModel= new Usuario_Model();
		$request = service('request');

		if($session->get('tipo')=='jefe')
		{
			error_reporting(0);
			if ($request->getPost('idUsuario')=='') {
				return redirect()->to('usuariosindex');
			} else{
				//VALIDACIONES DE CAMPOS PARA LA MODIFICACIÓN DE DATOS
				$validation = \Config\Services::validation();
				$validation->setRules([
					'contrasena' => [
						'label' => 'Contraseña',
						'rules' => 'required|min_length[4]|max_length[8]',
						'errors' => [
							'required' => '(*) Se requiere llenar este campo',
							'min_length' => '(*) Se requiere al menos 4 caracteres',
							'max_length' => '(*) Se requiere máximo 8 caracteres',
						],
					],
				]);
				if (!$validation->withRequest($this->request)->run()) {
					
					$data['validation'] = $validation;
					$idUsuario=$request->getPost('idUsuario');
					$data['infousuario']=$usuarioModel->recuperarusuario($idUsuario);
					return view('update/modificar_contrasena', $data);
				}
				else{
						$idUsuario=$request->getPost('idUsuario');
						$data['contrasena']=MD5($request->getPost('contrasena'));
						$data['fechaActualizacion']=date("Y-m-d (H:i:s)");
						$data['estado']='2';
							
						$usuarioModel->modificarusuario($idUsuario,$data);	
						return redirect()->to('usuariosindex');
					}
				}
			}
		else
		{
			redirect('usuarios/panel','refresh');
		}
	}

	// MÉTODO PARA LA VISTA DE MODIFICAR CONTRASEÑAS

	public function modificarrol()
	{
		$session=session();
		$usuarioModel= new Usuario_Model();

		if($session->get('tipo')=='jefe')
		{
			error_reporting(0);
			if ($_POST ['idUsuario']=='') {
				return redirect()->to('usuariosindex');
			} else{
				$idUsuario=$this->request->getPost('idUsuario');

				$data['infousuario']=$usuarioModel->recuperarusuario($idUsuario);
				return view('update/modificar_rol', $data);
			}
		}
		else
		{
			return redirect()->to('usuarios/panel');
		}
	}

	// MÉTODO PARA MODIFICAR CONTRASEÑAS EN LA BASE DE DATOS SEGÚN EL PERFIL
	public function modificarrolbd()
	{
		$session=session();
		$usuarioModel= new Usuario_Model();
		$request = service('request');

		if($session->get('tipo')=='jefe')
		{
			error_reporting(0);
			if ($request->getPost('idUsuario')=='') {
				return redirect()->to('usuariosindex');
			} else{
				//VALIDACIONES DE CAMPOS PARA LA MODIFICACIÓN DE DATOS
				$validation = \Config\Services::validation();
				$validation->setRules([
					'tipo' => [
						'label' => 'Tipo',
						'rules' => 'required',
						'errors' => [
							'required' => '(*) Seleccione una opción',
						],
					],
				]);
				if (!$validation->withRequest($this->request)->run()) {
					
					$data['validation'] = $validation;
					$idUsuario=$request->getPost('idUsuario');
					$data['infousuario']=$usuarioModel->recuperarusuario($idUsuario);
					return view('update/modificar_rol', $data);
				}
				else{
						$idUsuario=$request->getPost('idUsuario');
						$data['tipo']=$request->getPost('tipo');
						$usuarioModel->modificarusuario($idUsuario,$data);	
						return redirect()->to('usuariosindex');
					}
				}
			}
		else
		{
			redirect('usuarios/panel','refresh');
		}
	}

}
