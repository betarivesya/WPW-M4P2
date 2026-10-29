<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function generatePDF()
    {
        $data = [
            'title' => 'Laporan Data Pegawai',
            'tanggal' => now()->format('d-m-Y'),
            'pegawai' => [
                ['nama' => 'Andi', 'jabatan' => 'Manager'],
                ['nama' => 'Budi', 'jabatan' => 'Staff'],
                ['nama' => 'Citra', 'jabatan' => 'Supervisor'],
            ],
        ];

        $pdf = Pdf::loadView('laporan.pegawai', $data)
            ->setPaper('A4', 'landscape');

        return $pdf->stream('laporan-pegawai.pdf');
    }
}
