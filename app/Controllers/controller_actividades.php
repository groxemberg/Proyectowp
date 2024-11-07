<?php
namespace App\Controllers;
use App\Models\Reporte_Model;
use App\Models\Empleados_Model;
use App\Models\Wp_Model;
use CodeIgniter\Validation\Rules;

class controller_actividades extends BaseController {

	protected $wpModel;
    protected $empleadosModel;
    protected $session;

	//---------MÉTODO PARA LA VISTA DE ACTIVIDADES CULMINADAS--------//

	public function index()
	{
		$session=session();

		if($session->get('tipo')=='jefe' || $session->get('tipo')=='ejecutor' )
		{
		
			return view('read/view_actividades');
		}
		else
		{
			return redirect()->to('usuarios/panel');
		}
	}

	public function programada()
	{
		$session=session();
		$reporteModel = new Reporte_Model();

		if($session->get('tipo')=='jefe' || $session->get('tipo')=='ejecutor' )
		{
			$listaactividades=$reporteModel->pwp();
			$data['pwp']=$listaactividades;
			return view('read/view_actividadesP', $data);
		}
		else
		{
			return redirect()->to('usuarios/panel');
		}
	}

	public function noprogramada()
	{
		$session=session();
		$reporteModel = new Reporte_Model();

		if($session->get('tipo')=='jefe' || $session->get('tipo')=='ejecutor' )
		{
			$listaactividades=$reporteModel->npwp();
			$data['npwp']=$listaactividades;
			return view('read/view_actividadesNP', $data);
		}
		else
		{
			return redirect()->to('usuarios/panel');
		}
	}
	public function inspeccion()
	{
		$session=session();
		$reporteModel = new Reporte_Model();

		if($session->get('tipo')=='jefe' || $session->get('tipo')=='ejecutor' || $session->get('tipo')=='inspector' )
		{
			$listaactividadesp=$reporteModel->ipwp();
			$data['inwp']=$listaactividadesp;
			$listaactividadesnp=$reporteModel->inpwp();
			$data['inpwp']=$listaactividadesnp;
			return view('read/view_actividadesins', $data);
		}
		else
		{
			return redirect()->to('usuarios/panel');
		}
	}
	public function inspeccionado()
	{
		$session=session();
		$reporteModel = new Reporte_Model();

		if($session->get('tipo')=='jefe' || $session->get('tipo')=='ejecutor' || $session->get('tipo')=='inspector' )
		{
			$listaactividadesp=$reporteModel->rwp();
			$data['rwp']=$listaactividadesp;
			return view('read/view_actividadesR', $data);
		}
		else
		{
			return redirect()->to('usuarios/panel');
		}
	}

	//---------MÉTODO PARA LA VISTA DE LOS IMPUTs PARA AGREGAR NUEVAS ACTIVIDADES--------//
	public function agregar()
	{
		$session=session();
		$reporteModel = new Reporte_Model();

		if($session->get('tipo')=='jefe')
		{
			$listaempleado=$reporteModel->asignacion();
			$data['seleccion']=$listaempleado;
			return view('create/add_actividad', $data);
		}
		else
		{
			return redirect()->to('usuarios/panel');
		}
	}

	//---------MÉTODO PARA AGREGACIÓN A LA BASE DE DATOS--------//

	public function agregarbdd()
	{	
		$session = session();
        $reporteModel = new Reporte_Model();

        if ($session->get('tipo') == 'jefe') {
            helper(['form', 'url']);
			//VALIDACIÓN DE CAMPOS PARA LA INSERCIÓN DE DATOS
            $validation = \Config\Services::validation();
            $validation->setRules([
                'tipoInforme' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '(*) Seleccione un tipo de informe',
                    ],
                ],
                'nroInforme' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '(*) Se requiere llenar este campo',
                    ],
                ],
                'informe' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '(*) Se requiere llenar este campo',
                    ],
                ],
                'fechaInicio' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '(*) Inserte una fecha',
                    ],
                ],
                'fechaConclusion' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '(*) Inserte una fecha',
                    ],
                ],
                'idEmpleado' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '(*) Seleccione un empleado',
                    ],
                ],
            ]);

            if (!$validation->withRequest($this->request)->run()) {
                $listaempleado = $reporteModel->asignacion();
				$data['validation'] = $validation;
                $data['seleccion'] = $listaempleado;
				return view('create/add_actividad', $data);
            } else {
                $data = [
                    'tipoInforme' => $this->request->getPost('tipoInforme'),
                    'nroInforme' => $this->request->getPost('nroInforme'),
                    'informe' => $this->request->getPost('informe'),
                    'fechaInicio' => $this->request->getPost('fechaInicio'),
                    'fechaConclusion' => $this->request->getPost('fechaConclusion'),
                    'fechaPresentacion' => $this->request->getPost('fechaPresentacion'),
                    'idEmpleado' => $this->request->getPost('idEmpleado'),
                ];

                $reporteModel->agregaractividad($data);

                return redirect()->to('pendientesindex');
            }
        } else {
            return redirect()->to('usuarios/panel');
        }
    }

	//---------MÉTODO PARA LA VISTA DE MODIFICACIÓN DE LAS ACTIVIDADES RECUPERANDO LOS DATOS PREVIAMENTE INTRODUCIDO--------//

	public function modificar()
	{
		$session = session();
        $wpModel = new Wp_Model();
		$empleadosModel = new Empleados_Model();

		if($session->get('tipo')=='jefe')
		{
			error_reporting(0);
			if ($this->request->getPost('idInforme')=='') {
				return redirect()->to('usuarios/panel');
			} else{
				$idInforme=	$this->request->getPost('idInforme');
				$data['infoactividad']=$wpModel->recuperaractividad($idInforme);
				$listaempleado=$empleadosModel->empleados();
				$data['seleccion']=$listaempleado;
				return view('update/modificar_actividad',$data);
			}
		}
		else
		{
			return redirect()->to('usuarios/panel');
		}
	}

	//---------MÉTODO PARA MODIFICACIÓN EN LA BASE DE DATOS--------//

	public function modificarbd()
    {
	$session = session();
    $wpModel = new Wp_Model();
    $empleadosModel = new Empleados_Model();
    $request = service('request');

    if ($session->get('tipo') == 'jefe') {
        log_message('info', 'Tipo de sesión es jefe');

        $idInforme = $request->getPost ('idInforme');
        log_message('info', 'ID del informe: ' . $idInforme);

        helper(['form', 'url']);
        $validation = \Config\Services::validation();

        $validation->setRules([
            'informe' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '(*) Se requiere llenar este campo'
                ]
            ],
            'nroInforme' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '(*) Se requiere llenar este campo'
                ]
            ],
            'fechaInicio' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '(*) Inserte una fecha'
                ]
            ],
            'fechaConclusion' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '(*) Inserte una fecha'
                ]
            ],
            'fechaPresentacion' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '(*) Inserte una fecha'
                ]
            ]
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            log_message('error', 'Validación fallida');
            $data['validation'] = $validation;
            $data['infoactividad'] = $wpModel->recuperaractividad($idInforme);
            $data['seleccion'] = $empleadosModel->empleados();
            return view('update/modificar_actividad', $data);
        } else {

					$data['tipoInforme']=$request->getPost('tipoInforme');
					$data['nroInforme']=$request->getPost('nroInforme');
					$data['informe']=$request->getPost('informe');
					$data['fechaInicio']=$request->getPost('fechaInicio');
					$data['fechaConclusion']=$request->getPost('fechaConclusion');
					$data['fechaPresentacion']=$request->getPost('fechaPresentacion');
					$data['idEmpleado']=$request->getPost('idEmpleado');
			$wpModel->modificaractividad($idInforme, $data);
			return redirect()->to('pendientesindex');
        }
	    } else {
        		return redirect()->to('usuarios/panel');
    	}
    }

	//---------MÉTODO PARA LA ELIMINACIÓN LÓGICA--------//

	public function eliminarbd($idInforme)
	{
		$session = session();
   		$wpModel = new Wp_Model();

		if($session->get('tipo')=='jefe')
		{
			$data['estado']='0';
			$wpModel->modificaractividad($idInforme,$data);
			return redirect()->to('pendientesindex');
		}
		else
		{
			return redirect()->to('usuarios/panel');
		}
	}

	//---------VISTA DE ELIMINADOS--------//
	public function eliminados()
	{
		$session = session();
   		$wpModel = new Wp_Model();

		if($session->get('tipo')=='jefe')
		{
			$listaactividades=$wpModel->eliminados();
			$data['wpeliminados']=$listaactividades;
			return view('delete/view_pendienteEliminados',$data);
		}
		else
		{
			return redirect()->to('usuarios/panel');
		}
	}

	//---------MÉTODO PARA LA VISTA DE LISTA DE ACTIVIDADES ELIMINADAS--------//
	public function recuperarbd()
	{
		$session = session();
   		$wpModel = new Wp_Model();
		$request = service('request');

		if($session->get('tipo')=='jefe')
		{
			error_reporting(0);
			if ($request->getPost ('idInforme')=='') {
				redirect('controller_panelprincipal/index','refresh');
			} else{
				$idInforme=$request->getPost ('idInforme');
				$data['estado']='1';
				$wpModel->modificaractividad($idInforme,$data);
				return redirect()->to('actividadeseliminadas');
			}
		}
		else
		{
			return redirect()->to('usuarios/panel');
		}
	}

	public function enviarins($idInforme)
	{
		$session = session();
   		$wpModel = new Wp_Model();

		if($session->get('tipo')=='jefe')
		{
			$data['estado']='4';
			$wpModel->modificaractividad($idInforme,$data);
			return redirect()->to('actividadesins');
		}
		else
		{
			return redirect()->to('usuarios/panel');
		}
	}

	public function cerrarins($idInforme)
	{
		$session = session();
   		$wpModel = new Wp_Model();

		if($session->get('tipo')=='jefe')
		{
			$data['estado']='5';
			$wpModel->modificaractividad($idInforme,$data);
			return redirect()->to('actividadesins');
		}
		else
		{
			return redirect()->to('usuarios/panel');
		}
	}

}