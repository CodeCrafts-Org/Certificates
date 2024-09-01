<?php

namespace CodeCrafts\Certificates\Src\Services;

use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\TemplateProcessor;
use Throwable;

class CertificatesService
{
    public function generateCertificate(string $template, array $data): ?string
    {
        try {
            $templateProcessor = new TemplateProcessor($template);
            $templateProcessor->setValues($data);
            $document = tempnam(
                /* directory: */ sys_get_temp_dir(),
                /* prefix: */ 'document'
            );
            $templateProcessor->saveAs($document);

	        Settings::setPdfRendererName(Settings::PDF_RENDERER_DOMPDF);
            Settings::setPdfRendererPath(realpath(__DIR__) . '/../../vendor/dompdf/dompdf');
            $certificate = tempnam(
                /*directory: */ sys_get_temp_dir(),
                /* prefix: */ 'certificate'
            );
	        IOFactory::load($document)->save($certificate, 'PDF');

            return file_get_contents($certificate);
        } catch (Throwable $throwable) {
            error_log(
                /* message: */ $throwable->getMessage(),
                /* message_type: */ 0
            );

            return null;
        }
    }
}
