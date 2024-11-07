<?php
namespace App\Models;
use CodeIgniter\Model;

class Wp_Model extends Model {

    protected $table = 'informe'; // Nombre de la tabla en la base de datos
	protected $primaryKey = 'idInforme'; // Nombre de tu clave primaria
    protected $allowedFields = ['tipoInforme', 'nroInforme', 'informe', 'fechaInicio', 'fechaConclusion', 'fechaPresentacion', 'wp', 'tipoWp', 'comentarios', 'fechaRegistro', 'estado', 'idEmpleado'];

    public function wp()
    {
        return $this->db->table('informe i')
                ->select('i.idInforme, i.nroInforme, i.informe, i.fechaPresentacion, i.wp, i.tipoWp, i.comentarios, i.fechaRegistro, i.estado, i.idEmpleado, ep.nombres, ep.primerApellido, ep.segundoApellido')
                ->where('i.estado', '1')
                ->orWhere('i.estado', '2')
                ->join('empleado ep', 'ep.idEmpleado = i.idEmpleado')
                ->get();
    }

    //Modelo para recuperar los valores registrados y modificar los datos en base a los que ya fueron registrados
       public function recuperaractividad($idInforme)
    {
        return $this->db->table('informe i')
            ->select('i.idInforme, i.tipoInforme, i.nroInforme, i.informe, i.fechaInicio, i.fechaConclusion, i.fechaPresentacion, i.wp, i.tipoWp, i.comentarios, i.fechaRegistro, i.estado, i.idEmpleado, ep.nombres, ep.primerApellido, ep.segundoApellido')
            ->where('i.idInforme', $idInforme)
            ->join('empleado ep', 'ep.idEmpleado = i.idEmpleado')
            ->get();
    }

    // MODELO PARA MODIFICAR ACTIVIDADES PENDIENTES
    public function modificaractividad($idInforme, $data)
    {
        return $this->update($idInforme, $data);
    }

    //MODELO PARA LA VISTA DE ACTIVIDADES ELIMINADAS
    public function eliminados()
    {
        return $this->db->table('informe i')
                ->select('i.idInforme, i.nroInforme, i.informe,i.fechaInicio,i.fechaConclusion, i.fechaPresentacion, i.wp, i.tipoWp, i.comentarios, i.fechaRegistro, i.estado, i.idEmpleado, ep.nombres, ep.primerApellido, ep.segundoApellido')
                ->where('i.estado', '0')
                ->join('empleado ep', 'ep.idEmpleado = i.idEmpleado')
                ->get();
    }


    // REPORTES DE SEGUIMIENTO EN ESTADO DE REVISIÓN
    public function countEnRevision()
    {
        return $this->where('estado', 2)->countAllResults();
    }
  
}
