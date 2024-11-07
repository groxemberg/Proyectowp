<?php
namespace App\Controllers;
use App\Models\Reporte_Model;
use App\Models\Usuario_Model;
use App\Models\Wp_Model;
use CodeIgniter\Validation\Rules;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\HTTP\Exceptions\HTTPException;
use Config\Services;
use CodeIgniter\HTTP\Files\UploadedFile;
use CodeIgniter\Files\File;
use ZipArchive;



class controller_pendientes extends BaseController {
    protected $helpers = ['form', 'url'];

	public function index()
	{

        //---------MÉTODO PARA LA VISTA DE LISTAS DE ACTIVIDADES PENDIENTES--------//
        $session=session();
		$wpModel = new Wp_Model();

		if($session->get('tipo')=='jefe' || $session->get('tipo')=='ejecutor')
		{
			$wppendientes=$wpModel->wp();
			$data['wp']=$wppendientes;
            return view('read/view_pendiente', $data);
		}
		else
		{
			return redirect()->to('usuarios/panel');
		}
	}

    //---------MÉTODO PARA LA GESTIÓN DE ARCHIVOS DESCARGAR DE ARCHIVOS SUBIDOS--------//

	public function descargarCarpetaZIP($idInforme) {
    // Obtener la carpeta de descarga del disco C
    $carpetaDescarga = 'C:/Descargas/';

    // Si la carpeta de descarga no existe, crearla
    if (!is_dir($carpetaDescarga)) {
        mkdir($carpetaDescarga, 0777, true);
    }

    // Crear un archivo ZIP
    $zip = new ZipArchive();
    $nombreZip = $carpetaDescarga . 'carpeta_informe_' . $idInforme . '.zip';

    if ($zip->open($nombreZip, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
        // Obtener la ruta de la carpeta de archivos del informe
        $carpetaArchivos = './carpeta_archivos/' . $idInforme . '/';

        // Agregar todos los archivos de la carpeta principal y subcarpetas al ZIP
        $this->agregarArchivosAlZip($zip, $carpetaArchivos);

        // Cerrar el ZIP
        $zip->close();

        // Descargar el ZIP
        header('Content-Type: application/zip');
        header('Content-Disposition: attachment; filename="carpeta_informe_' . $idInforme . '.zip"');
        readfile($nombreZip);

        // Eliminar el archivo ZIP después de descargarlo
        unlink($nombreZip);

        // Puedes redireccionar a la página principal u otro manejo según tus necesidades
        // redirect('controller_pendientes/index');
    } else {
        // Manejo de error si no se pudo abrir el archivo ZIP
        echo "Error al crear el archivo ZIP";
    }
}

private function agregarArchivosAlZip($zip, $carpeta) {
    $archivos = glob($carpeta . '*');
    foreach ($archivos as $archivo) {
        if (is_dir($archivo)) {
            // Si es una carpeta, llamar recursivamente a la función para agregar sus archivos
            $this->agregarArchivosAlZip($zip, $archivo . '/');
        } else {
            // Si es un archivo, agregarlo al ZIP
            $rutaArchivo = $archivo;
            $nombreArchivo = str_replace($carpeta, '', $archivo); // Eliminar la parte inicial de la ruta
            $zip->addFile($rutaArchivo, $nombreArchivo);
        }
    }
}

    //---------MÉTODO PARA LA VISTA DE AGREGACIÓN DE LOS ARCHIVOS DE PAPELES DE TRABAJOS--------//

	public function agregar()
	{
        $session=session();
		if($session->get('tipo')=='jefe' || $session->get('tipo')=='ejecutor')
		{
			return view('create/add_Wp');
		}
		else
		{
			return redirect()->to('usuarios/panel');
		}
	}

	
    //---------MÉTODO PARA AGREGAR LOS ARCHIVOS A LA BASE DE DATOS--------//

    public function agregarbdd()
    {
        $session = session();
		$wpModel = new Wp_Model();
		$request = service('request');

        if ($request->getPost('idInforme') && !empty($_FILES['archivos']['name'][0])) {
            $idInforme = $request->getPost('idInforme') ;// Tomar solo los primeros 7 caracteres
            $carpeta = './carpeta_archivos/' . $idInforme . '/';
            $carpetaRaiz = './carpeta_archivos/';
    
            if (!is_dir($carpeta)) {
                mkdir($carpeta, 0777, true);
            }
    
             // Eliminar archivos anteriores si existen
            $this->eliminarArchivosAnteriores($carpeta);
    
            $archivos = $_FILES['archivos'];
            $data = array();
    
            // Configuración de carga de archivos
            $config['upload_path'] = $carpeta; // Directorio donde se guardarán los archivos
            $config['allowed_types'] = '*'; // Permitir todos los tipos de archivos

            $upload = Services::upload($config);
    
            $files = $this->request->getFiles();
            foreach ($files['archivos'] as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $file->move($carpeta);
                }
            }
    
            $nombreZip = $carpetaRaiz .  $idInforme . '.zip';
            $this->crearArchivoZip($carpeta, $nombreZip);
            $this->actualizar_archivo_comprimido($nombreZip, $idInforme);
    
        }
    
        $estado = $request->getPost('estado');
        if ($estado==1) {
            return redirect()->to('pendientesindex');
        } else {
        
            return redirect()->to('pendientesrevision');
        }
    }
    
    //MÉTODO PARA BORRAR LOS ARCHIVOS DESPUES  REEMPLAZAR
    private function eliminarArchivosAnteriores($carpeta) {
        if (is_dir($carpeta)) {
            $files = glob($carpeta . '*'); // Obtener todos los archivos en la carpeta
            foreach ($files as $file) {
                if (is_file($file)) {
                    unlink($file); // Borrar el archivo
                }
            }
        }
    }
    
    //METODO PRIVADO PARA CREAR EL ARCHIVO ZIP
    
    private function crearArchivoZip($carpetaOrigen, $nombreZip)
    {
        $zip = new ZipArchive();
        if ($zip->open($nombreZip, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
            $archivos = glob($carpetaOrigen . '*');
            foreach ($archivos as $archivo) {
                $rutaArchivo = $archivo;
                $nombreArchivo = basename($archivo);
                $zip->addFile($rutaArchivo, $nombreArchivo);
            }
            $zip->close();
        }
    }
    
    
    //MÉTODO PARA LIMPIAR EL ARCHIVO A PARTIR DE LA SEGUNDA SUBIDA
    private function limpiarArchivosIndividuales($carpeta, $data)
    {
        foreach ($data as $archivoInfo) {
            $rutaArchivoIndividual = $carpeta . $archivoInfo['wp'];
            unlink($rutaArchivoIndividual);
        }
    }

    // Método para actualizar la base de datos con la ruta del archivo ZIP
    private function actualizar_archivo_comprimido($wp, $idInforme)
    {
        $db = db_connect();
        $builder = $db->table('informe');
        $builder->where('nroInforme', $idInforme);
        $builder->update(['wp' => $wp]);
    }


//MÉTODO PARA EL CONTROL DE REVISIÓN DE PAPELES DE TRABAJO POR LA INSTANCIA CORRESPONDIENTE

public function revision()
    {
        $session = session();
        $wpModel = new Wp_Model();

        if($session->get('tipo') == 'jefe' || $session->get('tipo') == 'ejecutor')
        {
            // Cargar la biblioteca de validación de formularios
            helper(['form']);
            $validation = \Config\Services::validation();
            
            // Establecemos reglas de validación
            $validation->setRules([
                'tipoWp' => [
                    'label' => 'Tipo de WP',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Seleccione'
                    ]
                ]
            ]);
                
            if (!$validation->withRequest($this->request)->run()) {
                // Validación fallida, mostrar errores y cargar la vista
                $data['validation'] = $validation;
                $wppendientes = $wpModel->wp();
                $data['wp'] = $wppendientes;
                
                return view('read/view_pendiente', $data);
            } else {
                // Validación exitosa, procesar datos y actualizar la base de datos
                $idInforme = $this->request->getPost('idInforme');
                $tipoWp = $this->request->getPost('tipoWp');
                
                // Datos a actualizar
                $data = [
                    'tipoWp' => $tipoWp,
                    'estado' => 2
                ];
                
                $wpModel->modificaractividad($idInforme, $data);
                return redirect()->to('pendientesindex');
                                
                }
            }
        else
        {
            return redirect()->to('usuarios/panel');
        }
    }

    // MÉTODO PARA VER LA LISTA DE PAPELES DE TRABAJOS EN REVISIÓN

    public function viewrevision()
    {
        $session=session();
		$wpModel = new Wp_Model();
        if($session->get('tipo')=='jefe' || $session->get('tipo')=='ejecutor')
        {
            $wppendientes=$wpModel->wp();
            $data['wp']=$wppendientes;
            return view('read/view_revision',$data);
        }
        else
        {
            redirect('usuarios/panel','refresh');
        }
    }

    //MÉTODO PARA REALIZAR LA ACCIÓN DE DEVOLUCIÓN  DE LOS PAPELES DE TRABAJO EN CASO DE ERROR O OBSERVACIÓN POR PARTE DE LOS REVISORES, ASÍ TAMBIEN EL CIERRE DE LOS PAPELES DE TRABAJO.
    public function devolver()
    {
        $session=session();
		$wpModel = new Wp_Model();

        if($session->get('tipo')=='jefe' || $session->get('tipo')=='ejecutor')
        {
            
            $validation = \Config\Services::validation();
            $validation->setRules([
                'tipoWp' => [
                    'label' => 'Tipo WP',
                    'rules' => 'required',
                    'errors' => ['required' => '(*) Selecione..']
                ]
            ]);
            if (!$validation->withRequest($this->request)->run()) {
                $data['validation'] = $validation;
                $wppendientes = $wpModel->wp();
                $data['wp'] = $wppendientes;
                return view('read/view_revision', $data);
            }
             else {
                $idInforme = $this->request->getPost('idInforme');
      
                if ($this->request->getPost('tipoWp') == 1) {
                    
                    $data['tipoWp'] = $this->request->getPost('tipoWp');
                    $data['estado'] = 1;

                } elseif ($this->request->getPost('tipoWp') == 2) {
                    $data['estado'] = 3;
                }
                
                $wpModel->modificaractividad($idInforme, $data);
                return redirect()->to('pendientesrevision');
            }
        } else {
            return redirect()->to('usuarios/panel');
        }
    }
}