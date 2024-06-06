<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'poliUmumCount' => 10, // Replace with actual data
            'poliGigiCount' => 5,  // Replace with actual data
            'poliKIACount' => 8,   // Replace with actual data
            'kunjunganUmumCount' => 15, // Replace with actual data
            'kunjunganBPJSCount' => 12, // Replace with actual data
        ];

        return view('dashboard', $data);
    }
}
