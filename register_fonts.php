<?php

require_once __DIR__ . '/vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\FontMetrics;

$dompdf = new Dompdf();
$fontMetrics = $dompdf->getFontMetrics();

// Register Arial font
$fontFamily = 'Arial';
$fontFile = __DIR__ . '/storage/fonts/arial/arial.ttf';

// Add the font to the font metrics
$fontMetrics->registerFont(['family' => $fontFamily, 'normal' => $fontFile]);

echo "Arial font registered successfully!\n";