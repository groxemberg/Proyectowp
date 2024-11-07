<?php
namespace App\Models;
use CodeIgniter\Model;

class Empleados_Model extends Model {
	
	protected $table = 'empleado'; // Nombre de la tabla en la base de datos
	protected $primaryKey = 'idEmpleado'; // Nombre de tu clave primaria
    protected $allowedFields = ['nombres', 'primerApellido', 'segundoApellido', 'ci', 'expedicion', 'usuario', 'contrasena', 'tipo', 'estado'];

	//para mostrar la lista de empleados con todos sus atributos
	public function empleados()
	{
		// Seleccionar todos los campos de la tabla empleado
		$this->select('*');
		// Condiciones WHERE: estado igual a '1' o '2'
		$this->where('estado','1');
		$this->orwhere('estado','2');
		// Obtener y retornar los resultados
		return $this->get();
	}

	//modelo para agregación a la base de datos
	public function agregarempleado($data)
	{
		$this->insert($data);
	}

	//consulta para recuperación de sus datos del empleado y realizar la modificación
	public function recuperarempleado($idEmpleado)
	{
		$this->select('*');
		$this->where('idEmpleado',$idEmpleado);
		return $this->get();
	}

	// modelo para modificación de la base de datos
	public function modificarempleado($idEmpleado, $data) {
        return $this->update($idEmpleado, $data);
    }

	//modelo para ver empleados eliminados
	public function empleadoseliminados()
	{
		$this->select('*');
		$this->where('estado','0');
		return $this->get();
	}

}
