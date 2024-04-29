<?php
namespace App\Http\Controllers\Divota;

use App\Http\Controllers\Controller;
use App\Models\Accommodation;

class AboutController extends Controller
{
    public function index()
    {
        $page_name = 'About Us';

        return view('divota.about', [
            'page_name' => $page_name,
        ]);

    }
}

