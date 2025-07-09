<?php

namespace App\Http\Controllers;

use App\Models\Pacientes;
use Illuminate\Http\Request;
use App\Models\Paciente;
use Barryvdh\DomPDF\Facade\Pdf;

class ReporteController extends Controller
{
    public function index()
    {
        return view('logica.reportes');
    }

    public function pacientesPdf()
    {
        $pacientes = Pacientes::all();
        $pdf = Pdf::loadView('logica.reportes_pacientes_pdf', compact('pacientes'));
        return $pdf->download('pacientes.pdf');
    }
    
    public function pacientesCsv()
    {
        $pacientes = Pacientes::all();

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=pacientes.csv",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['Nombres', 'Apellidos', 'Cédula', 'Teléfono', 'Email'];

        $callback = function() use ($pacientes, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($pacientes as $paciente) {
                fputcsv($file, [
                    $paciente->nombres,
                    $paciente->apellidos,
                    $paciente->cedula,
                    $paciente->telefono,
                    $paciente->email
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}