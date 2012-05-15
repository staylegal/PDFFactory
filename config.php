<?php

// set path to wkhtmltopdf executionable i.e. /usr/bin for unix, C:\Program Files\wkhtmltopdf for windows
$config['wkhtmltopdf_directory'] = '/usr/bin';

// set path to ghostscript executionable i.e. /usr/bin for unix, C:\Program Files\GSLITE for windows
$config['ghostscript_directory'] = '/usr/bin';

// set the default ouput directory for any generated PDFs
$config['pdf_output_directory'] = '/home/t/e/testpyramid/web/public_html/output/';

// set the wkhtmltopdf executionable name i.e. wkhtmltopdf for unix, wkhtmltopdf.exe for windows
$config['wkhtmltopdf_executionable'] = 'wkhtmltopdf';

// set the ghostscript executionable name i.e. ghostscript for unix, gswin32c.exe for windows
$config['ghostscript_executionable'] = 'gs';

?>