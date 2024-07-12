<?php

namespace CodeCrafts\Certificates\Src\Services\CertificatesService;

use Dompdf\Dompdf;
use Dompdf\Options;
use PhpOffice\PhpWord\TemplateProcessor;
use Throwable;

class CertificatesService
{
    public function generateCertificate(string $template, array $data): ?string
    {
        try {
            $templateProcessor = new TemplateProcessor($template);
            foreach ($data as $key => $value) {
                $templateProcessor->setValue(search: $key, replace: $value);
            }
            $certificate = tempnam(
                directory: sys_get_temp_dir(), 
                prefix: "html_"
            );
            $templateProcessor->saveAs($certificate);
            
            $options = new Options();
            $options->set('isRemoteEnabled', true);
            
            $dompdf = new Dompdf($options);
            $dompdf->loadHtmlFile($certificate);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            $data = $dompdf->output();
            unlink($certificate);
    
            return $data;
        } catch (Throwable $throwable) {
            return null;
        }
    }
}