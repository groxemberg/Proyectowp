<?php
namespace App\Models;
use CodeIgniter\Model;

class Reporte_Model extends Model {

	protected $table = 'informe'; // Nombre de la tabla en la base de datos
	protected $primaryKey = 'idInforme'; // Nombre de tu clave primaria
    protected $allowedFields = ['tipoInforme', 'nroInforme', 'informe', 'fechaInicio', 'fechaConclusion', 'fechaPresentacion', 'wp', 'tipoWp', 'comentarios', 'fechaRegistro', 'estado', 'idEmpleado'];

	// MODELO PARA LA VISTA DE LAS ACTIVIDADES CONCLUIDAS PROGRAMADAS
	public function pwp()
	{
		return $this->db->table('informe i')
                ->select('i.idInforme, i.tipoInforme, i.nroInforme, i.informe, i.fechaInicio, i.fechaConclusion, i.fechaPresentacion, i.wp, i.tipoWp, i.comentarios, i.fechaRegistro, i.estado, i.idEmpleado, ep.nombres, ep.primerApellido, ep.segundoApellido')
                ->where('i.tipoInforme', 'P')
				->whereIn('i.estado',['3','4','5'])
                ->join('empleado ep', 'ep.idEmpleado = i.idEmpleado')
                ->get();
	}

	// MODELO PARA LA VISTA DE LAS ACTIVIDADES CONCLUIDAS NO PROGRAMADAS
	public function npwp()
	{
		return $this->db->table('informe i')
                ->select('i.idInforme, i.tipoInforme, i.nroInforme, i.informe, i.fechaInicio, i.fechaConclusion, i.fechaPresentacion, i.wp, i.tipoWp, i.comentarios, i.fechaRegistro, i.estado, i.idEmpleado, ep.nombres, ep.primerApellido, ep.segundoApellido')
				->where('i.tipoInforme', 'NP')
				->whereIn('i.estado',['3','4','5'])
                ->join('empleado ep', 'ep.idEmpleado = i.idEmpleado')
                ->get();
	}
	
	//MODELO PARA LA VISTA DE INFORMES EN INSPECCIÓN PROGRAMADOS Y NO PROGRAMADOS

	public function ipwp()
	{
		return $this->db->table('informe i')
                ->select('i.idInforme, i.tipoInforme, i.nroInforme, i.informe, i.fechaInicio, i.fechaConclusion, i.fechaPresentacion, i.wp, i.tipoWp, i.comentarios, i.fechaRegistro, i.estado, i.idEmpleado, ep.nombres, ep.primerApellido, ep.segundoApellido')
				->where('i.tipoInforme', 'P')
				->where('i.estado', '4')
                ->join('empleado ep', 'ep.idEmpleado = i.idEmpleado')
                ->get();

	}
	public function inpwp()
	{
		return $this->db->table('informe i')
                ->select('i.idInforme, i.tipoInforme, i.nroInforme, i.informe, i.fechaInicio, i.fechaConclusion, i.fechaPresentacion, i.wp, i.tipoWp, i.comentarios, i.fechaRegistro, i.estado, i.idEmpleado, ep.nombres, ep.primerApellido, ep.segundoApellido')
				->where('i.tipoInforme', 'NP')
				->where('i.estado', '4')
                ->join('empleado ep', 'ep.idEmpleado = i.idEmpleado')
                ->get();
	}

	// MODELO PARA LISTAR LAS ACTIVIDADES QUE YA FUERON INSPECCIONADAS O AUDITADAS

	public function rwp()
	{
		return $this->db->table('informe i')
                ->select('i.idInforme, i.tipoInforme, i.nroInforme, i.informe, i.fechaInicio, i.fechaConclusion, i.fechaPresentacion, i.wp, i.tipoWp, i.comentarios, i.fechaRegistro, i.estado, i.idEmpleado, ep.nombres, ep.primerApellido, ep.segundoApellido')
				->where('i.estado', '5')
                ->join('empleado ep', 'ep.idEmpleado = i.idEmpleado')
                ->get();
	}

	// MODELO PARA LA VISTA DE LAS ACTIVIDADES CONCLUIDAS PROGRAMADAS
	/*public function wp()
	{
		return $this->db->table('informe i')
                ->select('i.idInforme, i.tipoInforme, i.nroInforme, i.informe, i.fechaInicio, i.fechaConclusion, i.fechaPresentacion, i.wp, i.tipoWp, i.comentarios, i.fechaRegistro, i.estado, i.idEmpleado, ep.nombres, ep.primerApellido, ep.segundoApellido')
                ->where('i.tipoInforme', 'P')
				->where('i.estado', '5')
                ->join('empleado ep', 'ep.idEmpleado = i.idEmpleado')
                ->get();
	}*/

	// MODELO PARA AGREGAR LAS ACTIVIDADES

	public function agregaractividad($data)
	{
		$this->insert($data);
	}

	/// PARA SELECCIONAR AL EMPLEADO AL ASIGNAR LAS ACTIVIDADDES////
	public function asignacion()
	{
		return $this->db->table('empleado')
		->where('estado', '1')
		->where('tipo', 'jefe')
		->orwhere('tipo', 'ejecutor')
		->get();
	}
}
