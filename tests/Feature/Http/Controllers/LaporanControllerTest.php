<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;

class LaporanControllerTest extends TestCase
{
    public function test_laporan_pdf_returns_an_inline_landscape_pdf(): void
    {
        $response = $this->get('/laporan-pdf');

        $response->assertOk()
            ->assertHeader('content-type', 'application/pdf')
            ->assertHeader('content-disposition', 'inline; filename=laporan-pegawai.pdf');

        $this->assertStringStartsWith('%PDF-', $response->getContent());
        $this->assertStringContainsString('/MediaBox [0.000 0.000 841.890 595.280]', $response->getContent());
    }
}
