<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'/libraries/REST_Controller.php');
require './vendor/autoload.php';
use Spipu\Html2Pdf\Html2Pdf;
use Restserver\libraries\REST_Controller;

class PDF extends REST_Controller {
	public function __construct(){
		header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
		header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
		header("Access-Control-Allow-Origin: *");
		header('Content-Type: application/json');
		parent::__construct();
	}
	public function Empleados_PDF_get() {

		ob_start();
		require_once(APPPATH.'/views/EmpleadosPDF.php');
		$htmlEmpleados = ob_get_clean();

		$html2pdf = new Html2Pdf('P', 'A4', 'es', 'true', 'UTF-8');
		$html2pdf->writeHTML($htmlEmpleados);
		$html2pdf->output('Empleados.pdf');
	}
}

