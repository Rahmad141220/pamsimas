<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pdf {
		
	public function __construct() {
		
		require_once APPPATH.'third_party/fpdf/fpdf-1.8.php';
		
		$pdf = new FPDF();
		$pdf->AddPage();
		// $pdf->Image('third_party/Image/logo.jpg',10,10);
        // $pdf->Output();
		
		$CI =& get_instance();
		$CI->fpdf = $pdf;
		
	}
	
}