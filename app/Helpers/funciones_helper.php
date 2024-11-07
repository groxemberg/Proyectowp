<?php
	
	function formatearFecha($fecha)
	{
		$dia=substr($fecha, 8,2);
		$mes=substr($fecha, 5,2);
		$anio=substr($fecha, 0,4);
		
		$fechaformateada=$dia."/".$mes."/".$anio;
		
		return $fechaformateada;
	} 


	function estado($fecha)
	{
		$mesactual=date('m');
		$mes=substr($fecha, 5,2);
		
		if($mesactual==$mes)
		{
			$estado='En Ejecución';
		}
		else
		if ($mes<$mesactual) {
			$estado='Cerrado';
		}
		else
		if ($mes>$mesactual) {
			$estado='Programado';
		}			
		return $estado;
	}

?>