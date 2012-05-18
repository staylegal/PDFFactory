<?php

class PDFFactory {

	 /**
     * URL or local HTML file to be converted to PDF.
     * @var string
     */
	public $htmlDocumentToConvert;
	
	 /**
     * Filename of the output PDF.
     * @var string
     */	
	public $outputFilename;

	 /**
     * Configuration variables set in config.php
     * @var array
     */
	private $config;
	
	 /**
     * Command to be used for creating a PDF with wkhtmltopdf.
     * @var string
     */	
	private $wkhtmltopdfCommand;
	
	 /**
     * Command to be used for joining PDFs with Ghostscript.
     * @var string
     */		
	private $ghostscriptCommand;
	
	 /**
     * Array of files to be joined
     * @var array
     */		
	private $pdfsToJoin = array();
	
	 /**
     * Array of options for wkhtmltopdf
     * @var array
     */		
	private $wkhtmltopdfOptions = array();

	/**
	 * Upon instansiation call the setConfiguration method so
	 * configuration settings in the config file can be used within
	 * the current object.
	 */
	public function __construct() {
		
		$this->setConfiguration();
		
	}	

	/**
	 * Puts configuration from config.php file into current instance
	 */
	private function setConfiguration() {
		
		require 'config.php';
		$this->config = $config;	

	}
	
	/**
	 * Sets a different output directory for the PDF other than the
	 * output directory set in config.php
	 */	
	public function overwriteOutputDirectory($directory) {
		
		$this->config['pdf_output_directory'] = $directory;
		
	}

	/**
	 * Add wkhtmltopdf options to array
	 * Available options can be found in the wkhtmltopdf manual. 
	 * Links to the manuals can be found at http://code.google.com/p/wkhtmltopdf/
	 */	
	public function addwkhtmltopdfOption($option) {
		
		$this->wkhtmltopdfOptions[] = $this->cleanwkhtmltopdfOption($option);
		
	}

	/**
	 * Clean the options
	 * Remove whitespace from either side of the string and add single spaces
	 */	
	private function cleanwkhtmltopdfOption($option) {
		
		$option = trim($option);
		$option = ' ' . $option . ' ';
		return $option;
		
	}

	/**
	 * Add paths of PDFs to be joined
	 */		 
	public function addPDF($filename) {
		
		$this->pdfsToJoin[] = $this->cleanPDFFilename($filename);
		
	}

	/**
	 * Clean the filename
	 * Remove whitespace from either side of the string and add single spaces
	 */	
	private function cleanPDFFilename($filename) {
		
		$filename = trim($filename);
		$filename = ' "' . $filename . '"';
		return $filename;
		
	}

	/**
	 * Remove all existing files in the output directory
	 */	
	public function emptyOutputDirectory() {

		$dh = opendir($this->config['pdf_output_directory']);
				
		while($file = readdir($dh)) {
			
		    if(!is_dir($file)) {
		
		        unlink($this->config['pdf_output_directory'].$file);
		    }
		}
		closedir($dh);
	}

	/**
	 * Build the create PDF command
	 * Change directory to wkhtmltopdf, build and run the command
	 */	
	public function createPDF() {
		
		chdir($this->config['wkhtmltopdf_directory']);
		
		$this->wkhtmltopdfCommand = $this->config['wkhtmltopdf_executionable'] . ' ';
		$this->wkhtmltopdfCommand .= implode('',$this->wkhtmltopdfOptions);
		$this->wkhtmltopdfCommand .= '"' . $this->htmlDocumentToConvert . '" ';
		$this->wkhtmltopdfCommand .= '"' . $this->config['pdf_output_directory'] . $this->outputFilename . '"';
		exec($this->wkhtmltopdfCommand);
	}

	/**
	 * Build the join PDF command
	 * Change directory to Ghostscript, build and run the command
	 */	
	public function joinPDFs() {
		
		chdir($this->config['ghostscript_directory']);
		
		$this->ghostscriptCommand = $this->config['ghostscript_executionable'];
		$this->ghostscriptCommand .= ' -dNOPAUSE -sDEVICE=pdfwrite -sOUTPUTFILE=';
		$this->ghostscriptCommand .= '"' . $this->config['pdf_output_directory'] . $this->outputFilename. '" ';
		$this->ghostscriptCommand .= '-dBATCH ';
		$this->ghostscriptCommand .= implode('',$this->pdfsToJoin);
		
		exec($this->ghostscriptCommand);
		
	}

	/**
	 * Download the created PDF
	 * Set headers and force a download of the new file
	 * Can only be used if no output has been made to the browser before
	 * running
	 */	
	public function downloadPDF() {
		
		header('Content-type: application/pdf');
		header('Content-disposition: attachment; filename="' . $this->outputFilename.'"');
		readfile($this->config['pdf_output_directory'] . $this->outputFilename);	

	}
	
}

?>