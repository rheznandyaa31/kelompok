<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class CompensationController
{
    public function index(Request $request){
        return view('compensation.index');
    }

    public function generate_pdf(Request $request){
        $download = $request->query('download', false);

        $data = [
            "nama"=>"Compensation 1"
        ];

        $pdf = Pdf::loadView('compensation.pdf', compact('data'))->setPaper('a4', 'landscape')->set_option('isHtml5ParserEnabled', true);

        if($download){
            return $pdf->download($data['nama'].'.pdf');
        }else{
            return $pdf->stream();
        }
    }
}
