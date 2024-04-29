<?php
namespace App\Http\Controllers\Divota;

use App\Http\Controllers\Controller;

class SpaController extends Controller
{
    public function index()
    {
        $page_name = 'Spa';

        return view('divota.spa', [
            'page_name' => $page_name,
        ]);

    }
}

