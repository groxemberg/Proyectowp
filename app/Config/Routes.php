<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//RUTAS PARA LOS INGRESOS AL SISTEMA Y SALIDA DEL SISTEMA
$routes->get('/', 'Home::index');
$routes->get('login', 'Usuarios::index'); //raiz de la app para ingresar siempre al login
$routes->post('Usuarios/validar', 'Usuarios::validar');
$routes->get('usuarios/panel', 'Usuarios::panel');
$routes->get('usuariosindex/(:segment)', 'Usuarios::index/$1');
$routes->get('usuariosindex2/(:segment)', 'Usuarios::index2/$1');
$routes->post('usuarios/logout', 'Usuarios::logout');

//RUTAS PARA LA ACTUALIZACIÓN DE CONTRASEÑAS
$routes->post('actualizarcontrasena', 'Usuarios::actualizarcontrasena');
$routes->post('usuariosindex2/(:segment)', 'Usuarios::index2/$1');

//RUTA PARA EL INGRESO DEL PANEL PRINCIPAL
$routes->get('panelprincipal', 'PanelPrincipal::index');

//RUTAS PARA LA GESTIÓN CRUD DE EMPLEADOS
$routes->post('empleadosindex', 'Controller_Empleados::index'); //metodo post para formularios
$routes->get('empleadosindex', 'Controller_Empleados::index'); //metodo get para redirecciones y accesos directos
$routes->post('empleadosagregar/(:segment)', 'Controller_Empleados::agregar/$1');//metodo post para formularios
$routes->get('empleadosagregar/(:segment)', 'Controller_Empleados::agregar/$1'); //metodo get para redirecciones y accesos directos
$routes->post('empleadosagregarbdd', 'Controller_Empleados::agregarbdd'); //metodo post para formularios
$routes->post('modificar', 'Controller_Empleados::modificar'); //metodo post para formularios
$routes->post('modificarbd', 'Controller_Empleados::modificarbd'); //metodo post para formularios
$routes->get('eliminarbd/(:num)', 'Controller_Empleados::eliminarbd/$1'); //metodo get para eliminación
$routes->post('eliminados', 'Controller_Empleados::eliminados'); //metodo post para formularios
$routes->get('eliminados', 'Controller_Empleados::eliminados'); 
$routes->post('recuperarbd', 'Controller_Empleados::recuperarbd'); //metodo post para formularios

//RUTAS PARA LA GESTIÓN DE USUARIOS
$routes->post('usuariosindex', 'Controller_Usuarios::index');
$routes->get('usuariosindex', 'Controller_Usuarios::index');
$routes->post('usuarioscontrasena', 'Controller_Usuarios::modificarcontrasena');
$routes->post('usuariosmodificarcontrrasenabd', 'Controller_Usuarios::modificarcontrasenabd');
$routes->post('usuariosrol', 'Controller_Usuarios::modificarrol');
$routes->post('usuariosmodificarrolbd', 'Controller_Usuarios::modificarrolbd');

//RUTAS PARA EL CONTROL Y CRUD DE ACTIVIDADES
$routes->post('actividadesindex', 'Controller_Actividades::index');
$routes->post('actividadesprogramadas', 'Controller_Actividades::programada');
$routes->get('actividadesprogramadas', 'Controller_Actividades::programada');
$routes->post('actividadesnoprogramadas', 'Controller_Actividades::noprogramada');
$routes->post('actividadesins', 'Controller_Actividades::inspeccion');
$routes->get('actividadesins', 'Controller_Actividades::inspeccion');
$routes->post('actividadesauditados', 'Controller_Actividades::inspeccionado');
//$routes->get('actividadesauditados', 'Controller_Actividades::inspeccion');
$routes->post('pendientesindex', 'Controller_Pendientes::index');
$routes->get('pendientesindex', 'Controller_Pendientes::index');
$routes->post('actividadesagregar', 'Controller_Actividades::agregar');
$routes->post('actividadesagregarbdd', 'Controller_Actividades::agregarbdd');
$routes->post('actividadesmodificar', 'Controller_Actividades::modificar');
$routes->post('actividadesmod', 'Controller_Actividades::modificarbd');
$routes->get('actividadeseliminarbd/(:num)', 'Controller_Actividades::eliminarbd/$1'); //metodo get para eliminación
$routes->post('actividadeseliminadas', 'Controller_Actividades::eliminados');
$routes->get('actividadeseliminadas', 'Controller_Actividades::eliminados');
$routes->post('actividadesrecuperarbd', 'Controller_Actividades::recuperarbd');
$routes->get('cerrarins/(:num)', 'Controller_Actividades::cerrarins/$1');
$routes->get('enviarins/(:num)', 'Controller_Actividades::enviarins/$1');

//RUTA PARA EL CONTROL DE SUBIR LOS PAPELES DE TRABAJOS
$routes->post('pendientesagregar', 'Controller_Pendientes::agregar');
$routes->post('pendientesagregarbdd', 'Controller_Pendientes::agregarbdd');

//RUTAS PARA LA REVÍSIÓN DE PAPELES DE TRABAJOS
$routes->post('pendientesrevisionin', 'Controller_Pendientes::revision');
$routes->post('pendientesrevision', 'Controller_Pendientes::viewrevision');
$routes->get('pendientesrevision', 'Controller_Pendientes::viewrevision');
$routes->post('pendientesdevolver', 'Controller_Pendientes::devolver');

