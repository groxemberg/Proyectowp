<?php


namespace App\Controllers;
use CodeIgniter\Controller;


class PanelPrincipal extends BaseController
{
    

    public function index()
    {
        $session = session();
        if (!$session->has('usuario') || !$session->has('estado') || $session->get('estado') != '1') {
            // Si no está autenticado, redirigir a la página de inicio de sesión
            return redirect()->to('usuariosindex2/0');
        }
        echo view('recursos/headergentelella');
        echo view('recursos/sidebargentelella');
        echo view('recursos/topbargentelella');
        echo view('read/panelprincipal');
        echo view('recursos/creditosgentelella');
        echo view('recursos/footergentelella');
    }
}
