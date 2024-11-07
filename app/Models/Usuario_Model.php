<?php

namespace App\Models;
use CodeIgniter\Model;

class Usuario_Model extends Model {

	protected $table = 'empleado';
    protected $primaryKey = 'idEmpleado';
	protected $allowedFields = ['nombres', 'primerApellido', 'segundoApellido', 'ci', 'expedicion', 'usuario', 'contrasena', 'tipo', 'estado'];

    public function validar($usuario, $contrasena, $estado)
    {
        return $this->db->table($this->table)
            ->select('idEmpleado, usuario, tipo, estado')
            ->where('usuario', $usuario)
            ->where('contrasena', $contrasena)
            ->where('estado', $estado)
            ->get();
    }

	public function validaractualizacion($idUsuario,$contrasena)
	{
		return $this->db->table($this->table)
		->select('*')
		->where('idEmpleado',$idUsuario)
		->where('contrasena',$contrasena)
		->get();
	}

	//VALIDACIONES EN BASE DE DATOS DE USUARIO Y CONTRASEÑA

	public function validarusuario($usuario)
	{
		return $this->db->table($this->table)
		->select('usuario')
		->where('usuario',$usuario)
		->get();
	}

	////////////PARA EL CRUD DE USUARIOS/////////////////////////

	public function usuarios()
	{
		$this->select('*');
		$this->where('estado','1');
		$this->orwhere('estado','2');
		return $this->get();
	}

	public function recuperarusuario($idUsuario)
	{
		return $this->db->table('empleado')
		->select('*')
		->where('idEmpleado',$idUsuario)
		->get();
	}

	public function modificarusuario($idUsuario,$data)
	{
		return $this->update($idUsuario,$data);
	}
}
