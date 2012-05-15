<?php

class PDFFactory {

	public $htmlDocumentToConvert;
	public $outputFilename;

	private $config;
	private $wkhtmltopdfCommand;
	private $ghostscriptCommand;
	private $pdfsToJoin = array();
	private $wkhtmltopdfOptions = array();
	
	public function __construct() {
		
		$this->setConfiguration();
		
	}	
	
	private function setConfiguration() {
		
		require('config.php');
		$this->config = $config;	

	}
	
	public function overwriteOutputDirectory($directory) {
		
		$this->config['pdf_output_directory'] = $directory;
		
	}
	
	public function addwkhtmltopdfOption($option) {
		
		$this->wkhtmltopdfOptions[] = $this->cleanwkhtmltopdfOption($option);
		
	}
	
	private function cleanwkhtmltopdfOption($option) {
		
		$option = trim($option);
		$option = ' ' . $option . ' ';
		return $option;
		
	}
	
	public function addPDF($filename) {
		
		$this->pdfsToJoin[] = $this->cleanPDFFilename($filename);
		
	}
	
	private function cleanPDFFilename($filename) {
		
		$filename = trim($filename);
		$filename = ' "' . $filename . '"';
		return $filename;
		
	}

	public function createPDF() {
		
		chdir($this->config['wkhtmltopdf_directory']);
		
		$this->wkhtmltopdfCommand = $this->config['wkhtmltopdf_executionable'];
		$this->wkhtmltopdfCommand .= implode('',$this->wkhtmltopdfOptions);
		$this->wkhtmltopdfCommand .= '"' . $this->htmlDocumentToConvert . '" ';
		$this->wkhtmltopdfCommand .= '"' . $this->config['pdf_output_directory'] . $this->outputFilename . '"';
		
		exec($this->wkhtmltopdfCommand);
	}
	
	public function joinPDFs() {
		
		chdir($this->config['ghostscript_directory']);
		
		$this->ghostscriptCommand = $this->config['ghostscript_executionable'];
		$this->ghostscriptCommand .= ' -dNOPAUSE -sDEVICE=pdfwrite -sOUTPUTFILE=';
		$this->ghostscriptCommand .= '"' . $this->config['pdf_output_directory'] . $this->outputFilename. '" ';
		$this->ghostscriptCommand .= '-dBATCH ';
		$this->ghostscriptCommand .= implode('',$this->pdfsToJoin);
		
		exec($this->ghostscriptCommand);
		
	}
	
	public function downloadPDF() {
		
		header('Content-type: application/pdf');
		header('Content-disposition: attachment; filename="' . $this->outputFilename.'"');
		readfile($this->config['pdf_output_directory'] . $this->outputFilename);	

	}
	
}

?>