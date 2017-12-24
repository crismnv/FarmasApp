<?php 
namespace App\Libs;
use Tecactus\Reniec\DNI;

/**
* 
*/
class ReniecApi
{
	protected $dni;
	function __construct()
	{
		$this->dni = new DNI('4Wr5C8UcyBq2OPcGLBQjjb2EZNAwabIgGpF5ytgW');
	}

	public function buscarDni($numero)
	{
		return $this->dni->get($numero, true);
	}
}