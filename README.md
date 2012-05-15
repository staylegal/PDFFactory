PDFFactory
==========

PHP Class for creating and joining files.

Requires installation of wkhtmltopdf and Ghostscript

Basic usage
==========

// Set configuration options in PDFFactory/config.php to your environment

// include the PDFFactory class into your PHP script<br />
include('PDFFactory.php');

// instantiate a new PDFFactory<br />
$pdf = new PDFFactory();

// set the HTML document to be converted (can be a URL or a local file)<br />
$pdf->htmlDocumentToConvert = 'http://www.google.com';

// set the filename for the PDF to be created<br />
$pdf->outputFilename = 'test.pdf';

// create the PDF<br />
$pdf->createPDF();