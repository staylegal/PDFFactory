<?php

/**
 * PDFFactory config file
 */

$config = array();

/**
 * Set path to wkhtmltopdf executionable
 * e.g. /usr/bin for Unix, C:\Program Files\wkhtmltopdf for Windows
 * @var string
 */
$config['wkhtmltopdf_directory'] = '/usr/bin';

/**
 * Set path to Ghostscript executionable
 * e.g. /usr/bin for Unix, C:\Program Files\GSLITE for Windows
 * @var string
 */
$config['ghostscript_directory'] = '/usr/bin';

/**
 * Set the default output directory for generated PDFs
 * @var string
 */
$config['pdf_output_directory'] = '/home/t/e/testpyramid/web/public_html/output/';

/**
 * Set the wkhtmltopdf executionable name
 * e.g. wkhtmltopdf for Unix or wkhtmltopdf.exe for Windows
 * @var string
 */
$config['wkhtmltopdf_executionable'] = 'wkhtmltopdf';

/**
 * Set the Ghostscript executionable name
 * e.g. gs for Unix or gswin32c.exe for windows
 * @var string
 */
$config['ghostscript_executionable'] = 'gs';

?>