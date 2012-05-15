<?php

require_once('PDFFactory.php');

//$pdf = new PDFFactory();
//$pdf->htmlDocumentToConvert = 'http://www.teamdds.co.uk/invoice.php?invno=10440';
//$pdf->outputFilename = 'test.pdf';
//$pdf->createPDF();

//$pdf2 = new PDFFactory();
//$pdf2->htmlDocumentToConvert = '/home/t/e/testpyramid/web/public_html/pdfs/somefile.html';
//$pdf2->outputFilename = 'google.pdf';
//$pdf2->overwriteOutputDirectory('/home/t/e/testpyramid/web/public_html/pdfs/');
//$pdf2->addwkhtmltopdfOption('--zoom 1.4');
//$pdf2->addwkhtmltopdfOption('--margin-top 5mm');
//$pdf2->addwkhtmltopdfOption('--margin-right 5mm');
//$pdf2->addwkhtmltopdfOption('--margin-bottom 5mm');
//$pdf2->addwkhtmltopdfOption('--margin-left 5mm');
//$pdf2->createPDF();
//$pdf->downloadPDF();

$pdfs_to_join = array('/home/t/e/testpyramid/web/public_html/output/test.pdf','/home/t/e/testpyramid/web/public_html/output/activity15916-2012-01-16.pdf','/home/t/e/testpyramid/web/public_html/output/activity15916-2012-01-16.pdf');

$pdf = new PDFFactory();
$pdf->outputFilename = 'joining_test.pdf';
$pdf->addPDF ('/home/t/e/testpyramid/web/public_html/output/test.pdf');
$pdf->addPDF('/home/t/e/testpyramid/web/public_html/output/activity15916-2012-01-16.pdf');
$pdf->addPDF('/home/t/e/testpyramid/web/public_html/output/activity16583-2012-01-16.pdf');

$pdf->joinPDFs();






?>