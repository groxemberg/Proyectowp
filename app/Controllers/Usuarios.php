<?php

namespace App\Controllers;
use App\Models\Usuario_Model;
use CodeIgniter\Validation\Rules;


class Usuarios extends BaseController {

	
	//MÉTODO PÁRA VALIDAR SI EL USUARIO SE ENCUENTRA HABILITADO O A SIDO CREADO PREVIAMENTE

	public function index()
	{
		// Obtener el tercer segmento de la URI
        $uri = service('uri');
        // Verificar si se ha pasado un segmento, si no usar el segmento dado
		$msg = $uri->getSegment(2, '0'); // Asignar '0' por defecto si no existe el segmento
        $data['msg'] = $msg;

		$session = session();// Verificar la sesión del usuario

		if($session->get('usuario') && $session->get('estado')=='1'){
			return redirect()->to('usuarios/panel');
		} else {
			if ($session->get('usuario') && $session->get('estado')=='2') {
				echo view('recursos/headergentelellalogin');
				echo view('actualizarlogin',$data); //se aumenta el data del segmento
				echo view('recursos/footergentelellalogin');
			} else {
				echo view('recursos/headergentelellalogin');
				echo view('login',$data); //se aumenta el data del segmento
				echo view('recursos/footergentelellalogin');
			} }
	}

	public function index2()
	{

		$session=session();
		$uri = service('uri');
        $msg = $msg ?? $uri->getSegment(2);
		$data['msg'] = $msg;
		
		if($session->get('usuario') AND $session->get('estado')=='1'){
			return redirect()->to('Usuarios/panel');
		
		} else {
			echo view('recursos/headergentelellalogin');
			echo view('login',$data); //se aumenta el data del segmento
			echo view('recursos/footergentelellalogin');
	 }
	
	}

	//MÉTODO PARA ACTUALIZAR LA CONTRASEÑA EN CASO DE QUE SEA CREADO POR PRIMERA VEZ O MODIFICADO EN CASO DE OLVIDO

	public function actualizarcontrasena()
{
    $usuarioModel = new Usuario_Model(); // Crear una instancia del modelo
    $session = session();
    $request = service('request');
    $validation = \Config\Services::validation();
    
    $idUsuario = $session->get('idUsuario');
    $contrasena = md5($request->getPost('contrasena')); // Cifrar la contraseña actual con MD5
    
    // Verificar si la contraseña actual es válida
    $consulta2 = $usuarioModel->validaractualizacion($idUsuario, $contrasena);
    
    if ($consulta2->getNumRows() > 0) {
        // Definir las reglas de validación para las nuevas contraseñas
        $validation->setRules([
            'nuevacontrasena' => [
                'label' => 'Nueva contraseña',
                'rules' => 'required|min_length[4]|max_length[8]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{4,8}$/]',
                'errors' => [
                    'required' => '(*) Se requiere llenar este campo',
                    'min_length' => '(*) Se requiere al menos 4 caracteres',
                    'max_length' => '(*) Se requiere máximo 8 caracteres',
                    'regex_match' => '(*) La contraseña debe incluir al menos una mayúscula, una minúscula, un número y un carácter especial'
                ]
            ],
            'repitacontrasena' => [
                'label' => 'Repetir contraseña',
                'rules' => 'required|matches[nuevacontrasena]',
                'errors' => [
                    'required' => '(*) Se requiere llenar este campo',
                    'matches' => '(*) Las contraseñas no coinciden'
                ]
            ]
        ]);

        // Ejecutar la validación con los datos de la solicitud
        if (!$validation->withRequest($this->request)->run()) {
            // Si hay errores de validación, redirigir con los errores
            return redirect()->to('usuariosindex/2')->withInput()->with('validation', $validation);
        } else {
            // Obtener los datos de la nueva contraseña y actualizar en la base de datos
            $idUsuario = $request->getPost('idUsuario');
            $data = [
                'contrasena' => md5($request->getPost('repitacontrasena')),
                'estado' => '1'
            ];
            $usuarioModel->modificarusuario($idUsuario, $data);

            // Redirigir con mensaje de éxito
            return redirect()->to('usuariosindex2/4')->with('success', 'Contraseña actualizada correctamente');
        }
    } else {
        // Redirigir si la contraseña actual es incorrecta
        return redirect()->to('usuariosindex/1')->with('error', 'Contraseña actual incorrecta');
    }
}


	//MÉTODO DE VALIDACIÓN EN LA BASE DE DATOS

	public function validar()
	{	
		
		$usuarioModel = new Usuario_Model(); // Crear una instancia del modelo
		$session = session();// Verificar la sesión del usuario
		$request = service('request');

		$usuario = $request->getPost('usuario'); // Obtener usuario del formulario
		$contrasena = md5($request->getPost('contrasena')); // Cifrar la contraseña con MD5
		$estado='1';


		$consulta=$usuarioModel->validar($usuario,$contrasena,$estado);

		if ($consulta->getNumRows() > 0) {
            
			$row = $consulta->getRow(); // Obtener la primera fila de resultados
            // Almacenar datos en la sesión
            $this->session->set('idUsuario', $row->idEmpleado);
            $this->session->set('usuario', $row->usuario);
            $this->session->set('tipo', $row->tipo);
            $this->session->set('estado', $row->estado);

            // Redirigir al panel de usuarios
            return redirect()->to('usuarios/panel');
        }

        // Realizar la validación para estado '2'
        $estado = '2';
        $consulta = $usuarioModel->validar($usuario, $contrasena, $estado);

        if ($consulta->getNumRows() > 0) {
            // Validación exitosa
            $row = $consulta->getRow(); // Obtener la primera fila de resultados

            // Almacenar datos en la sesión
            $this->session->set('idUsuario', $row->idEmpleado);
            $this->session->set('usuario', $row->usuario);
            $this->session->set('tipo', $row->tipo);
            $this->session->set('estado', $row->estado);

            // Redirigir a otra página de usuarios
            return redirect()->to('usuariosindex/4');
        }

        // Si ninguna validación es exitosa, redirigir con un mensaje de error
        return redirect()->to('usuariosindex2/2');
	
	}

	//MÉTODO PARA LA VALIDACIÓN E INGRESO AL SISTEMA

	public function panel()
	{
		$session = session();
		if($session->get('usuario') AND $session->get('estado')=='1')
		{
			if($session->get('tipo')=='jefe' || $session->get('tipo')=='ejecutor' || $session->get('tipo')=='inspector')
			{
				return redirect()->to('panelprincipal'); //el usuario ya esta logueado
			}
		}  
		else {
			return redirect()->to('usuariosindex2/3');

		}
	}

	//MÉTODO PARA CERRAR SESIÓN
	// MÉTODO PARA CERRAR SESIÓN
    public function logout() 
    {
        $session = session();
        $session->destroy();
        return redirect()->to('usuariosindex/1'); // Se añade un 1 como un código
    }
}
