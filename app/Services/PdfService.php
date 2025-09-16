<?php

namespace App\Services;

use App\Models\Program;
use PDF;

class PdfService
{
    /**
     * Generate a PDF for a training program
     *
     * @param Program $program The program object
     * @param string $locale The locale to use (en or ar)
     * @return \niklasravnsborg\LaravelPdf\Pdf
     */
    public function generateProgramPdf(Program $program, $locale = 'en')
    {        
        // Load the program with all related data
        $program->load(['trainee', 'days.exercises']);
        
        // Set the correct view based on locale
        $view = $locale === 'ar' ? 'pdfs.program-ar' : 'pdfs.program';
        
        // Configure PDF options
        $config = [
            'format' => 'A4',
            'margin_header' => 5,
            'margin_footer' => 5,
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_top' => 20,
            'margin_bottom' => 20,
            'orientation' => 'P',
        ];
        
        // Add RTL configuration for Arabic
        if ($locale === 'ar') {
            $config['mode'] = 'utf-8';
            $config['direction'] = 'rtl';
            $config['default_font'] = 'arial';
            $config['font_dir'] = storage_path('fonts/');
            $config['font_cache'] = storage_path('fonts/');
        }
        
        // Generate the PDF with the program data
        $pdf = PDF::loadView($view, [
            'program' => $program,
            'trainee' => $program->trainee,
            'days' => $program->days,
        ], [], $config);
        
        // Set filename for download
        $filename = 'program_' . $program->id . '_' . $locale . '.pdf';
        
        return $pdf->download($filename);
    }
    
    /**
     * Stream a PDF for a training program
     *
     * @param Program $program The program object
     * @param string $locale The locale to use (en or ar)
     * @return \Illuminate\Http\Response
     */
    public function streamProgramPdf(Program $program, $locale = 'en')
    {
        $pdf = $this->generateProgramPdf($program, $locale);
        $filename = 'program_' . $program->id . '_' . $locale . '.pdf';
        
        return $pdf->stream($filename);
    }
}