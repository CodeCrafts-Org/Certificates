<?php

namespace CodeCrafts\Certificates\Src\DependencyInjectionContainers;

use CodeCrafts\Certificates\Src\Services\CertificatesService;

class ApplicationContainer
{
    public function makeCertificatesService(): CertificatesService
    {
        return new CertificatesService;
    }
}
