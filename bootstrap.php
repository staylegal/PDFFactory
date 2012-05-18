<?php

/**
* PDFFactory Usage
*/

/**
* Include PDFFactory class
*/
require 'PDFFactory/PDFFactory.php';

/**
* Basic usage
*
* Create a new PDFFactroy instance
* Set the HTML page to be converted
* Set a filename for the created PDF
* Call the create PDF method
*/

$pdf = new PDFFactory();
$pdf->htmlDocumentToConvert = 'http://www.google.com';
$pdf->outputFilename = 'google.pdf';
$pdf->createPDF();

/**
* Usage including all wkhtmltopdf options
*
* Create a new PDFFactroy instance
* Set the HTML page to be converted (this case the file is a local file)
* Set a filename for the created PDF
* Overwrite the output directory set in the config file to save the generated PDF in a new directory
* Add wkhtmltopdf command options
* Empty the output directory of all files
* Call the create PDF method
* Call the download PDF method to force a download
*/
$pdf2 = new PDFFactory();
$pdf2->htmlDocumentToConvert = '/path/to/webserver/directory/file.html';
$pdf2->outputFilename = 'file.pdf';
$pdf2->overwriteOutputDirectory('/path/to/webserver/directory/new_output_directory/');
$pdf2->addwkhtmltopdfOption('--zoom 1.4');
$pdf2->addwkhtmltopdfOption('--margin-top 5mm');
$pdf2->addwkhtmltopdfOption('--margin-right 5mm');
$pdf2->addwkhtmltopdfOption('--margin-bottom 5mm');
$pdf2->addwkhtmltopdfOption('--margin-left 5mm');
$pdf2->cleanOutputDirectory();
$pdf2->createPDF();
$pdf2->downloadPDF();

/**
* Usage to join PDFs
*
* Create a new PDFFactroy instance
* Set a filename for the created PDF
* Add PDFs to be joined
* Call the joinPDFs method
*/

$pdf3 = new PDFFactory();
$pdf3->outputFilename = 'Joined PDFs.pdf';
$pdf3->addPDF('/path/to/webserver/directory/output/Page 1.pdf');
$pdf3->addPDF('/path/to/webserver/directory/output/Page 2.pdf');
$pdf3->addPDF('/path/to/webserver/directory/output/Page 3.pdf');
$pdf3->joinPDFs();

/**
* Usage to join a generate PDFs to additional PDFs
*
* Create a new PDFFactroy instance
* Set a filename for the created PDF
* Add PDFs to be joined
* Call the joinPDFs method
*/

$pdf4 = new PDFFactory();
$pdf4->outputFilename = 'Joined PDFs.pdf';
$pdf4->htmlDocumentToConvert = 'http://www.google.com';
$pdf4->outputFilename = 'google.pdf';
$pdf4->addPDF($pdf->createPDF());
$pdf4->addPDF('/path/to/webserver/directory/output/Page 1.pdf');
$pdf4->addPDF('/path/to/webserver/directory/output/Page 2.pdf');
$pdf4->addPDF('/path/to/webserver/directory/output/Page 3.pdf');
$pdf4->joinPDFs();

?>