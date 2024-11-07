<?php
namespace App\Controllers;
use App\Models\Empleados_Model;
use App\Models\Usuario_Model;
use CodeIgniter\Validation\Rules;

class controller_empleados extends BaseController {
	
	//---------MÉTODO PARA LA VISTA DE DE LISTAS DE EMPLEADOS--------//

	public function index()
	{
		$session=session();
		$empleadosModel = new Empleados_Model();

		if($session->get('tipo')=='jefe')
		{
			$listaempleados=$empleadosModel->empleados();
			$data['empleados']=$listaempleados;
			return view('read/view_empleados', $data);
		}
		else
		{
			return redirect()->to('usuarios/panel');
		}
	}

	//---------MÉTODO PARA LA VISTA DE IMPUTs PARA AGREGAR EMPLEADOS--------//

	public function agregar()
	{
		$session=session();
		if($session->get('tipo')=='jefe')
		{
			//Obtener el tercer segmento de la URI
			$uri = service('uri');
			// Verificar si se ha pasado un segmento, si no usar el segmento dado
			$msg = $msg ?? $uri->getSegment(2);
			$data['msg'] = $msg;

			return view('create/add_empleado', $data);
		}
		else
		{
			return redirect()->to('empleadosindex');
		}
	}

	//---------MÉTODO PARA AGREGAR EMPLEADOS A LA BASE DE DATOS--------//

	public function agregarbdd()
	{
			$session = session();
			$usuarioModel = new Usuario_Model();
			$empleadosModel = new Empleados_Model();
			$request = service('request');

			if ($session->get('tipo') == 'jefe') {
				helper(['form', 'url']);
				//VALIDACIÓN DE CAMPOS PARA LA INSERCIÓN DE DATOS
				$validation = \Config\Services::validation();
				$validation->setRules([
					'nombres' => 'required|alpha_space',
					'primerApellido' => 'required|alpha_space',
					'ci' => 'required',
					'expedicion' => 'required',
					'usuario' => 'required|min_length[4]|alpha_numeric',
					'tipo' => 'required',
					'contrasena' => 'required|min_length[4]|max_length[8]'
				], [
					'nombres' => ['required' => '(*) Se requiere llenar este campo','alpha_space' => '(*) El campo no permite números'],
					'primerApellido' => ['required' => '(*) Se requiere llenar este campo','alpha_space' => '(*) El campo no permite números'],
					'ci' => ['required' => '(*) Se requiere llenar este campo'],
					'expedicion' => ['required' => '(*) Seleccione una opción'],
					'usuario' => ['required' => '(*) Se requiere llenar este campo','min_length' => '(*) Se requiere al menos 4 caracteres','alpha_numeric' => '(*) Se requiere solo letras o números'],
					'tipo' => ['required' => '(*) Seleccione una opción'],
					'contrasena' => ['required' => '(*) Se requiere llenar este campo','min_length' => '(*) Se requiere al menos 4 caracteres','max_length' => '(*) Se requiere máximo 8 caracteres']
				]);
	
				if (!$validation->withRequest($this->request)->run()) {
					// Si la validación falla, mostrar errores en la vista
					$data['validation'] = $validation;
					$data['msg'] = $request->getPost('msg'); // Obtener mensaje de error
					return view('create/add_empleado', $data);
				} else {
					// Si la validación es exitosa, procesar los datos del formulario
					$usuario = strtolower($request->getPost('usuario'));
	
					$validarUsuario = $usuarioModel->validarusuario($usuario);
					if ($validarUsuario->getNumRows() > 0) {
						// Si el usuario ya existe, redirigir con mensaje de error
						return redirect()->to('empleadosagregar/1');
					} else {
						// Crear arreglo con los datos del empleado para insertar
						$data = [
							'nombres' => ucwords($request->getPost('nombres'), 'UTF-8'),
							'primerApellido' => ucwords($request->getPost('primerApellido'), 'UTF-8'),
							'segundoApellido' => ucwords($request->getPost('segundoApellido'), 'UTF-8'),
							'ci' => $this->request->getPost('ci'),
							'expedicion' => $this->request->getPost('expedicion'),
							'usuario' => strtolower($request->getPost('usuario')),
							'contrasena' => md5($request->getPost('contrasena')),
							'tipo' => strtolower($request->getPost('tipo')),
							'estado' => '2'
						];
	
						// Insertar empleado usando el modelo correspondiente
						$empleadosModel->agregarempleado($data);
	
						// Redirigir a la página principal de empleados
						return redirect()->to('empleadosindex');
					}
				}
			} else {
				// Si no es tipo 'jefe', redirigir a panel de usuarios
				return redirect()->to('usuarios/panel');
			}
	}
	
	//---------MÉTODO PARA LA VISTA DE MODIFICAR EMPLEADOS RECUPERANDO LOS DATOS PREVIAMENTE INTRODUCIDOS--------//
	public function modificar()
	{
		$session=session();
		$empleadosModel = new Empleados_Model();

		if($session->get('tipo')=='jefe')
		{
			error_reporting(0);
			if ($this->request->getPost('idEmpleado')=='') {
				return redirect()->to('empleadosindex');
			} else{
				$idEmpleado=$this->request->getPost('idEmpleado');
				$data['infoempleado']=$empleadosModel->recuperarempleado($idEmpleado);

				return view('update/modificar_empleado', $data);
			}
		}
		else
		{
				return redirect()->to('usuarios/panel');
		}
	}

	//---------MÉTODO PARA MODIFICAR EMPLEADOS EN LA BASE DE DATOS--------//

	public function modificarbd()
	{
		$session = session();
		$empleadosModel = new Empleados_Model();
		$request = service('request');
		
		if($session->get('tipo')=='jefe')
		{
			error_reporting(0);
			if ($this->request->getPost('idEmpleado')=='') {
				return redirect()->to('empleadosindex');
			} else{	
				//VALIDACIONES DE CAMPOS PARA LA MODIFICACIÓN DE DATOS
				$validation = \Config\Services::validation();
				$validation->setRules([
					'nombres' => ['rules' => 'required|alpha_space','errors' => [
							'required' => '(*) Se requiere llenar el campo',
							'alpha_space' => '(*) El campo de Nombres no debe contener números.']
					],
					'primerApellido' => [
						'rules' => 'required|alpha_space',
						'errors' => [
							'required' => '(*) Se requiere llenar el campo',
							'alpha_space' => '(*) El campo de Primer Apellido no debe contener números.'
						]
					],
					'ci' => [
						'rules' => 'required',
						'errors' => [
							'required' => '(*) Se requiere llenar el campo'
						]
					]
				]);
				
				if  (!$validation->withRequest($this->request)->run()) {
					// Si la validación falla, mostrar errores en la vista
					$data['validation'] = $validation;
					$idEmpleado=$this->request->getPost('idEmpleado');
					$data['infoempleado']=$empleadosModel->recuperarempleado($idEmpleado);
					
					return view('update/modificar_empleado', $data);
				}
				else{
					$idEmpleado=$this->request->getPost ('idEmpleado');

					$data = [
						'nombres' => ucwords($request->getPost('nombres'), 'UTF-8'),
						'primerApellido' => ucwords($request->getPost('primerApellido'), 'UTF-8'),
						'segundoApellido' => ucwords($request->getPost('segundoApellido'), 'UTF-8'),
						'ci' => $this->request->getPost('ci'),
						'expedicion' => $this->request->getPost('expedicion'),
					];
										
					$empleadosModel->modificarempleado($idEmpleado,$data);
					return redirect()->to('empleadosindex');
				}
			}
		}
		else
		{
			return redirect()->to('usuarios/panel');
		}
	}

	//---------MÉTODO PARA LA ELIMINACIÓN LÓGICA DE EMPLEADOS--------//

	public function eliminarbd($idEmpleado)
	{
		$session = session();
		$empleadosModel = new Empleados_Model();

		if($session->get('tipo')=='jefe')
		{
			$data['estado']='0';
			$data['fechaActualizacion']=date("Y-m-d (H:i:s)");
			
			$empleadosModel->modificarempleado($idEmpleado,$data);

			return redirect()->to('empleadosindex');
		}
		else
		{
			return redirect()->to('usuarios/panel');
		}
	}

	//---------MÉTODO PARA LA LISTA DE EMPLEADOS ELIMINADOS--------//

	public function eliminados()
	{
		$session = session();
		$empleadosModel = new Empleados_Model();
		
		if($session->get('tipo')=='jefe')
		{
			$listaempleados=$empleadosModel->empleadoseliminados();
			$data['empleados']=$listaempleados;
			return view('delete/view_EmpleadosEliminados', $data);
		}
		else
		{
			return redirect()->to('usuarios/panel');
		}
	}

	//---------MÉTODO PARA RECUPERAR EMPLEADOS ELIMINADOS O ACTIVAR EMPLEADOS ELEIMINADOS--------//

	public function recuperarbd()
	{
		$session = session();
		$empleadosModel = new Empleados_Model();

		if($session->get('tipo')=='jefe')
		{
			error_reporting(0);
			if ($this->request->getPost ('idEmpleado')=='') {
				return redirect()->to('empleadosindex');
			} else{
				$idEmpleado=$this->request->getPost ('idEmpleado');
				$data['estado']='2';
				$data['fechaActualizacion']=date("Y-m-d (H:i:s)");

				$empleadosModel->modificarempleado($idEmpleado,$data);
				return redirect()->to('eliminados');
			}
		}
		else
		{
			return redirect()->to('usuarios/panel');
		}
	}
}